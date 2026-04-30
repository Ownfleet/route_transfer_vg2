<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

require_once "auth.php";
require_admin();

require_once "db.php";
$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $stmt = $conn->query("
        SELECT 
            r.*,
            rc.vehicle_type AS claimed_vehicle_type
        FROM routes r
        LEFT JOIN LATERAL (
            SELECT vehicle_type
            FROM route_claims
            WHERE route_id = r.id
            ORDER BY claimed_at DESC
            LIMIT 1
        ) rc ON TRUE
        ORDER BY r.created_at DESC
    ");

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "create";

if ($action === "create") {
    $routeName = trim($data["route_name"] ?? "");
    $region = trim($data["region"] ?? "");
    $allowedVehicles = $data["allowed_vehicles"] ?? [];

    if (!$routeName || !$region || count($allowedVehicles) === 0) {
        echo json_encode(["error" => "Preencha rota, região e veículos"]);
        exit;
    }

    $vehicles = "{" . implode(",", $allowedVehicles) . "}";

    $stmt = $conn->prepare("
        INSERT INTO routes (route_name, region, allowed_vehicles)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$routeName, $region, $vehicles]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "edit") {
    $routeId = intval($data["id"] ?? 0);
    $routeName = trim($data["route_name"] ?? "");
    $region = trim($data["region"] ?? "");
    $allowedVehicles = $data["allowed_vehicles"] ?? [];

    if (!$routeId || !$routeName || !$region || count($allowedVehicles) === 0) {
        echo json_encode(["error" => "Preencha todos os campos"]);
        exit;
    }

    $vehicles = "{" . implode(",", $allowedVehicles) . "}";

    $stmt = $conn->prepare("
        UPDATE routes
        SET route_name = ?,
            region = ?,
            allowed_vehicles = ?
        WHERE id = ?
    ");

    $stmt->execute([$routeName, $region, $vehicles, $routeId]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "reopen") {
    $routeId = intval($data["id"] ?? 0);

    if (!$routeId) {
        echo json_encode(["error" => "Rota inválida"]);
        exit;
    }

    $stmt = $conn->prepare("
        UPDATE routes
        SET status = 'disponivel',
            claimed_by_driver_id = NULL,
            claimed_by_driver_name = NULL,
            claimed_at = NULL
        WHERE id = ?
    ");

    $stmt->execute([$routeId]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "delete") {
    $routeId = intval($data["id"] ?? 0);

    if (!$routeId) {
        echo json_encode(["error" => "Rota inválida"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM route_claims WHERE route_id = ?");
    $stmt->execute([$routeId]);

    $stmt = $conn->prepare("DELETE FROM routes WHERE id = ?");
    $stmt->execute([$routeId]);

    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["error" => "Ação inválida"]);

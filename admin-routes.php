<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, X-Admin-Token");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") exit;

$adminToken = $_SERVER["HTTP_X_ADMIN_TOKEN"] ?? "";
$realToken = getenv("ADMIN_TOKEN");

if (!$realToken || $adminToken !== $realToken) {
    http_response_code(401);
    exit;
}

require_once "db.php";
$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $stmt = $conn->query("SELECT * FROM routes ORDER BY created_at DESC");
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
        echo json_encode(["error" => "Preencha os campos obrigatórios"]);
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
    $vehicles = "{" . implode(",", $data["allowed_vehicles"]) . "}";

    $stmt = $conn->prepare("
        UPDATE routes
        SET route_name = ?,
            region = ?,
            allowed_vehicles = ?
        WHERE id = ?
    ");
    $stmt->execute([
        trim($data["route_name"]),
        trim($data["region"]),
        $vehicles,
        intval($data["id"])
    ]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "reopen") {
    $stmt = $conn->prepare("
        UPDATE routes
        SET status = 'disponivel',
            claimed_by_driver_id = NULL,
            claimed_by_driver_name = NULL,
            claimed_at = NULL
        WHERE id = ?
    ");
    $stmt->execute([intval($data["id"])]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "delete") {
    $routeId = intval($data["id"]);

    $stmt = $conn->prepare("DELETE FROM route_claims WHERE route_id = ?");
    $stmt->execute([$routeId]);

    $stmt = $conn->prepare("DELETE FROM routes WHERE id = ?");
    $stmt->execute([$routeId]);

    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["error" => "Ação inválida"]);
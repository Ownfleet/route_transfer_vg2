<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once "db.php";

$conn = getConnection();

$data = json_decode(file_get_contents("php://input"), true);

$driverId = trim($data["driver_id"] ?? "");
$routeId = intval($data["route_id"] ?? 0);

if (!$driverId || !$routeId) {
    echo json_encode(["error" => "Informe o ID do motorista e a rota"]);
    exit;
}

try {
    $conn->beginTransaction();

    $stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_id = ?");
    $stmt->execute([$driverId]);
    $driver = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$driver) {
        $conn->rollBack();
        echo json_encode(["error" => "Motorista não encontrado"]);
        exit;
    }

    if (!$driver["active"]) {
        $conn->rollBack();
        echo json_encode(["error" => "Motorista desativado"]);
        exit;
    }

    if (!empty($driver["punished_until"]) && strtotime($driver["punished_until"]) > time()) {
        $conn->rollBack();
        echo json_encode(["error" => "Indisponível no momento"]);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT id FROM route_claims
        WHERE driver_id = ?
        AND DATE(claimed_at) = CURRENT_DATE
    ");
    $stmt->execute([$driverId]);

    if ($stmt->fetch()) {
        $conn->rollBack();
        echo json_encode(["error" => "Você já pegou uma rota hoje"]);
        exit;
    }

    $stmt = $conn->prepare("
        UPDATE routes
        SET status = 'repassada',
            claimed_by_driver_id = ?,
            claimed_by_driver_name = ?,
            claimed_at = NOW()
        WHERE id = ?
        AND status = 'disponivel'
        RETURNING *
    ");

    $stmt->execute([
        $driver["driver_id"],
        $driver["driver_name"],
        $routeId
    ]);

    $route = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$route) {
        $conn->rollBack();
        echo json_encode(["error" => "Rota já foi repassada"]);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO route_claims (route_id, driver_id, driver_name, vehicle_type)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $routeId,
        $driver["driver_id"],
        $driver["driver_name"],
        $driver["vehicle_type"]
    ]);

    $conn->commit();

    echo json_encode([
        "success" => true,
        "message" => "Você pegou esta rota",
        "route" => $route
    ]);

} catch (Exception $e) {
    $conn->rollBack();
    http_response_code(500);
    echo json_encode(["error" => "Erro interno"]);
}
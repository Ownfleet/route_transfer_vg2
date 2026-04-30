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
    $driverId = trim($_GET["driver_id"] ?? "");

    if ($driverId) {
        $stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_id = ?");
        $stmt->execute([$driverId]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: null);
        exit;
    }

    echo json_encode([]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "";

if ($action === "create") {
    $driverId = trim($data["driver_id"] ?? "");
    $driverName = trim($data["driver_name"] ?? "");
    $vehicleType = trim($data["vehicle_type"] ?? "");

    if (!$driverId || !$driverName || !$vehicleType) {
        echo json_encode(["error" => "Preencha todos os campos"]);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO drivers (driver_id, driver_name, vehicle_type)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$driverId, $driverName, $vehicleType]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "toggle") {
    $stmt = $conn->prepare("
        UPDATE drivers 
        SET active = NOT active 
        WHERE driver_id = ?
    ");
    $stmt->execute([$data["driver_id"]]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "punish") {
    $stmt = $conn->prepare("
        UPDATE drivers 
        SET punished_until = NOW() + INTERVAL '15 hours' 
        WHERE driver_id = ?
    ");
    $stmt->execute([$data["driver_id"]]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "remove_punish") {
    $stmt = $conn->prepare("
        UPDATE drivers 
        SET punished_until = NULL 
        WHERE driver_id = ?
    ");
    $stmt->execute([$data["driver_id"]]);

    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["error" => "Ação inválida"]);
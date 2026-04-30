<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
require_once "db.php";

$conn = getConnection();
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $stmt = $conn->query("SELECT * FROM drivers ORDER BY created_at DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "";

if ($action === "create") {
    $stmt = $conn->prepare("INSERT INTO drivers (driver_id, driver_name, vehicle_type) VALUES (?, ?, ?)");
    $stmt->execute([$data["driver_id"], $data["driver_name"], $data["vehicle_type"]]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "toggle") {
    $stmt = $conn->prepare("UPDATE drivers SET active = NOT active WHERE driver_id = ?");
    $stmt->execute([$data["driver_id"]]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "punish") {
    $stmt = $conn->prepare("UPDATE drivers SET punished_until = NOW() + INTERVAL '15 hours' WHERE driver_id = ?");
    $stmt->execute([$data["driver_id"]]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "remove_punish") {
    $stmt = $conn->prepare("UPDATE drivers SET punished_until = NULL WHERE driver_id = ?");
    $stmt->execute([$data["driver_id"]]);
    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["error" => "Ação inválida"]);
<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
require_once "db.php";

$conn = getConnection();
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $stmt = $conn->query("SELECT * FROM routes ORDER BY created_at DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("
    INSERT INTO routes (route_name, region, allowed_vehicles)
    VALUES (?, ?, ?)
");

$vehicles = "{" . implode(",", $data["allowed_vehicles"]) . "}";

$stmt->execute([
    $data["route_name"],
    $data["region"],
    $vehicles
]);

echo json_encode(["success" => true]);
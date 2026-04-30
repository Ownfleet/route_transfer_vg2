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
    $stmt = $conn->query("SELECT * FROM hub_config WHERE id = 1");
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: null);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$hubName = trim($data["hub_name"] ?? "Galpão");
$latitude = floatval($data["latitude"] ?? 0);
$longitude = floatval($data["longitude"] ?? 0);
$radius = intval($data["radius_meters"] ?? 0);

if (!$hubName || !$latitude || !$longitude || $radius <= 0) {
    echo json_encode(["error" => "Preencha latitude, longitude e raio corretamente"]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO hub_config (id, hub_name, latitude, longitude, radius_meters, updated_at)
    VALUES (1, ?, ?, ?, ?, NOW())
    ON CONFLICT (id) DO UPDATE SET
        hub_name = EXCLUDED.hub_name,
        latitude = EXCLUDED.latitude,
        longitude = EXCLUDED.longitude,
        radius_meters = EXCLUDED.radius_meters,
        updated_at = NOW()
");

$stmt->execute([$hubName, $latitude, $longitude, $radius]);

echo json_encode(["success" => true]);

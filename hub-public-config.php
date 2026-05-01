<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

require_once "db.php";
$conn = getConnection();

$stmt = $conn->query("SELECT hub_name, latitude, longitude, radius_meters, updated_at FROM hub_config WHERE id = 1");
$config = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$config) {
    echo json_encode(null);
    exit;
}

echo json_encode($config);

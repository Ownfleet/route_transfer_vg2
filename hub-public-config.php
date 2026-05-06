<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
require_once "db.php";
$conn = getConnection();
$stmt = $conn->query("SELECT hub_name, latitude, longitude, radius_meters, updated_at FROM hub_config WHERE id=1");
echo json_encode($stmt->fetch() ?: null);
?>

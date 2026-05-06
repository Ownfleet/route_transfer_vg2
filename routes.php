<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
require_once "db.php";
$conn = getConnection();
$stmt = $conn->query("
    SELECT id, route_name, region, allowed_vehicles, status,
           claimed_at, claimed_by_driver_name, claimed_by_driver_id, created_at
    FROM routes
    ORDER BY created_at DESC
");
echo json_encode($stmt->fetchAll());
?>

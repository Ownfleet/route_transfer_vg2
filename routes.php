<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

require_once "db.php";

$conn = getConnection();

$stmt = $conn->query("SELECT * FROM routes ORDER BY created_at DESC");
$routes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($routes);
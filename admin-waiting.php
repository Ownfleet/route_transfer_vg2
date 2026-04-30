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

$stmt = $conn->query("
    SELECT *
    FROM driver_waiting_hub
    WHERE waiting_date = CURRENT_DATE
    AND status = 'aguardando'
    ORDER BY created_at DESC
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

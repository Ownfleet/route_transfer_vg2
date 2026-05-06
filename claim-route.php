<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") exit;
require_once "db.php";
try {
    $conn = getConnection();
    $data = json_decode(file_get_contents("php://input"), true);
    $driverId = trim($data["driver_id"] ?? "");
    $routeId = intval($data["route_id"] ?? 0);
    if (!$driverId || !$routeId) {
        echo json_encode(["success" => false, "error" => "Operação não autorizada."]);
        exit;
    }
    $stmt = $conn->prepare("SELECT claim_route_atomic(?, ?) AS result");
    $stmt->execute([$driverId, $routeId]);
    $row = $stmt->fetch();
    echo $row["result"];
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Erro interno ao pegar rota."]);
}
?>

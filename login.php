<?php
header("Content-Type: application/json; charset=utf-8");
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$password = $data["password"] ?? "";
$realPassword = getenv("ADMIN_PASSWORD") ?: "COLOQUE_SUA_SENHA_ADMIN";
if (!$realPassword || $password !== $realPassword) {
    http_response_code(401);
    exit;
}
$_SESSION["admin_logged"] = true;
echo json_encode(["success" => true]);
?>

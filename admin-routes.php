<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, X-Admin-Token");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

$adminToken = $_SERVER["HTTP_X_ADMIN_TOKEN"] ?? "";
$realToken = getenv("ADMIN_TOKEN");

if (!$realToken || $adminToken !== $realToken) {
    http_response_code(401);
    echo json_encode(["error" => "Acesso não autorizado"]);
    exit;
}

require_once "db.php";

$conn = getConnection();
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $stmt = $conn->query("SELECT * FROM routes ORDER BY created_at DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$routeName = trim($data["route_name"] ?? "");
$region = trim($data["region"] ?? "");
$allowedVehicles = $data["allowed_vehicles"] ?? [];

if (!$routeName || !$region || count($allowedVehicles) === 0) {
    echo json_encode(["error" => "Preencha rota, região e veículos"]);
    exit;
}

$vehicles = "{" . implode(",", $allowedVehicles) . "}";

$stmt = $conn->prepare("
    INSERT INTO routes (route_name, region, allowed_vehicles)
    VALUES (?, ?, ?)
");

$stmt->execute([$routeName, $region, $vehicles]);

echo json_encode(["success" => true]);
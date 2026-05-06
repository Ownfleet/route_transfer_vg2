<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") exit;
require_once "auth.php";
require_admin();
require_once "db.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $stmt = $conn->query("
        SELECT r.*,
               COALESCE(rc.vehicle_type, d.vehicle_type) AS claimed_vehicle_type,
               COALESCE(rc.telephone, d.telephone) AS claimed_telephone
        FROM routes r
        LEFT JOIN LATERAL (
            SELECT vehicle_type, telephone
            FROM route_claims
            WHERE route_id = r.id
            ORDER BY claimed_at DESC
            LIMIT 1
        ) rc ON TRUE
        LEFT JOIN drivers d ON d.driver_id = r.claimed_by_driver_id
        ORDER BY r.created_at DESC
    ");
    echo json_encode($stmt->fetchAll());
    exit;
}
$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "create";
if ($action === "create") {
    $vehicles = "{" . implode(",", $data["allowed_vehicles"] ?? []) . "}";
    $stmt = $conn->prepare("INSERT INTO routes (route_name, region, allowed_vehicles) VALUES (?, ?, ?)");
    $stmt->execute([trim($data["route_name"] ?? ""), trim($data["region"] ?? ""), $vehicles]);
    echo json_encode(["success" => true]);
    exit;
}
if ($action === "edit") {
    $vehicles = "{" . implode(",", $data["allowed_vehicles"] ?? []) . "}";
    $stmt = $conn->prepare("UPDATE routes SET route_name=?, region=?, allowed_vehicles=? WHERE id=?");
    $stmt->execute([trim($data["route_name"] ?? ""), trim($data["region"] ?? ""), $vehicles, intval($data["id"] ?? 0)]);
    echo json_encode(["success" => true]);
    exit;
}
if ($action === "reopen") {
    $stmt = $conn->prepare("UPDATE routes SET status='disponivel', claimed_by_driver_id=NULL, claimed_by_driver_name=NULL, claimed_at=NULL WHERE id=?");
    $stmt->execute([intval($data["id"] ?? 0)]);
    echo json_encode(["success" => true]);
    exit;
}
if ($action === "delete") {
    $id = intval($data["id"] ?? 0);
    $conn->prepare("DELETE FROM route_claims WHERE route_id=?")->execute([$id]);
    $conn->prepare("DELETE FROM routes WHERE id=?")->execute([$id]);
    echo json_encode(["success" => true]);
    exit;
}
echo json_encode(["error" => "Ação inválida"]);
?>

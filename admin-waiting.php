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
        SELECT *
        FROM driver_waiting_hub
        WHERE waiting_date = CURRENT_DATE
        AND status = 'aguardando'
        ORDER BY created_at DESC
    ");

    echo json_encode($stmt->fetchAll());
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "";

if ($action === "delete") {
    $id = intval($data["id"] ?? 0);

    if (!$id) {
        echo json_encode(["error" => "ID inválido"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM driver_waiting_hub WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "delete_many") {
    $ids = $data["ids"] ?? [];

    if (!is_array($ids) || count($ids) === 0) {
        echo json_encode(["error" => "Nenhum registro selecionado"]);
        exit;
    }

    $ids = array_values(array_filter(array_map("intval", $ids)));

    if (count($ids) === 0) {
        echo json_encode(["error" => "Nenhum ID válido"]);
        exit;
    }

    $placeholders = implode(",", array_fill(0, count($ids), "?"));
    $stmt = $conn->prepare("DELETE FROM driver_waiting_hub WHERE id IN ($placeholders)");
    $stmt->execute($ids);

    echo json_encode(["success" => true]);
    exit;
}

if ($action === "clear_today") {
    $stmt = $conn->prepare("DELETE FROM driver_waiting_hub WHERE waiting_date = CURRENT_DATE");
    $stmt->execute();

    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["error" => "Ação inválida"]);
?>
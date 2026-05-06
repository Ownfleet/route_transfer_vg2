<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") exit;
require_once "auth.php";
require_admin();
require_once "db.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $driverId = trim($_GET["driver_id"] ?? "");
    if ($driverId) {
        $stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_id=?");
        $stmt->execute([$driverId]);
        echo json_encode($stmt->fetch() ?: null);
        exit;
    }
    echo json_encode([]);
    exit;
}
$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"] ?? "";
if ($action === "create") {
    $stmt = $conn->prepare("
        INSERT INTO drivers (driver_id, driver_name, vehicle_type, telephone)
        VALUES (?, ?, ?, ?)
        ON CONFLICT (driver_id) DO UPDATE SET
        driver_name=EXCLUDED.driver_name, vehicle_type=EXCLUDED.vehicle_type, telephone=EXCLUDED.telephone
    ");
    $stmt->execute([trim($data["driver_id"] ?? ""), trim($data["driver_name"] ?? ""), strtoupper(trim($data["vehicle_type"] ?? "")), trim($data["telephone"] ?? "")]);
    echo json_encode(["success" => true]);
    exit;
}
if ($action === "bulk_create") {
    $drivers = $data["drivers"] ?? [];
    $stmt = $conn->prepare("
        INSERT INTO drivers (driver_id, driver_name, vehicle_type, telephone)
        VALUES (?, ?, ?, ?)
        ON CONFLICT (driver_id) DO UPDATE SET
        driver_name=EXCLUDED.driver_name, vehicle_type=EXCLUDED.vehicle_type, telephone=EXCLUDED.telephone
    ");
    $importados=0; $ignorados=0; $erros=[];
    foreach ($drivers as $i=>$d) {
        $id=trim($d["driver_id"]??""); $name=trim($d["driver_name"]??""); $vehicle=strtoupper(trim($d["vehicle_type"]??"")); $tel=trim($d["telephone"]??"");
        if (!$id || !$name || !in_array($vehicle, ["FIORINO","PASSEIO","MOTO"])) { $ignorados++; $erros[]="Linha ".($i+2)." ignorada"; continue; }
        $stmt->execute([$id,$name,$vehicle,$tel]); $importados++;
    }
    echo json_encode(["success"=>true,"importados"=>$importados,"ignorados"=>$ignorados,"erros"=>$erros]);
    exit;
}
if ($action === "toggle") {
    $conn->prepare("UPDATE drivers SET active = NOT active WHERE driver_id=?")->execute([$data["driver_id"]]);
    echo json_encode(["success"=>true]); exit;
}
if ($action === "punish") {
    $conn->prepare("UPDATE drivers SET punished_until = NOW() + INTERVAL '15 hours' WHERE driver_id=?")->execute([$data["driver_id"]]);
    echo json_encode(["success"=>true]); exit;
}
if ($action === "remove_punish") {
    $conn->prepare("UPDATE drivers SET punished_until=NULL WHERE driver_id=?")->execute([$data["driver_id"]]);
    echo json_encode(["success"=>true]); exit;
}
echo json_encode(["error"=>"Ação inválida"]);
?>

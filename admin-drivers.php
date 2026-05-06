<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") exit;

require_once "auth.php";
require_admin();

require_once "db.php";
$conn = getConnection();

$VEICULOS = ["FIORINO", "PASSEIO", "MOTO", "VAN"];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $driverId = trim($_GET["driver_id"] ?? "");

    if ($driverId) {
        $stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_id = ?");
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
    $driverId = trim($data["driver_id"] ?? "");
    $driverName = trim($data["driver_name"] ?? "");
    $vehicleType = strtoupper(trim($data["vehicle_type"] ?? ""));
    $telephone = trim($data["telephone"] ?? "");

    if (!$driverId || !$driverName || !$vehicleType) {
        echo json_encode(["error" => "Preencha todos os campos"]);
        exit;
    }

    if (!in_array($vehicleType, $VEICULOS)) {
        echo json_encode(["error" => "Tipo de veículo inválido"]);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO drivers (driver_id, driver_name, vehicle_type, telephone)
        VALUES (?, ?, ?, ?)
        ON CONFLICT (driver_id) DO UPDATE SET
            driver_name = EXCLUDED.driver_name,
            vehicle_type = EXCLUDED.vehicle_type,
            telephone = EXCLUDED.telephone
    ");

    $stmt->execute([$driverId, $driverName, $vehicleType, $telephone]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "update") {
    $driverId = trim($data["driver_id"] ?? "");
    $vehicleType = strtoupper(trim($data["vehicle_type"] ?? ""));
    $telephone = trim($data["telephone"] ?? "");

    if (!$driverId || !$vehicleType) {
        echo json_encode(["error" => "Dados inválidos"]);
        exit;
    }

    if (!in_array($vehicleType, $VEICULOS)) {
        echo json_encode(["error" => "Tipo de veículo inválido"]);
        exit;
    }

    $stmt = $conn->prepare("
        UPDATE drivers
        SET vehicle_type = ?,
            telephone = ?
        WHERE driver_id = ?
    ");

    $stmt->execute([$vehicleType, $telephone, $driverId]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "bulk_create") {
    $drivers = $data["drivers"] ?? [];

    if (!is_array($drivers) || count($drivers) === 0) {
        echo json_encode(["error" => "Nenhum motorista enviado"]);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO drivers (driver_id, driver_name, vehicle_type, telephone)
        VALUES (?, ?, ?, ?)
        ON CONFLICT (driver_id) DO UPDATE SET
            driver_name = EXCLUDED.driver_name,
            vehicle_type = EXCLUDED.vehicle_type,
            telephone = EXCLUDED.telephone
    ");

    $importados = 0;
    $ignorados = 0;
    $erros = [];

    foreach ($drivers as $index => $d) {
        $linha = $index + 2;
        $driverId = trim($d["driver_id"] ?? "");
        $driverName = trim($d["driver_name"] ?? "");
        $vehicleType = strtoupper(trim($d["vehicle_type"] ?? ""));
        $telephone = trim($d["telephone"] ?? "");

        if (!$driverId || !$driverName || !$vehicleType) {
            $ignorados++;
            $erros[] = "Linha $linha ignorada: campos vazios";
            continue;
        }

        if (!in_array($vehicleType, $VEICULOS)) {
            $ignorados++;
            $erros[] = "Linha $linha ignorada: veículo inválido";
            continue;
        }

        try {
            $stmt->execute([$driverId, $driverName, $vehicleType, $telephone]);
            $importados++;
        } catch (Exception $e) {
            $ignorados++;
            $erros[] = "Linha $linha ignorada: erro ao salvar";
        }
    }

    echo json_encode([
        "success" => true,
        "importados" => $importados,
        "ignorados" => $ignorados,
        "erros" => $erros
    ]);
    exit;
}

if ($action === "toggle") {
    $stmt = $conn->prepare("UPDATE drivers SET active = NOT active WHERE driver_id = ?");
    $stmt->execute([$data["driver_id"]]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "punish") {
    $driverId = trim($data["driver_id"] ?? "");
    $amount = max(1, intval($data["amount"] ?? 15));
    $unit = $data["unit"] ?? "hours";

    if (!in_array($unit, ["minutes", "hours", "days"])) {
        $unit = "hours";
    }

    $stmt = $conn->prepare("
        UPDATE drivers
        SET punished_until = NOW() + (? || ' ' || ?)::interval
        WHERE driver_id = ?
    ");

    $stmt->execute([$amount, $unit, $driverId]);
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "remove_punish") {
    $stmt = $conn->prepare("UPDATE drivers SET punished_until = NULL WHERE driver_id = ?");
    $stmt->execute([$data["driver_id"]]);
    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["error" => "Ação inválida"]);
?>
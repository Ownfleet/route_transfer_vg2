<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

require_once "db.php";
$conn = getConnection();

function haversineMeters($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371000;

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c;
}

$data = json_decode(file_get_contents("php://input"), true);

$driverId = trim($data["driver_id"] ?? "");
$latitude = floatval($data["latitude"] ?? 0);
$longitude = floatval($data["longitude"] ?? 0);
$accuracy = isset($data["accuracy"]) ? floatval($data["accuracy"]) : null;

if (!$driverId || !$latitude || !$longitude) {
    echo json_encode([
        "success" => false,
        "error" => "Não foi possível validar sua presença.",
        "reason" => "missing_data"
    ]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_id = ?");
$stmt->execute([$driverId]);
$driver = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$driver) {
    echo json_encode([
        "success" => false,
        "error" => "Motorista não encontrado.",
        "reason" => "driver_not_found"
    ]);
    exit;
}

if (!$driver["active"]) {
    echo json_encode([
        "success" => false,
        "error" => "Não foi possível registrar sua presença.",
        "reason" => "driver_inactive"
    ]);
    exit;
}

if (!empty($driver["punished_until"]) && strtotime($driver["punished_until"]) > time()) {
    echo json_encode([
        "success" => false,
        "error" => "Não foi possível registrar sua presença.",
        "reason" => "driver_blocked"
    ]);
    exit;
}

$stmt = $conn->query("SELECT * FROM hub_config WHERE id = 1");
$config = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$config) {
    echo json_encode([
        "success" => false,
        "error" => "Galpão ainda não configurado.",
        "reason" => "hub_not_configured"
    ]);
    exit;
}

$hubLat = floatval($config["latitude"]);
$hubLon = floatval($config["longitude"]);
$radius = intval($config["radius_meters"]);

$distance = haversineMeters($hubLat, $hubLon, $latitude, $longitude);
$inside = $distance <= $radius;

if (!$inside) {
    echo json_encode([
        "success" => false,
        "error" => "Você está fora do raio permitido do galpão.",
        "reason" => "outside_radius",
        "distance_meters" => round($distance, 2),
        "radius_meters" => $radius,
        "accuracy_meters" => $accuracy,
        "hub" => [
            "name" => $config["hub_name"],
            "latitude" => $hubLat,
            "longitude" => $hubLon
        ],
        "driver_position" => [
            "latitude" => $latitude,
            "longitude" => $longitude
        ]
    ]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO driver_waiting_hub
    (driver_id, driver_name, vehicle_type, telephone, latitude, longitude, distance_meters, status, waiting_date, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, 'aguardando', CURRENT_DATE, NOW())
    ON CONFLICT (driver_id, waiting_date) DO UPDATE SET
        driver_name = EXCLUDED.driver_name,
        vehicle_type = EXCLUDED.vehicle_type,
        telephone = EXCLUDED.telephone,
        latitude = EXCLUDED.latitude,
        longitude = EXCLUDED.longitude,
        distance_meters = EXCLUDED.distance_meters,
        status = 'aguardando',
        created_at = NOW()
");

$stmt->execute([
    $driver["driver_id"],
    $driver["driver_name"],
    $driver["vehicle_type"],
    $driver["telephone"] ?? "",
    $latitude,
    $longitude,
    round($distance, 2)
]);

echo json_encode([
    "success" => true,
    "message" => "Presença registrada. Você está aguardando rota no galpão.",
    "distance_meters" => round($distance, 2),
    "radius_meters" => $radius,
    "accuracy_meters" => $accuracy,
    "hub" => [
        "name" => $config["hub_name"],
        "latitude" => $hubLat,
        "longitude" => $hubLon
    ],
    "driver_position" => [
        "latitude" => $latitude,
        "longitude" => $longitude
    ]
]);

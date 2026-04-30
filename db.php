<?php

function getConnection() {
    $databaseUrl = getenv("DATABASE_URL");

    if (!$databaseUrl) {
        http_response_code(500);
        echo json_encode(["error" => "DATABASE_URL não configurada"]);
        exit;
    }

    $url = parse_url($databaseUrl);

    $host = $url["host"];
    $port = $url["port"] ?? 5432;
    $user = $url["user"];
    $pass = $url["pass"];
    $dbname = ltrim($url["path"], "/");

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

    try {
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
    "error" => "Erro ao conectar no banco",
    "details" => $e->getMessage()
]);
        exit;
    }
}
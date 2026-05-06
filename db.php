<?php
function getConnection() {
    $databaseUrl = getenv("DATABASE_URL");

    if (!$databaseUrl) {
        throw new Exception("DATABASE_URL não encontrada no Railway.");
    }

    $parts = parse_url($databaseUrl);

    if (!$parts) {
        throw new Exception("DATABASE_URL inválida.");
    }

    $host = $parts["host"] ?? "";
    $port = $parts["port"] ?? 5432;
    $user = rawurldecode($parts["user"] ?? "");
    $pass = rawurldecode($parts["pass"] ?? "");
    $db   = ltrim($parts["path"] ?? "", "/");

    if (!$host || !$user || !$pass || !$db) {
        throw new Exception("DATABASE_URL incompleta.");
    }

    $dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode=require";

    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
?>
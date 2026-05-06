<?php
function getConnection() {
    $host = getenv("PGHOST");
    $port = getenv("PGPORT") ?: "5432";
    $db   = getenv("PGDATABASE") ?: "postgres";
    $user = getenv("PGUSER");
    $pass = getenv("PGPASSWORD");

    if (!$host || !$user || !$pass) {
        throw new Exception("Variáveis PGHOST, PGUSER ou PGPASSWORD não configuradas.");
    }

    $dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode=require";

    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
?>
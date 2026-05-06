<?php
function getConnection() {
    $databaseUrl = getenv("DATABASE_URL");

    if ($databaseUrl) {
        $parts = parse_url($databaseUrl);
        $host = $parts["host"] ?? "";
        $port = $parts["port"] ?? 5432;
        $user = $parts["user"] ?? "";
        $pass = $parts["pass"] ?? "";
        $db = ltrim($parts["path"] ?? "", "/");
    } else {
        $host = getenv("PGHOST") ?: "COLOQUE_HOST_DO_SUPABASE";
        $port = getenv("PGPORT") ?: "5432";
        $db = getenv("PGDATABASE") ?: "postgres";
        $user = getenv("PGUSER") ?: "COLOQUE_USER_DO_SUPABASE";
        $pass = getenv("PGPASSWORD") ?: "COLOQUE_SENHA_DO_BANCO";
    }

    $dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode=require";

    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
?>

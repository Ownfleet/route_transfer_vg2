<?php
header("Content-Type: text/plain; charset=utf-8");

$url = getenv("DATABASE_URL");

echo "DATABASE_URL LIDA PELO PHP:\n";

if (!$url) {
    echo "NÃO ENCONTROU DATABASE_URL";
    exit;
}

$masked = preg_replace('/:(.*?)@/', ':SENHA_OCULTA@', $url);
echo $masked . "\n\n";

$parts = parse_url($url);

echo "USUARIO IDENTIFICADO:\n";
echo $parts["user"] ?? "SEM USER";

echo "\n\nHOST:\n";
echo $parts["host"] ?? "SEM HOST";
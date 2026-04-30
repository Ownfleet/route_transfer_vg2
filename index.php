<?php
header("Content-Type: application/json; charset=utf-8");

echo json_encode([
    "status" => "online",
    "message" => "API do sistema de repasse de rotas rodando em PHP"
]);
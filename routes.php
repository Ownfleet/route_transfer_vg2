<?php
header("Content-Type: text/plain; charset=utf-8");

require_once "db.php";

try {
    $conn = getConnection();
    echo "CONECTOU COM BANCO\n";

    $stmt = $conn->query("SELECT COUNT(*) AS total FROM routes");
    $row = $stmt->fetch();

    echo "Total de rotas: " . $row["total"];
} catch (Exception $e) {
    http_response_code(500);
    echo "ERRO AO CONECTAR:\n";
    echo $e->getMessage();
}
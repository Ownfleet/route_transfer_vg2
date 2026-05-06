<?php
session_start();
function require_admin() {
    if (empty($_SESSION["admin_logged"])) {
        http_response_code(401);
        exit;
    }
}
?>

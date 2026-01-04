<?php


class AuthMiddleware {
    
    public static function checkRole(string $role) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        if ($_SESSION['user_id']['role'] !== $role) {
            header("HTTP/1.1 403 Forbidden");
            echo "Access Denied!";
            exit();
        }
    }
}

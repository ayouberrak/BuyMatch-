<?php

session_start();








class LogoutController
{
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: homePageControllers.php");
        exit();
    }
}

$logoutController = new LogoutController();
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $logoutController->logout();
}


require_once __DIR__ . '/../Views/homePage.view.php';
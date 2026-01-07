<?php

session_start();

require_once __DIR__ . '/../Services/EventServices.php';

class HomePageControllers
{
    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }
    public function getAllEvents(): array
    {
        return $this->eventServices->getAllEvents();
    }
}

$homePageControllers = new HomePageControllers();
$events = $homePageControllers->getAllEvents();





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
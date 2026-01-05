<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';

class LoginController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require_once __DIR__ . '/../Views/auth/conexion.view.php';
            return;
        }

        if (empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: /login?error=empty');
            exit();
        }

        try {
            $authService = new AuthService(new UserRepository());
            $user = $authService->login(
                $_POST['email'],
                $_POST['password']
            );

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['role'] = $user->getRole();

            switch ($user->getRole()) {
                case 'admin':
                    header('Location: /admin');
                    break;
                case 'organisateur':
                    header('Location: OrganisateurController.php');
                    break;
                default:
                    header('Location: /acheteur');
            }
            exit();

        } catch (Exception $e) {
            header('Location: /login?error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}


$LoginController = new LoginController();
$LoginController->login();


require_once __DIR__ . '/../Views/auth/conexion.view.php';

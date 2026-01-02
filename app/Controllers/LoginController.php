<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../Models/User.php';
class LoginController
{
    public function login($method){
        if(!empty($method['email']) && !empty($method['password'])){
            $password = $method['password'];
            $email = $method['email'];
            $user = new User();
            if($userF = $user->login($email, $password)){
                session_start();
                // $_SESSION['user'] = $userF['id'];
                $_SESSION['role'] = $userF['role'];
                if($userF['role'] === 'admin'){
                    header('Location: admin.php');
                     exit();
                }elseif($userF['role'] === 'organisateur'){
                    header('Location: organisateur.php');
                     exit();
                }else{
                    header('Location: acheteur.php');
                     exit();
                }

            } else {
                header('Location: LoginController.php?error=1');
                exit();
            }

        } else {
            throw new Exception("Email and password are required.");
        }

    }
}

$userController = new LoginController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->login($_POST);
    exit();
}







require_once __DIR__ . '/../Views/auth/conexion.view.php';
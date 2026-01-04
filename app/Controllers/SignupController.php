<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/UserRepository.php';

class SignupController
{
    public function signUp()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require_once __DIR__ . '/../Views/auth/sinup.view.php';
            return;
        }

        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
            throw new Exception("All fields are required");
        }

            $file_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $new_file_name = 'image_' . time() . '.' . $file_extension;
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $uploadPath = $uploadDir . $new_file_name;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadPath)) {
                $service = new AuthService(new UserRepository());
                $service->signup($_POST, $new_file_name); 

                header('Location: LoginController.php?success=1');
                exit();
            } else {
                throw new Exception("Failed to upload image");
            }


    }
}

$controller = new SignupController();
$controller->signUp();

require_once  __DIR__ . '/../Views/auth/sinup.view.php';
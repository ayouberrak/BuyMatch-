<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../Models/User.php';
class SignupController
{
    public function signUp($method){

        $file_name = pathinfo($_FILES['avatar']['name'], PATHINFO_FILENAME);
        $file_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

        $new_file_name =  'image_' . time() . '.' . $file_extension;
        $uploadDir = __DIR__ . '/../../public/uploads/';


        $upload_path = $uploadDir . $new_file_name;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)) {
            $user = new User();
            $user->setName($method['name']);
            $user->setEmail($method['email']);
            $user->setPassword($method['password']);
            $user->setPhoto($new_file_name);
            $user->setRole($method['role']);
            $user->setStatus('actif');

            $user->sigupnUp();
        } else {
            throw new Exception("Failed to upload file.");
        }        

    }

}


$userController = new SignupController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->signUp($_POST);
    header('Location: SignupController.php?success=1');
    exit();
}


require_once  __DIR__ . '/../Views/auth/sinup.view.php';
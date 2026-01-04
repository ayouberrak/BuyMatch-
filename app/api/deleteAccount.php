<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Repository/UserRepository.php';


$userRepo = new UserRepository();
// Lire les données JSON
$input = json_decode(file_get_contents('php://input'), true);


$userId = $_SESSION['user_id'];
$user = $userRepo->deleteUser($userId);
if ($user) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Compte supprimé avec succès !'
    ]);
    header('Location: /logout.php');
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Échec de la suppression du compte.'
    ]);
}
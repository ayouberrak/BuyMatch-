<?php
// session_start();
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

$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$password = trim($input['password'] ?? '');

if (empty($name) || empty($email)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Le nom et l\'email sont obligatoires.'
    ]);
    exit;
}

// Récupérer l'utilisateur connecté
$userId = $_SESSION['user_id'];
$user = $userRepo->findById($userId);

if (!$user) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Utilisateur introuvable.'
    ]);
    exit;
}

// Mettre à jour les données
$user->setName($name);
$user->setEmail($email);

if (!empty($password)) {
    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
}

$updated = $userRepo->updateUser($user);

if ($updated) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Profil mis à jour avec succès !'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Impossible de mettre à jour le profil.'
    ]);
}

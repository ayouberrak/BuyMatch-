<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// session_start();
    // $userId = $_SESSION['user_id'];
    // echo $userId;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/equipe.php';
require_once __DIR__ . '/../Models/Organisateur.php';
require_once __DIR__ . '/../Services/EventServices.php';

require_once __DIR__ . '/../Repository/EventRepository.php';
require_once __DIR__ . '/../Repository/UserRepository.php';

class AddEventAPI {
    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }

    public function createEvent(array $organisateurData, array $eventData, array $equipe1Data, array $equipe2Data): bool
    {
        $userRepo = new UserRepository();
        $user = $userRepo->findById((int)$organisateurData['id']);
        if (!$user) {
            throw new Exception("Organisateur introuvable.");
        }

        $organisateur = new Organisateur(
            $user->getId(),
            $user->getName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhoto(),
            $user->getRole(),
            $user->getStatus()
        );
        
        // file for mignature upload
        $filename =pathinfo($eventData['mignature']['name'], PATHINFO_FILENAME);
        $extension = pathinfo($eventData['mignature']['name'], PATHINFO_EXTENSION);
        $newFilename = "mignature" . '_' . time() . '.' . $extension;
        $uploadDir = __DIR__ . '/../../public/uploads_mignature/';
        if(!move_uploaded_file($eventData['mignature']['tmp_name'], $uploadDir . $newFilename)) {
            throw new Exception("Erreur lors du téléchargement de la mignature.");
        }
        $eventData['mignature'] = $newFilename;

        // file for equipe1 logo upload
        $filename1 =pathinfo($equipe1Data['logo']['name'], PATHINFO_FILENAME);
        $extension1 = pathinfo($equipe1Data['logo']['name'], PATHINFO_EXTENSION);
        $newFilename1 = "logo_equipe1" . '_' . time() . '.' . $extension1;
        $uploadDir1 = __DIR__ . '/../../public/uploads_logo_equipe/';
        if(!move_uploaded_file($equipe1Data['logo']['tmp_name'], $uploadDir1 . $newFilename1)) {
            throw new Exception("Erreur lors du téléchargement du logo de l'équipe 1.");
        }
        $equipe1Data['logo'] = $newFilename1;

        // file for equipe2 logo upload
        $filename2 =pathinfo($equipe2Data['logo']['name'], PATHINFO_FILENAME);
        $extension2 = pathinfo($equipe2Data['logo']['name'], PATHINFO_EXTENSION);
        $newFilename2 = "logo_equipe2" . '_' . time() . '.' . $extension2;
        $uploadDir2 = __DIR__ . '/../../public/uploads_logo_equipe/';
        if(!move_uploaded_file($equipe2Data['logo']['tmp_name'], $uploadDir2 . $newFilename2)) {
            throw new Exception("Erreur lors du téléchargement du logo de l'équipe 2.");
        }
        $equipe2Data['logo'] = $newFilename2;


            $equipe1 = new Equipe(
            null, 
            $equipe1Data['nom'],
            $newFilename1
        );

        $equipe2 = new Equipe(
            null,
            $equipe2Data['nom'],
            $newFilename2
        );

        $event = new Event(
            null, 
            $eventData['titre'],
            $newFilename,
            $eventData['date_event'],
            $eventData['lieu'],
            'en_attente',
            $organisateur->getId(),
            0,
            $equipe1->getId(),
            $equipe2->getId()
        );

        return $this->eventServices->createEvent($organisateur, $event, $equipe1, $equipe2);
    }
}

$requiredFields = ['titre','date_event','lieu','equipe1_nom','equipe2_nom'];
$requiredFiles = ['mignature','equipe1_logo','equipe2_logo'];

foreach ($requiredFields as $f) {
    if (empty($_POST[$f])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => "Champ manquant : $f"]);
        exit;
    }
}

foreach ($requiredFiles as $f) {
    if (!isset($_FILES[$f]) || $_FILES[$f]['error'] !== 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => "Fichier manquant : $f"]);
        exit;
    }
}




$addEventAPI = new AddEventAPI();
try {

    $organisateurData = [
        'id' => $_SESSION['user_id']
    ];



    $equipe1Data = [
        'nom' => $_POST['equipe1_nom'],
        'logo' => $_FILES['equipe1_logo']
    ];

    $equipe2Data = [
        'nom' => $_POST['equipe2_nom'],
        'logo' => $_FILES['equipe2_logo']
    ];

    $eventData = [
        'titre' => $_POST['titre'],
        'mignature' => $_FILES['mignature'],
        'date_event' => $_POST['date_event'],
        'lieu' => $_POST['lieu']
    ];

    $success = $addEventAPI->createEvent($organisateurData, $eventData, $equipe1Data, $equipe2Data);

    if ($success) {
        echo json_encode(['status' =>'success', 'message' => "Événement créé avec succès."]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => "Échec de la création de l'événement."]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}



// echo $_SESSION['user_id'];
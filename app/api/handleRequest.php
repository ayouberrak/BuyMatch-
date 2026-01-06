<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Services/EventServices.php';

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
class HandleRequest {

    private EventServices $eventServices;

    public function __construct()
    {
        $this->eventServices = new EventServices();
    }

    public function handle(int $id, string $action): bool
    {
        $newStatus = $action === 'accepted' ? 'valide' : 'refuse';
        return $this->eventServices->updateEventStatus($id, $newStatus);
    }
}


$handleRequest = new HandleRequest();
$handleRequest->handle($input['requestId'], $input['action']);
echo json_encode(['status' => 'success']);

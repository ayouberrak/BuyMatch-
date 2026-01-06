<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../Services/CommentsService.php';

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

class DeleteComment {

    private CommentsService $commentsService;

    public function __construct()
    {
        $this->commentsService = new CommentsService();
    }

    public function deleteComment(int $id): bool
    {
        return $this->commentsService->deleteComment($id);
    }
    
}

$deleteComment = new DeleteComment();

$id = (int) $input['commentId'];
$deleted = $deleteComment->deleteComment($id);
if ($deleted) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Suppression échouée']);
}
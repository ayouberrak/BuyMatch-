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

    public function deleteComment(int $commentId): bool
    {
        return $this->commentsService->deleteComment($commentId);
    }
    
}

$deleteComment = new DeleteComment();
$deleteComment->deleteComment($input['commentId']);
// echo json_encode(['status' => 'success']);
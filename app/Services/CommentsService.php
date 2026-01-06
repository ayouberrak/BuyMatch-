<?php


require_once __DIR__ . '/../Models/Commentaires.php';
require_once __DIR__ . '/../Repository/CommentairesRepository.php';


class CommentsService {

    private CommentairesRepository $commentairesRepository;

    public function __construct()
    {
        $this->commentairesRepository = new CommentairesRepository();
    }

    public function getCommentsByOrganisateur(int $organisateurId): array
    {
        return $this->commentairesRepository->getCommentsByOrganisateurId($organisateurId);
    }
    
}
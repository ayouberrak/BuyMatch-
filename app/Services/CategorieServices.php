<?php


require_once __DIR__ . '/../Repository/CategorieRepository.php';

class CategorieServices
{
    private CategorieRepository $categorieRepository;

    public function __construct()
    {
        $this->categorieRepository = new CategorieRepository();
    }

    public function getAllCategories(): array
    {
        return $this->categorieRepository->getAllCategories();
    }
}
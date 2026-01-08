<?php


require_once __DIR__ . '/../Services/CategorieServices.php';



class CategorieControllers
{
    private CategorieServices $categorieServices;

    public function __construct()
    {
        $this->categorieServices = new CategorieServices();
    }

    public function getAllCategories(): array
    {
        return $this->categorieServices->getAllCategories();
    }
}

$categorieControllers = new CategorieControllers();
$categories = $categorieControllers->getAllCategories();
// print_r($categories);
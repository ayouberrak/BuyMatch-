<?php


require_once __DIR__ . '/User.php';

class Organisateur extends User{

    public function  createEvent() {
        return $this->getRole() === 'organisateur' && $this->getStatus() === 'actif';
    
    }
};


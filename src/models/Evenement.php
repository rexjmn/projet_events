<?php
// src/models/Evenement.php
namespace App\Models;

class Evenement {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Métodos a implementar más tarde
}
<?php
namespace App\Models;

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($name, $email, $password, $role) {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, :role)");
        return $stmt->execute([
            'nom' => $name,
            'email' => $email,
            'mot_de_passe' => $password,
            'role' => $role
        ]);
    }
}
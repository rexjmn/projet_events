<?php
namespace App\Models;

use PDO;
class Lieu {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterLieux($nom_lieu, $adresse, $code_postal) {
        $stmt = $this->pdo->prepare("INSERT INTO lieux (nom_lieu, adresse, code_postal) 
                                     VALUES (:nom_lieu, :adresse, :code_postal)");
        $stmt->bindParam(':nom_lieu', $nom_lieu);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':code_postal', $code_postal);
        return $stmt->execute();
    }

    public function obtenirTousLieux() {
        $stmt = $this->pdo->prepare("SELECT * FROM lieux");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modifierLieux($id_lieu, $nom_lieu, $adresse, $code_postal) {
        $stmt = $this->pdo->prepare("UPDATE lieux SET nom_lieu = :nom_lieu, adresse = :adresse, code_postal = :code_postal 
                                     WHERE id_lieu = :id_lieu");
        $stmt->bindParam(':nom_lieu', $nom_lieu);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':code_postal', $code_postal);
        $stmt->bindParam(':id_lieu', $id_lieu);
        return $stmt->execute();
    }

    public function supprimerLieu($id_lieu) {
        $stmt = $this->pdo->prepare("DELETE FROM lieux WHERE id_lieu = :id_lieu");
        $stmt->bindParam(':id_lieu', $id_lieu);
        return $stmt->execute();
    }
}
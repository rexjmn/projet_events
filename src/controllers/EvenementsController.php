<?php
namespace App\Controllers;

use PDO;
use Exception;

class EvenementsController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        // Verificar si el usuario es admin
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            header("Location: ?page=login");
            exit();
        }

        try {
            // Manejar creación de eventos
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (empty($_POST["titre"]) || empty($_POST["description"]) || 
                    empty($_POST["date_debut"]) || empty($_POST["date_fin"]) || 
                    empty($_POST["id_lieu"])) {
                    throw new Exception("Tous les champs sont obligatoires");
                }

                $stmt = $this->pdo->prepare("INSERT INTO evenements (titre, description, date_debut, date_fin, id_lieu) 
                                            VALUES (:titre, :description, :date_debut, :date_fin, :id_lieu)");
                $stmt->execute([
                    ":titre" => htmlspecialchars($_POST["titre"]),
                    ":description" => htmlspecialchars($_POST["description"]),
                    ":date_debut" => $_POST["date_debut"],
                    ":date_fin" => $_POST["date_fin"],
                    ":id_lieu" => $_POST["id_lieu"]
                ]);

                $_SESSION["success_message"] = "Événement créé avec succès";
                header("Location: ?page=evenements");
                exit();
            }

            // Manejar eliminación de eventos
            if (isset($_GET["delete"])) {
                $stmt = $this->pdo->prepare("DELETE FROM evenements WHERE id_evenement = :id");
                $stmt->execute([":id" => $_GET["delete"]]);
                
                $_SESSION["success_message"] = "Événement supprimé avec succès";
                header("Location: ?page=evenements");
                exit();
            }

            // Listar eventos
            $stmt = $this->pdo->query("SELECT e.*, l.nom_lieu 
                                      FROM evenements e 
                                      LEFT JOIN lieux l ON e.id_lieu = l.id_lieu");
            $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Listar lugares para el formulario
            $stmt = $this->pdo->query("SELECT * FROM lieux");
            $lieux = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
        }

        // Renderizar la vista
        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/evenements.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
    }
}
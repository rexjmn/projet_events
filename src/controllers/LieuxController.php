<?php
namespace App\Controllers;

use PDO;
use Exception;
use App\Models\Lieu;

class LieuxController {
    private $pdo;
    private $lieu;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->lieu = new Lieu($pdo);
    }

    public function index() {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            header("Location: ?page=login");
            exit();
        }

        try {
            // Manejar creación de lugares
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
                if (empty($_POST["nom_lieu"]) || empty($_POST["adresse"]) || empty($_POST["code_postal"])) {
                    throw new Exception("Tous les champs sont obligatoires");
                }

                if ($_POST['action'] === 'add') {
                    $this->lieu->ajouterLieux(
                        htmlspecialchars($_POST["nom_lieu"]),
                        htmlspecialchars($_POST["adresse"]),
                        htmlspecialchars($_POST["code_postal"])
                    );
                    $_SESSION["success_message"] = "Lieu créé avec succès";
                } elseif ($_POST['action'] === 'edit' && !empty($_POST['id_lieu'])) {
                    $this->lieu->modifierLieux(
                        $_POST["id_lieu"],
                        htmlspecialchars($_POST["nom_lieu"]),
                        htmlspecialchars($_POST["adresse"]),
                        htmlspecialchars($_POST["code_postal"])
                    );
                    $_SESSION["success_message"] = "Lieu modifié avec succès";
                }

                header("Location: ?page=lieux");
                exit();
            }

            // Manejar eliminación de lugares
            if (isset($_GET["delete"])) {
                $this->lieu->supprimerLieu($_GET["delete"]);
                $_SESSION["success_message"] = "Lieu supprimé avec succès";
                header("Location: ?page=lieux");
                exit();
            }

            // Listar lugares
            $lieux = $this->lieu->obtenirTousLieux();

        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
        }

        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/lieux.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
    }

    public function listLieux() {
        return $this->lieu->obtenirTousLieux();
    }
}
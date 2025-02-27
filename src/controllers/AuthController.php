<?php
namespace App\Controllers;

use Exception;
use PDO;

class AuthController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        ob_start();

        echo "Entrando a login()<br>";
        echo "Método recibido: " . $_SERVER['REQUEST_METHOD'] . "<br>";
        echo "POST recibido: ";
        var_dump($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Procesando POST<br>";
            try {
                require_once __DIR__ . '/../../utils/helpers.php';

                $email = clean_input($_POST['email'] ?? '');
                $password = clean_input($_POST['password'] ?? '');

                echo "Email: $email<br>";
                echo "Password: $password<br>";

                if (!$email || !$password) {
                    throw new Exception("Email et mot de passe sont obligatoires");
                }

                $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "Usuario encontrado: ";
                var_dump($user);

                if ($user && password_verify($password, $user['mot_de_passe'])) {
                    $_SESSION['user_id'] = $user['id_utilisateur'];
                    $_SESSION['username'] = $user['nom'];
                    $_SESSION['role'] = $user['role'];

                    echo "Sesión establecida: ";
                    var_dump($_SESSION);

                    $_SESSION['success_message'] = "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['nom']);
                    ob_clean();
                    header('Location: ?page=home');
                    exit;
                } else {
                    throw new Exception("Email ou mot de passe incorrect");
                }
            } catch (Exception $e) {
                $_SESSION['error_message'] = $e->getMessage();
                echo "Error capturado: " . $e->getMessage() . "<br>";
                ob_clean();
                header('Location: ?page=login');
                exit;
            }
        } else {
            echo "No es POST<br>";
        }

        // Incluir el layout completo
        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/login.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
        ob_end_flush();
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                require_once __DIR__ . '/../../utils/helpers.php';

                $name = clean_input($_POST['name'] ?? '');
                $email = clean_input($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';

                if (!$name || !$email || !$password) {
                    throw new Exception("Tous les champs sont obligatoires");
                }
                if (strlen($password) < 8) {
                    throw new Exception("Le mot de passe doit avoir au moins 8 caractères");
                }

                $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                if ($stmt->fetch()) {
                    throw new Exception("Cet email est déjà utilisé");
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $role = 'user';
                $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, :role)");
                $stmt->execute([
                    'nom' => $name,
                    'email' => $email,
                    'mot_de_passe' => $hashedPassword,
                    'role' => $role
                ]);

                $_SESSION['success_message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header('Location: ?page=login');
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = $e->getMessage();
            }
        }

        // Incluir el layout completo
        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/signup.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ?page=login');
        exit;
    }
}
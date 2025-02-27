<?php
namespace App\Controllers;
use PDO;
class HomeController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/home.php';
        require_once __DIR__ . '/../../views/login.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
    }

    public function about() {
        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/about.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
    }

    public function contact() {
        require_once __DIR__ . '/../../views/layouts/header.php';
        require_once __DIR__ . '/../../views/contact.php';
        require_once __DIR__ . '/../../views/layouts/footer.php';
    }


}
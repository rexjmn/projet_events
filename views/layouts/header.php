<?php
// views/layouts/header.php
require_once __DIR__ . '/../../utils/session.php';

// Definir la página actual
$currentPage = isset($_GET["page"]) ? $_GET["page"] : 'home';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet PHP - Événements</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init();
        });
    </script>
</head>
<body class="relative min-h-screen">
    <!-- Mostrar mensajes de sesión -->
    <?php displaySessionMessages(); ?>

    <!-- Video de fondo -->
    <video 
    data-aos="fade" 
    src="<?php echo '/project_events/public/assets/flames1.mp4'; ?>" 
    autoplay 
    loop 
    muted 
    class="absolute top-0 left-0 w-full h-full object-cover"
></video>

    <header data-aos="fade-down">
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
            <!-- Navegación para Admin -->
            <nav class="admin flex justify-between bg-black/50 backdrop-blur-md py-5 fixed top-0 left-0 right-0 z-20">
                <div class="flex gap-5 items-center px-10 text-white">
                    <span class="text-white">
                        Bonjour, <?php echo htmlspecialchars($_SESSION["username"] ?? ''); ?>
                    </span>
                    <span class="text-white">Rôle : ADMIN</span>
                    <a href="?page=logout" class="text-white hover:text-yellow-500 transition-colors">LOGOUT</a>
                </div>
            </nav>
            
            <!-- Sidebar para Admin -->
            <div class="h-screen w-[400px] bg-gray-900 fixed left-0 top-[70px] z-10 shadow-lg overflow-y-auto">
                <h2 class="text-2xl text-white text-center py-6 border-b border-gray-700">Tableau de Bord Admin</h2>
                <ul class="text-white space-y-4 py-6 px-4">
                    <li><a href="?page=evenements" class="block text-lg hover:bg-gray-700 rounded-lg p-3 transition duration-200">Événements</a></li>
                    <li><a href="?page=lieux" class="block text-lg hover:bg-gray-700 rounded-lg p-3 transition duration-200">Lieux</a></li>
                </ul>
            </div>
        <?php else: ?>
            <!-- Navegación para Usuarios -->
            <nav class="user flex justify-between bg-black/50 backdrop-blur-md py-5 fixed top-0 left-0 right-0 z-10">
                <ul class="flex text-xl gap-10 justify-end text-white items-center px-10">
                    <li><a class="<?php echo $currentPage === 'home' ? 'text-yellow-500' : 'hover:text-yellow-500 transition-colors'; ?>" href="?page=home">HOME</a></li>
                    <li><a class="<?php echo $currentPage === 'about' ? 'text-yellow-500' : 'hover:text-yellow-500 transition-colors'; ?>" href="?page=about">ABOUT</a></li>
                    <li><a class="<?php echo $currentPage === 'contact' ? 'text-yellow-500' : 'hover:text-yellow-500 transition-colors'; ?>" href="?page=contact">CONTACT</a></li>
                </ul>
                <div class="flex gap-5 items-center px-10 text-white">
                    <?php if (isset($_SESSION["username"])): ?>
                        <span class="text-white">Bonjour, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                        <a href="?page=logout" class="text-white hover:text-yellow-500 transition-colors">LOGOUT</a>
                    <?php else: ?>
                        <a href="?page=login" class="text-white hover:text-yellow-500 transition-colors">LOGIN</a>
                        <a href="?page=signup" class="text-white hover:text-yellow-500 transition-colors">SIGNUP</a>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif; ?>
    </header>
<?php
function getDatabaseConnection() {
    $dsn = "mysql:host=localhost;dbname=projet-php;charset=utf8;port=3306";
    $user = "osm";
    $pass = "osm";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        throw new PDOException("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
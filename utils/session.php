<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function displaySessionMessages() {
    if (isset($_SESSION["success_message"])) {
        echo '<div class="alert alert-success fixed top-5 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded">' . 
             htmlspecialchars($_SESSION["success_message"]) . 
             '</div>';
        unset($_SESSION["success_message"]);
    }
    if (isset($_SESSION["error_message"])) {
        echo '<div class="alert alert-danger fixed top-5 right-5 z-50 bg-red-500 text-white px-6 py-3 rounded">' . 
             htmlspecialchars($_SESSION["error_message"]) . 
             '</div>';
        unset($_SESSION["error_message"]);
    }
}
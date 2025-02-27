<?php
$storedHash = '$2y$10$CNqLREa3RS6kRq1qmdNduOAFQV3xSb2lOSDsIvJ4kfhjE6yEl15l6';
$password = '1234';
if (password_verify($password, $storedHash)) {
    echo "Password correcto!";
} else {
    echo "Password incorrecto.";
}
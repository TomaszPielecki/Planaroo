<?php
// Połączenie z bazą danych MySQL
// $host = 'localhost';
// $dbname = 'tomawebp_projekty_firma'; // Upewnij się, że to jest poprawna nazwa bazy danych
// $user = 'tomawebp_projekty_firma';
// $password = 'qDdntdcbVNg3bc2yR9ug';

// Połączenie z bazą danych MySQL
$host = 'localhost';
$dbname = 'projekty_firma'; // Upewnij się, że to jest poprawna nazwa bazy danych
$user = 'root';
$password = '';

try {
    // Tworzenie połączenia
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password); // Poprawione $dbname
    // Ustawianie trybu błędów PDO na wyjątki
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Obsługa błędu połączenia
    echo "Błąd połączenia: " . $e->getMessage();
    exit;
}
?>
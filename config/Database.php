<?php
class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $config = require __DIR__ . '/../config/config.php';
        $db_config = $config['db'];
        
        try {
            $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            
            $this->pdo = new PDO($dsn, $db_config['username'], $db_config['password'], $options);
        } catch (PDOException $e) {
            die("Błąd połączenia z bazą danych: " . $e->getMessage());
        }
    }
    
    // Zapobiega klonowaniu instancji
    private function __clone() {}
    
    // Singleton pattern - zwraca instancję klasy
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    // Pobierz obiekt PDO do wykonywania zapytań
    public function getConnection() {
        return $this->pdo;
    }
}
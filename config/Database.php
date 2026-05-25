<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config    = require __DIR__ . '/../config/config.php';
        $db_config = $config['db'];
        $driver    = $db_config['driver'] ?? 'mysql';

        try {
            if ($driver === 'sqlite') {
                $path = $db_config['path'];
                $dir  = dirname($path);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                $dsn = "sqlite:{$path}";
                $this->pdo = new PDO($dsn, null, null, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
                $this->pdo->exec('PRAGMA foreign_keys = ON');
                $this->initializeSqlite();
            } else {
                $port = $db_config['port'] ?? 3306;
                $dsn  = "mysql:host={$db_config['host']};port={$port};dbname={$db_config['dbname']};charset={$db_config['charset']}";
                $this->pdo = new PDO($dsn, $db_config['username'], $db_config['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            }
        } catch (PDOException $e) {
            die("Błąd połączenia z bazą danych: " . $e->getMessage());
        }
    }

    private function initializeSqlite() {
        $exists = $this->pdo
            ->query("SELECT name FROM sqlite_master WHERE type='table' AND name='projekty'")
            ->fetch();
        if ($exists) return;

        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS projekty (
                id               INTEGER PRIMARY KEY AUTOINCREMENT,
                nazwa            TEXT    NOT NULL,
                opis             TEXT,
                data_rozpoczecia TEXT    NOT NULL,
                data_zakonczenia TEXT    DEFAULT NULL,
                status           TEXT    NOT NULL DEFAULT 'w trakcie',
                odpowiedzialny   TEXT    NOT NULL,
                data_utworzenia  TEXT    DEFAULT (datetime('now','localtime'))
            );

            CREATE TABLE IF NOT EXISTS zadania (
                id              INTEGER PRIMARY KEY AUTOINCREMENT,
                nazwa           TEXT NOT NULL,
                opis            TEXT,
                termin          TEXT NOT NULL,
                status          TEXT NOT NULL DEFAULT 'do zrobienia',
                przypisane_do   TEXT NOT NULL,
                priorytet       TEXT NOT NULL DEFAULT 'średni',
                projekt_id      INTEGER NOT NULL,
                data_utworzenia TEXT DEFAULT (datetime('now','localtime')),
                FOREIGN KEY (projekt_id) REFERENCES projekty(id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS logi_czasu_pracy (
                id              INTEGER PRIMARY KEY AUTOINCREMENT,
                zadanie_id      INTEGER NOT NULL,
                uzytkownik      TEXT    NOT NULL,
                czas_pracy      INTEGER NOT NULL,
                komentarz       TEXT,
                data_utworzenia TEXT    DEFAULT (datetime('now','localtime')),
                FOREIGN KEY (zadanie_id) REFERENCES zadania(id) ON DELETE CASCADE
            );

            INSERT INTO projekty (nazwa, opis, data_rozpoczecia, data_zakonczenia, status, odpowiedzialny) VALUES
                ('Nowa strona internetowa', 'Stworzenie nowej strony internetowej firmy', '2023-01-15', '2023-03-30', 'zakończony', 'Jan Kowalski'),
                ('System CRM', 'Wdrożenie systemu zarządzania relacjami z klientami', '2023-02-10', NULL, 'w trakcie', 'Anna Nowak'),
                ('Kampania marketingowa', 'Przygotowanie i przeprowadzenie kampanii reklamowej', '2023-03-01', '2023-04-15', 'zakończony', 'Piotr Wiśniewski'),
                ('Modernizacja sieci', 'Modernizacja infrastruktury sieciowej w biurze', '2023-04-05', NULL, 'w trakcie', 'Tomasz Pielecki'),
                ('Projekt aplikacji mobilnej', 'Zaprojektowanie i wdrożenie aplikacji mobilnej', '2023-05-10', NULL, 'w trakcie', 'Magdalena Lewandowska');

            INSERT INTO zadania (nazwa, opis, termin, status, przypisane_do, priorytet, projekt_id) VALUES
                ('Projektowanie layoutu', 'Przygotowanie projektu graficznego strony', '2023-01-25', 'zakończony', 'Marta Zielińska', 'wysoki', 1),
                ('Kodowanie HTML/CSS', 'Kodowanie strony w HTML5 i CSS3', '2023-02-10', 'zakończony', 'Kamil Nowak', 'średni', 1),
                ('Integracja CMS', 'Integracja strony z CMS', '2023-03-01', 'zakończony', 'Jan Kowalski', 'wysoki', 1),
                ('Testowanie', 'Testowanie funkcjonalności strony', '2023-03-20', 'zakończony', 'Anna Dąbrowska', 'średni', 1),
                ('Analiza wymagań', 'Zebranie i analiza wymagań klienta', '2023-02-20', 'zakończony', 'Anna Nowak', 'wysoki', 2),
                ('Konfiguracja systemu', 'Instalacja i konfiguracja systemu CRM', '2023-03-15', 'zakończony', 'Tomasz Kowalczyk', 'wysoki', 2),
                ('Import danych', 'Migracja danych z poprzedniego systemu', '2023-04-01', 'w trakcie', 'Marek Jankowski', 'średni', 2),
                ('Szkolenie pracowników', 'Przeprowadzenie szkoleń dla zespołu', '2023-04-20', 'do zrobienia', 'Anna Nowak', 'wysoki', 2),
                ('Przygotowanie strategii', 'Opracowanie strategii marketingowej', '2023-03-10', 'zakończony', 'Piotr Wiśniewski', 'wysoki', 3),
                ('Projektowanie grafik', 'Przygotowanie materiałów graficznych', '2023-03-20', 'zakończony', 'Karolina Kowalska', 'średni', 3),
                ('Publikacja postów', 'Publikacja treści w mediach społecznościowych', '2023-03-25', 'zakończony', 'Michał Lewandowski', 'niski', 3),
                ('Analiza wyników', 'Analiza efektów kampanii', '2023-04-10', 'zakończony', 'Piotr Wiśniewski', 'średni', 3),
                ('Audyt sieci', 'Przeprowadzenie audytu obecnej infrastruktury', '2023-04-15', 'zakończony', 'Tomasz Pielecki', 'wysoki', 4),
                ('Zakup sprzętu', 'Zamówienie niezbędnego sprzętu', '2023-04-25', 'zakończony', 'Adam Nowak', 'średni', 4),
                ('Instalacja urządzeń', 'Instalacja nowych urządzeń sieciowych', '2023-05-10', 'w trakcie', 'Marcin Kowalski', 'wysoki', 4),
                ('Konfiguracja', 'Konfiguracja sieci', '2023-05-20', 'do zrobienia', 'Tomasz Pielecki', 'wysoki', 4),
                ('Analiza rynku', 'Badanie rynku i konkurencji', '2023-05-25', 'w trakcie', 'Magdalena Lewandowska', 'średni', 5),
                ('Projektowanie UX', 'Projektowanie interfejsu użytkownika', '2023-06-10', 'do zrobienia', 'Karolina Mazur', 'wysoki', 5),
                ('Prototypowanie', 'Stworzenie prototypu aplikacji', '2023-06-30', 'do zrobienia', 'Piotr Adamski', 'średni', 5),
                ('Testowanie koncepcji', 'Testy z użytkownikami', '2023-07-15', 'do zrobienia', 'Magdalena Lewandowska', 'wysoki', 5);
        ");
    }

    private function __clone() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
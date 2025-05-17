<?php
require_once 'db.php';

// Funkcja eksportu projektu do CSV
function exportProjectsToCSV($pdo, $filter_status = '', $search = '') {
    // Przygotowanie zapytania z filtrowaniem
    $sql = "SELECT * FROM projekty WHERE 1=1";
    $params = array();
    
    if ($search) {
        $sql .= " AND nazwa LIKE :search";
        $params['search'] = "%$search%";
    }
    
    if ($filter_status) {
        $sql .= " AND status = :status";
        $params['status'] = $filter_status;
    }
    
    $sql .= " ORDER BY data_rozpoczecia DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $projekty = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Przygotowanie nagłówków CSV
    $headers = array('ID', 'Nazwa', 'Opis', 'Data rozpoczęcia', 'Data zakończenia', 'Status', 'Osoba odpowiedzialna');
    
    // Ustawienie nagłówków HTTP dla pliku CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="projekty_' . date('Y-m-d') . '.csv"');
    
    // Otwarcie strumienia wyjściowego
    $output = fopen('php://output', 'w');
    
    // Dodanie BOM dla poprawnego kodowania UTF-8
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Zapisanie nagłówków
    fputcsv($output, $headers);
    
    // Zapisanie danych
    foreach ($projekty as $projekt) {
        $row = array(
            $projekt['id'],
            $projekt['nazwa'],
            $projekt['opis'],
            $projekt['data_rozpoczecia'],
            $projekt['data_zakonczenia'] ?? 'Nie określono',
            $projekt['status'],
            $projekt['odpowiedzialny']
        );
        fputcsv($output, $row);
    }
    
    fclose($output);
    exit;
}

// Funkcja eksportu zadań projektu do CSV
function exportTasksToCSV($pdo, $project_id) {
    // Pobieranie informacji o projekcie
    $stmt = $pdo->prepare("SELECT nazwa FROM projekty WHERE id = :id");
    $stmt->execute(['id' => $project_id]);
    $projekt = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Pobieranie zadań projektu
    $stmt = $pdo->prepare("SELECT * FROM zadania WHERE projekt_id = :projekt_id ORDER BY termin ASC");
    $stmt->execute(['projekt_id' => $project_id]);
    $zadania = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Przygotowanie nagłówków CSV
    $headers = array('ID', 'Nazwa zadania', 'Opis', 'Termin', 'Status', 'Priorytet', 'Przypisane do');
    
    // Ustawienie nagłówków HTTP dla pliku CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="zadania_' . sanitizeFilename($projekt['nazwa']) . '_' . date('Y-m-d') . '.csv"');
    
    // Otwarcie strumienia wyjściowego
    $output = fopen('php://output', 'w');
    
    // Dodanie BOM dla poprawnego kodowania UTF-8
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Zapisanie nagłówków
    fputcsv($output, $headers);
    
    // Zapisanie danych
    foreach ($zadania as $zadanie) {
        $row = array(
            $zadanie['id'],
            $zadanie['nazwa'],
            $zadanie['opis'],
            $zadanie['termin'],
            $zadanie['status'],
            $zadanie['priorytet'],
            $zadanie['przypisane_do']
        );
        fputcsv($output, $row);
    }
    
    fclose($output);
    exit;
}

// Funkcja sanityzująca nazwy plików
function sanitizeFilename($filename) {
    // Usunięcie polskich znaków i innych znaków specjalnych
    $filename = preg_replace('/[^\w\s.-]/', '', $filename);
    $filename = str_replace(' ', '_', $filename);
    return $filename;
}

// Obsługa żądań
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'export_projects_csv':
            $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            exportProjectsToCSV($pdo, $filter_status, $search);
            break;
            
        case 'export_tasks_csv':
            if (isset($_GET['id'])) {
                exportTasksToCSV($pdo, $_GET['id']);
            }
            break;
    }
}
?>
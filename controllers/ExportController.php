<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ProjectModel.php';
require_once __DIR__ . '/../models/TaskModel.php';

class ExportController extends Controller {
    private $projectModel;
    private $taskModel;
    
    public function __construct() {
        parent::__construct();
        $this->projectModel = new ProjectModel();
        $this->taskModel = new TaskModel();
    }
    
    // Eksportuje projekty do CSV
    public function exportProjectsToCsv() {
        $search = $this->getParam('search', '');
        $filter_status = $this->getParam('filter_status', '');
        
        // Pobierz projekty z uwzględnieniem filtrów
        $projekty = $this->projectModel->getAllProjects($search, $filter_status);
        
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
    
    // Eksportuje zadania do CSV
    public function exportTasksToCsv() {
        $project_id = $this->getParam('id');
        
        if (!$project_id) {
            $this->redirect('index.php');
        }
        
        // Pobierz informacje o projekcie
        $projekt = $this->projectModel->getById($project_id);
        
        if (!$projekt) {
            $this->redirect('index.php');
        }
        
        // Pobierz zadania projektu
        $zadania = $this->taskModel->getTasksByProjectId($project_id);
        
        // Przygotowanie nagłówków CSV
        $headers = array('ID', 'Nazwa zadania', 'Opis', 'Termin', 'Status', 'Priorytet', 'Przypisane do');
        
        // Ustawienie nagłówków HTTP dla pliku CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="zadania_' . $this->sanitizeFilename($projekt['nazwa']) . '_' . date('Y-m-d') . '.csv"');
        
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
    private function sanitizeFilename($filename) {
        // Usunięcie polskich znaków i innych znaków specjalnych
        $filename = preg_replace('/[^\w\s.-]/', '', $filename);
        $filename = str_replace(' ', '_', $filename);
        return $filename;
    }
}
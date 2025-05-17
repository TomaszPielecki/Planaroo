<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ProjectModel.php';
require_once __DIR__ . '/../models/TaskModel.php';

class ProjectController extends Controller {
    private $projectModel;
    private $taskModel;
    
    public function __construct() {
        parent::__construct();
        $this->projectModel = new ProjectModel();
        $this->taskModel = new TaskModel();
    }
    
    // Wyświetla listę projektów
    public function index() {
        $search = $this->getParam('search', '');
        $filter_status = $this->getParam('filter_status', '');
        $success = $this->getParam('success', '');
        
        // Pobierz projekty z uwzględnieniem filtrów
        $projekty = $this->projectModel->getAllProjects($search, $filter_status);
        
        // Pobierz statystyki i nadchodzące zadania
        $total_projects = $this->projectModel->getTotalProjects();
        $status_stats = $this->projectModel->getStatusStatistics();
        $upcoming_tasks = $this->taskModel->getUpcomingTasks();
        
        // Obsługa komunikatów o sukcesie
        $success_message = null;
        if ($success) {
            switch ($success) {
                case 'add':
                    $success_message = 'Projekt został dodany pomyślnie!';
                    break;
                case 'edit':
                    $success_message = 'Projekt został zaktualizowany pomyślnie!';
                    break;
                case 'delete':
                    $success_message = 'Projekt został usunięty pomyślnie!';
                    break;
            }
        }
        
        // Przygotuj dane do wyświetlenia w szablonie
        $viewData = [
            'projekty' => $projekty,
            'search' => $search,
            'filter_status' => $filter_status,
            'total_projects' => $total_projects,
            'status_stats' => $status_stats,
            'upcoming_tasks' => $upcoming_tasks
        ];
        
        if ($success_message) {
            $viewData['success_message'] = $success_message;
        }
        
        $this->render('projekty.tpl', $viewData);
    }
    
    // Wyświetla formularz dodawania projektu
    public function add() {
        if ($this->isPost()) {
            $nazwa = $this->postParam('nazwa');
            $opis = $this->postParam('opis');
            $data_rozpoczecia = $this->postParam('data_rozpoczecia');
            $data_zakonczenia = $this->postParam('data_zakonczenia') ? $this->postParam('data_zakonczenia') : null;
            $status = $this->postParam('status');
            $odpowiedzialny = $this->postParam('odpowiedzialny');
            
            $data = [
                'nazwa' => $nazwa,
                'opis' => $opis,
                'data_rozpoczecia' => $data_rozpoczecia,
                'data_zakonczenia' => $data_zakonczenia,
                'status' => $status,
                'odpowiedzialny' => $odpowiedzialny
            ];
            
            $this->projectModel->create($data);
            $this->redirect('index.php', ['success' => 'add']);
        } else {
            $this->render('add.tpl');
        }
    }
    
    // Wyświetla formularz edycji projektu
    public function edit() {
        $id = $this->getParam('id');
        
        if (!$id) {
            $this->redirect('index.php');
        }
        
        if ($this->isPost()) {
            $nazwa = $this->postParam('nazwa');
            $opis = $this->postParam('opis');
            $data_rozpoczecia = $this->postParam('data_rozpoczecia');
            $data_zakonczenia = $this->postParam('data_zakonczenia') ? $this->postParam('data_zakonczenia') : null;
            $status = $this->postParam('status');
            $odpowiedzialny = $this->postParam('odpowiedzialny');
            
            $data = [
                'nazwa' => $nazwa,
                'opis' => $opis,
                'data_rozpoczecia' => $data_rozpoczecia,
                'data_zakonczenia' => $data_zakonczenia,
                'status' => $status,
                'odpowiedzialny' => $odpowiedzialny
            ];
            
            $this->projectModel->update($id, $data);
            $this->redirect('index.php', ['success' => 'edit']);
        } else {
            $projekt = $this->projectModel->getById($id);
            
            if (!$projekt) {
                $this->render('error.tpl', ['error' => 'Projekt nie został znaleziony.']);
                return;
            }
            
            $this->render('edit.tpl', ['projekt' => $projekt]);
        }
    }
    
    // Usuwa projekt
    public function delete() {
        $id = $this->getParam('id');
        
        if (!$id) {
            $this->redirect('index.php');
        }
        
        // Usuwamy wszystkie zadania projektu (kaskadowe usuwanie w bazie danych)
        $this->projectModel->delete($id);
        $this->redirect('index.php', ['success' => 'delete']);
    }
    
    // Wyświetla kalendarz projektów i zadań
    public function calendar() {
        $projekty = $this->projectModel->getProjectsForCalendar();
        $zadania = $this->taskModel->getTasksForCalendar();
        
        $this->render('calendar.tpl', [
            'projekty' => $projekty,
            'zadania' => $zadania
        ]);
    }
}
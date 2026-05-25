<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/TaskModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';

class TaskController extends Controller {
    private $taskModel;
    private $projectModel;
    
    public function __construct() {
        parent::__construct();
        $this->taskModel = new TaskModel();
        $this->projectModel = new ProjectModel();
    }
    
    // Wyświetla listę zadań dla projektu
    public function viewTasks() {
        $id = $this->getParam('id');
        
        if (!$id) {
            $this->redirect('index.php');
        }
        
        $projekt = $this->projectModel->getById($id);
        $zadania = $this->taskModel->getTasksByProjectId($id);
        
        $success = $this->getParam('success', '');
        $success_message = null;
        
        if ($success) {
            switch ($success) {
                case 'add_task':
                    $success_message = 'Zadanie zostało dodane pomyślnie!';
                    break;
                case 'edit_task':
                    $success_message = 'Zadanie zostało zaktualizowane pomyślnie!';
                    break;
                case 'delete_task':
                    $success_message = 'Zadanie zostało usunięte pomyślnie!';
                    break;
                default:
                    $success_message = null;
            }
        }
        
        $viewData = [
            'projekt' => $projekt,
            'zadania' => $zadania
        ];
        
        if ($success_message) {
            $viewData['success_message'] = $success_message;
        }
        
        $this->render('zadania.tpl', $viewData);
    }
    
    // Wyświetla formularz dodawania zadania
    public function addTask() {
        $id = $this->getParam('id'); // ID projektu
        
        if (!$id) {
            $this->redirect('index.php');
        }
        
        $projekt = $this->projectModel->getById($id);
        
        if (!$projekt) {
            $this->redirect('index.php');
        }
        
        if ($this->isPost()) {
            $nazwa = $this->postParam('nazwa');
            $opis = $this->postParam('opis');
            $termin = $this->postParam('termin');
            $status = $this->postParam('status');
            $przypisane_do = $this->postParam('przypisane_do');
            $priorytet = $this->postParam('priorytet');
            
            $data = [
                'nazwa' => $nazwa,
                'opis' => $opis,
                'termin' => $termin,
                'status' => $status,
                'przypisane_do' => $przypisane_do,
                'priorytet' => $priorytet,
                'projekt_id' => $id
            ];
            
            $this->taskModel->create($data);
            $this->redirect('index.php', ['action' => 'view_tasks', 'id' => $id, 'success' => 'add_task']);
        } else {
            $this->render('add_task.tpl', ['projekt' => $projekt]);
        }
    }
    
    // Wyświetla formularz edycji zadania
    public function editTask() {
        $task_id = $this->getParam('task_id');
        
        if (!$task_id) {
            $this->redirect('index.php');
        }
        
        $zadanie = $this->taskModel->getById($task_id);
        
        if (!$zadanie) {
            $this->redirect('index.php');
        }
        
        $projekt = $this->projectModel->getById($zadanie['projekt_id']);
        
        if ($this->isPost()) {
            $nazwa = $this->postParam('nazwa');
            $opis = $this->postParam('opis');
            $termin = $this->postParam('termin');
            $status = $this->postParam('status');
            $przypisane_do = $this->postParam('przypisane_do');
            $priorytet = $this->postParam('priorytet');
            
            $data = [
                'nazwa' => $nazwa,
                'opis' => $opis,
                'termin' => $termin,
                'status' => $status,
                'przypisane_do' => $przypisane_do,
                'priorytet' => $priorytet
            ];
            
            $this->taskModel->update($task_id, $data);
            $this->redirect('index.php', [
                'action' => 'view_tasks', 
                'id' => $zadanie['projekt_id'], 
                'success' => 'edit_task'
            ]);
        } else {
            $this->render('edit_task.tpl', [
                'zadanie' => $zadanie,
                'projekt' => $projekt
            ]);
        }
    }
    
    // Usuwa zadanie
    public function deleteTask() {
        $task_id = $this->getParam('task_id');
        
        if (!$task_id) {
            $this->redirect('index.php');
        }
        
        $zadanie = $this->taskModel->getById($task_id);
        
        if (!$zadanie) {
            $this->redirect('index.php');
        }
        
        $projekt_id = $zadanie['projekt_id'];
        
        $this->taskModel->delete($task_id);
        $this->redirect('index.php', [
            'action' => 'view_tasks', 
            'id' => $projekt_id, 
            'success' => 'delete_task'
        ]);
    }
}
<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/TimeLogModel.php';
require_once __DIR__ . '/../models/TaskModel.php';

class TimeTrackingController extends Controller {
    private $timeLogModel;
    private $taskModel;
    
    public function __construct() {
        parent::__construct();
        $this->timeLogModel = new TimeLogModel();
        $this->taskModel = new TaskModel();
    }
    
    // Wyświetla stronę śledzenia czasu pracy dla zadania
    public function index() {
        $task_id = $this->getParam('task_id');
        
        if (!$task_id) {
            $this->redirect('index.php');
        }
        
        $zadanie = $this->taskModel->getTaskWithProject($task_id);
        
        if (!$zadanie) {
            $this->redirect('index.php');
        }
        
        $time_logs = $this->timeLogModel->getTimeLogsByTaskId($task_id);
        $total_time = $this->timeLogModel->getTotalTimeForTask($task_id);
        
        // Formatowanie łącznego czasu pracy
        $hours = floor($total_time / 60);
        $minutes = $total_time % 60;
        $formatted_total_time = sprintf("%d godz. %d min.", $hours, $minutes);
        
        // Komunikaty o sukcesie
        $success = $this->getParam('success', '');
        $success_message = null;
        
        if ($success) {
            if ($success == 'add') {
                $success_message = 'Wpis czasu pracy został dodany pomyślnie!';
            } elseif ($success == 'delete') {
                $success_message = 'Wpis czasu pracy został usunięty pomyślnie!';
            }
        }
        
        $viewData = [
            'zadanie' => $zadanie,
            'time_logs' => $time_logs,
            'total_time' => $total_time,
            'formatted_total_time' => $formatted_total_time
        ];
        
        if ($success_message) {
            $viewData['success_message'] = $success_message;
        }
        
        $this->render('time_tracking.tpl', $viewData);
    }
    
    // Dodaje nowy wpis czasu pracy
    public function addTimeLog() {
        if (!$this->isPost() || !isset($_POST['add_time_log'])) {
            $this->redirect('index.php');
        }
        
        $zadanie_id = $this->postParam('zadanie_id');
        $uzytkownik = $this->postParam('uzytkownik');
        $czas_pracy = $this->postParam('czas_pracy');
        $komentarz = $this->postParam('opis'); // Nazwa pola w formularzu to 'opis'
        
        $data = [
            'zadanie_id' => $zadanie_id,
            'uzytkownik' => $uzytkownik,
            'czas_pracy' => $czas_pracy,
            'komentarz' => $komentarz
        ];
        
        $this->timeLogModel->addTimeLog($data);
        $this->redirect('time_tracking.php', ['task_id' => $zadanie_id, 'success' => 'add']);
    }
    
    // Usuwa wpis czasu pracy
    public function deleteTimeLog() {
        $log_id = $this->getParam('log_id');
        $task_id = $this->getParam('task_id');
        
        if (!$log_id || !$task_id) {
            $this->redirect('index.php');
        }
        
        $this->timeLogModel->deleteTimeLog($log_id);
        $this->redirect('time_tracking.php', ['task_id' => $task_id, 'success' => 'delete']);
    }
}
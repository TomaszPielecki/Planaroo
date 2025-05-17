<?php
require_once __DIR__ . '/Model.php';

class TimeLogModel extends Model {
    protected $table = 'logi_czasu_pracy';
    
    // Pobiera logi czasu pracy dla danego zadania
    public function getTimeLogsByTaskId($task_id) {
        $sql = "SELECT * FROM {$this->table} WHERE zadanie_id = :zadanie_id ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['zadanie_id' => $task_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Oblicza sumę czasu pracy dla zadania
    public function getTotalTimeForTask($task_id) {
        $sql = "SELECT SUM(czas_pracy) as total_time FROM {$this->table} WHERE zadanie_id = :zadanie_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['zadanie_id' => $task_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_time'] ?? 0;
    }
    
    // Dodaje nowy wpis czasu pracy
    public function addTimeLog($data) {
        return $this->create([
            'zadanie_id' => $data['zadanie_id'],
            'uzytkownik' => $data['uzytkownik'],
            'czas_pracy' => $data['czas_pracy'],
            'komentarz' => $data['komentarz']
        ]);
    }
    
    // Usuwa wpis czasu pracy
    public function deleteTimeLog($log_id) {
        return $this->delete($log_id);
    }
}
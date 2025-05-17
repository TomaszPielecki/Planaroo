<?php
require_once __DIR__ . '/Model.php';

class TaskModel extends Model {
    protected $table = 'zadania';
    
    // Pobiera zadania dla danego projektu
    public function getTasksByProjectId($project_id) {
        return $this->findBy(['projekt_id' => $project_id], 'termin', 'ASC');
    }
    
    // Pobiera zbliżające się terminy zadań
    public function getUpcomingTasks($limit = 5) {
        $sql = "SELECT z.*, p.nazwa as projekt_nazwa FROM {$this->table} z 
                JOIN projekty p ON z.projekt_id = p.id 
                WHERE z.termin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) 
                AND z.status != 'zakończone' 
                ORDER BY z.termin ASC 
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Pobiera zadania do kalendarza
    public function getTasksForCalendar() {
        $sql = "SELECT z.id, z.nazwa, z.termin, z.status, z.priorytet, z.projekt_id, 
                p.nazwa as projekt_nazwa, z.opis, z.przypisane_do
                FROM {$this->table} z 
                JOIN projekty p ON z.projekt_id = p.id 
                ORDER BY z.termin ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Pobiera zadanie z informacją o projekcie
    public function getTaskWithProject($task_id) {
        $sql = "SELECT z.*, p.nazwa as projekt_nazwa FROM {$this->table} z 
                JOIN projekty p ON z.projekt_id = p.id
                WHERE z.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $task_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
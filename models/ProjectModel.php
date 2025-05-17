<?php
require_once __DIR__ . '/Model.php';

class ProjectModel extends Model {
    protected $table = 'projekty';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Pobiera wszystkie projekty z opcjonalnym filtrowaniem
    public function getAllProjects($search = '', $status = '') {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        if ($search) {
            $sql .= " AND nazwa LIKE :search";
            $params['search'] = "%{$search}%";
        }
        
        if ($status) {
            $sql .= " AND status = :status";
            $params['status'] = $status;
        }
        
        $sql .= " ORDER BY data_rozpoczecia DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Pobiera statystyki statusów projektów
    public function getStatusStatistics() {
        $sql = "SELECT status, COUNT(*) as count FROM {$this->table} GROUP BY status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Pobiera liczbę wszystkich projektów
    public function getTotalProjects() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    // Pobiera projekty do kalendarza
    public function getProjectsForCalendar() {
        $sql = "SELECT id, nazwa, data_rozpoczecia, 
               CASE WHEN data_zakonczenia IS NULL THEN DATE_ADD(CURDATE(), INTERVAL 30 DAY) 
               ELSE data_zakonczenia END as data_zakonczenia, 
               status, odpowiedzialny, opis FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
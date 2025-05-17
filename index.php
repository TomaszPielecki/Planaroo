<?php
session_start();

// Automatyczne ładowanie klas kontrolerów
function loadController($controllerName) {
    $controllerFile = __DIR__ . "/controllers/{$controllerName}.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return true;
    }
    return false;
}

// Zdefiniowanie domyślnych wartości
$controller = 'Project';
$action = 'index';

// Pobieranie parametrów z URL
if (isset($_GET['action'])) {
    $requestedAction = $_GET['action'];
    
    // Mapowanie akcji na kontrolery i metody
    switch ($requestedAction) {
        // Projekt
        case 'add':
            $controller = 'Project';
            $action = 'add';
            break;
        case 'edit':
            $controller = 'Project';
            $action = 'edit';
            break;
        case 'delete':
            $controller = 'Project';
            $action = 'delete';
            break;
        case 'calendar':
            $controller = 'Project';
            $action = 'calendar';
            break;
            
        // Zadania
        case 'view_tasks':
            $controller = 'Task';
            $action = 'viewTasks';
            break;
        case 'add_task':
            $controller = 'Task';
            $action = 'addTask';
            break;
        case 'edit_task':
            $controller = 'Task';
            $action = 'editTask';
            break;
        case 'delete_task':
            $controller = 'Task';
            $action = 'deleteTask';
            break;
            
        default:
            $controller = 'Project';
            $action = 'index';
    }
}

// Obsługa śledzenia czasu - oddzielny plik
if (basename($_SERVER['PHP_SELF']) === 'time_tracking.php') {
    $controller = 'TimeTracking';
    
    if (isset($_GET['action']) && $_GET['action'] === 'delete_log') {
        $action = 'deleteTimeLog';
    } else if (isset($_POST['add_time_log'])) {
        $action = 'addTimeLog';
    } else {
        $action = 'index';
    }
}

// Eksporty danych - oddzielny plik
if (basename($_SERVER['PHP_SELF']) === 'exports.php') {
    $controller = 'Export';
    
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'export_projects_csv':
                $action = 'exportProjectsToCsv';
                break;
            case 'export_tasks_csv':
                $action = 'exportTasksToCsv';
                break;
            default:
                $action = 'index';
        }
    } else {
        $action = 'index';
    }
}

// Dołączanie odpowiedniego kontrolera i wywołanie akcji
$controllerClass = $controller . 'Controller';
if (loadController($controllerClass)) {
    $controllerInstance = new $controllerClass();
    
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        // Akcja nie istnieje - przekierowanie na stronę główną
        header('Location: index.php');
        exit;
    }
} else {
    // Kontroler nie istnieje - przekierowanie na stronę główną
    header('Location: index.php');
    exit;
}
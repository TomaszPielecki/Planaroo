<?php
require_once __DIR__ . '/../libs/Smarty.class.php';

abstract class Controller {
    protected $smarty;
    
    public function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../smarty/templates');
        $this->smarty->setCompileDir(__DIR__ . '/../smarty/templates_c');
        $this->smarty->setCacheDir(__DIR__ . '/../smarty/cache');
        $this->smarty->setConfigDir(__DIR__ . '/../smarty/configs');
    }
    
    // Renderuje widok z podanymi danymi
    protected function render($template, $data = []) {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->display($template);
    }
    
    // Przekierowuje do podanej ścieżki
    protected function redirect($path, $params = []) {
        $queryString = http_build_query($params);
        $url = $path . ($queryString ? '?' . $queryString : '');
        header("Location: {$url}");
        exit;
    }
    
    // Zwraca parametr z $_GET lub wartość domyślną
    protected function getParam($key, $default = null) {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
    
    // Zwraca parametr z $_POST lub wartość domyślną
    protected function postParam($key, $default = null) {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    
    // Sprawdza, czy żądanie jest typu POST
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    // Dodaje komunikat o powodzeniu operacji
    protected function addSuccessMessage($message) {
        $_SESSION['success_message'] = $message;
    }
    
    // Pobiera i czyści komunikat o powodzeniu operacji
    protected function getSuccessMessage() {
        $message = $_SESSION['success_message'] ?? null;
        unset($_SESSION['success_message']);
        return $message;
    }
}
<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function login() {
        if (isset($_SESSION['user'])) {
            $this->redirect('index.php');
        }

        $error          = null;
        $success        = $this->getSuccessMessage();

        if ($this->isPost()) {
            $email    = trim($this->postParam('email', ''));
            $password = $this->postParam('password', '');

            if (empty($email) || empty($password)) {
                $error = 'Wypełnij wszystkie pola.';
            } else {
                $user = $this->userModel->findByEmail($email);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'email'    => $user['email'],
                    ];
                    $this->redirect('index.php');
                } else {
                    $error = 'Nieprawidłowy email lub hasło.';
                }
            }
        }

        $this->render('login.tpl', [
            'error'           => $error,
            'success_message' => $success,
        ]);
    }

    public function register() {
        if (isset($_SESSION['user'])) {
            $this->redirect('index.php');
        }

        $error = null;

        if ($this->isPost()) {
            $username  = trim($this->postParam('username', ''));
            $email     = trim($this->postParam('email', ''));
            $password  = $this->postParam('password', '');
            $password2 = $this->postParam('password2', '');

            if (empty($username) || empty($email) || empty($password) || empty($password2)) {
                $error = 'Wypełnij wszystkie pola.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Podaj prawidłowy adres email.';
            } elseif (strlen($password) < 6) {
                $error = 'Hasło musi mieć co najmniej 6 znaków.';
            } elseif ($password !== $password2) {
                $error = 'Hasła nie są identyczne.';
            } elseif ($this->userModel->emailExists($email)) {
                $error = 'Ten email jest już zajęty.';
            } else {
                $this->userModel->register($username, $email, $password);
                $this->addSuccessMessage('Konto zostało utworzone. Możesz się teraz zalogować.');
                $this->redirect('index.php', ['action' => 'login']);
            }
        }

        $this->render('register.tpl', ['error' => $error]);
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}

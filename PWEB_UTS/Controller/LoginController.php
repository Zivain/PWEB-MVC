<?php
require_once __DIR__ . '/../Model/UserModel.php';

class LoginController {

    // Tampilkan halaman login
    public function index() {
        require_once __DIR__ . '/../View/login_form.php';
    }

    // Proses login
    public function loginProcess() {
        session_start();
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();

        if ($userModel->checkLogin($username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['role']     = $userModel->getRole($username);
            header("Location: index.php?controller=login&action=dashboard");
            exit();
        } else {
            header("Location: index.php?controller=login&err=" . urlencode("Username atau password salah"));
            exit();
        }
    }

    // Tampilkan dashboard
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?controller=login");
            exit();
        }

        require_once __DIR__ . '/../View/dashboard.php';
    }

    // Logout
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=login");
        exit();
    }
}
?>
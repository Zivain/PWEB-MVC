<?php
class UserModel {
    private $users = [
        'admin' => ['password' => 'admin123', 'role' => 'Admin'],
        'user'  => ['password' => 'user123', 'role' => 'User']
    ];

    public function checkLogin($username, $password) {
        return isset($this->users[$username]) && $this->users[$username]['password'] === $password;
    }

    public function getRole($username) {
        return $this->users[$username]['role'] ?? '';
    }
}
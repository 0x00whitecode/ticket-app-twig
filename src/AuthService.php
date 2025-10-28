<?php

namespace App;

class AuthService {
    private const USERS_FILE = __DIR__ . '/../data/users.json';
    private const SESSION_KEY = 'ticketapp_session';

    private function readUsers() {
        if (!file_exists(self::USERS_FILE)) {
            return [];
        }
        $content = file_get_contents(self::USERS_FILE);
        return json_decode($content, true) ?: [];
    }

    private function writeUsers($users) {
        $dir = dirname(self::USERS_FILE);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents(self::USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function signup($name, $email, $password) {
        $users = $this->readUsers();
        
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                throw new \Exception('User already exists');
            }
        }

        $user = [
            'id' => time(),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'created_at' => time()
        ];

        $users[] = $user;
        $this->writeUsers($users);

        $token = 'tok_' . time() . '_' . uniqid();
        $_SESSION[self::SESSION_KEY] = json_encode(['token' => $token, 'email' => $email]);

        return ['token' => $token, 'user' => $user];
    }

    public function login($email, $password) {
        $users = $this->readUsers();
        
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $token = 'tok_' . time() . '_' . uniqid();
                $_SESSION[self::SESSION_KEY] = json_encode(['token' => $token, 'email' => $email]);
                return ['token' => $token, 'user' => $user];
            }
        }

        throw new \Exception('Invalid credentials');
    }

    public function logout() {
        unset($_SESSION[self::SESSION_KEY]);
    }

    public function getSession() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return null;
        }
        return json_decode($_SESSION[self::SESSION_KEY], true);
    }

    public function isAuthenticated() {
        return $this->getSession() !== null;
    }

    public function requireAuth() {
        if (!$this->isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }
    }
}


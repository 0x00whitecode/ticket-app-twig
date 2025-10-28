<?php

namespace App;

class AuthController {
    private $twig;
    private $authService;

    public function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => __DIR__ . '/../cache',
            'auto_reload' => true
        ]);
        $this->authService = new AuthService();
    }

    public function landing() {
        echo $this->twig->render('landing.twig', ['isAuth' => false, 'message' => null, 'msgType' => null]);
    }

    public function login() {
        $error = null;
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        }
        echo $this->twig->render('auth/login.twig', ['error' => $error, 'isAuth' => false, 'message' => null, 'msgType' => null]);
    }

    public function signup() {
        $error = null;
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        }
        echo $this->twig->render('auth/signup.twig', ['error' => $error, 'isAuth' => false, 'message' => null, 'msgType' => null]);
    }

    public function loginAction() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $this->authService->login($email, $password);
            header('Location: /dashboard');
        } catch (\Exception $e) {
            header('Location: /auth/login?error=' . urlencode($e->getMessage()));
        }
        exit;
    }

    public function signupAction() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $this->authService->signup($name, $email, $password);
            header('Location: /dashboard');
        } catch (\Exception $e) {
            header('Location: /auth/signup?error=' . urlencode($e->getMessage()));
        }
        exit;
    }

    public function logout() {
        $this->authService->logout();
        header('Location: /');
        exit;
    }
}


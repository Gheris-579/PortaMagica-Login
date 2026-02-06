<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$pageTitle = "Login";
$errors = [];
$old = ['login' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass  = $_POST['password'] ?? '';
    $old['login'] = $login;

    if ($login === '' || $pass === '') {
        $errors[] = "Compila tutti i campi.";
    }

    if (!$errors) {
        $stmt = db()->prepare(
            "SELECT id, username, password_hash 
             FROM users 
             WHERE username = ? OR email = ? 
             LIMIT 1"
        );
        $stmt->execute([$login, $login]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($pass, $user['password_hash'])) {
            $errors[] = "Credenziali non valide.";
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        }
    }
}

require __DIR__ . '/views/login.view.php';

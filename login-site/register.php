<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$pageTitle = "Register";
$errors = [];          // 🔴 IMPORTANTISSIMO
$success = '';
$old = [
    'username' => '',
    'email' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $pass     = $_POST['password'] ?? '';
    $pass2    = $_POST['password2'] ?? '';

    $old['username'] = $username;
    $old['email'] = $email;

    if ($username === '' || strlen($username) < 3) {
        $errors[] = "Username minimo 3 caratteri.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email non valida.";
    }

    if (strlen($pass) < 6) {
        $errors[] = "Password minimo 6 caratteri.";
    }

    if ($pass !== $pass2) {
        $errors[] = "Le password non coincidono.";
    }

    if (!$errors) {
        $pdo = db();

        $stmt = $pdo->prepare(
            "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1"
        );
        $stmt->execute([$username, $email]);

        if ($stmt->fetch()) {
            $errors[] = "Username o email già esistenti.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)"
            );
            $stmt->execute([$username, $email, $hash]);

            $success = "Registrazione completata! Ora puoi fare login.";
            $old = ['username' => '', 'email' => ''];
        }
    }
}

require __DIR__ . '/views/register.view.php';

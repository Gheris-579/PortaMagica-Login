<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pageTitle = "Dashboard";
require __DIR__ . '/views/dashboard.view.php';

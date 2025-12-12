<?php
session_start();
require 'config.php';

// استلام بيانات POST
$login = isset($_POST['login']) ? trim($_POST['login']) : '';
$pwd   = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';

// تحقق من الحقول
if ($login === '' || $pwd === '') {
    header('Location: login.php?err=1');
    exit;
}

// تحقق من القيم مع القيم المعرفة في config.php
if ($login === USERLOGIN && $pwd === USERPASS) {
    // نجاح: نفتح الجلسة ونخزن متغير CONNECT
    $_SESSION['CONNECT'] = true;
    $_SESSION['user'] = $login;
    header('Location: accueil.php');
    exit;
} else {
    // خطأ في البيانات
    header('Location: login.php?err=2');
    exit;
}

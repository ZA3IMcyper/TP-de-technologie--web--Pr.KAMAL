<?php
session_start();
if (isset($_POST['deco'])) {
    // تدمير الجلسة بالكامل
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header('Location: login.php?err=3');
    exit;
}
// إذا وصل غير عبر POST، نعيده للّوقين
header('Location: login.php');
exit;

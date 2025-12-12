<?php
session_start();

// إذا المستخدم مسجل دخول مسبقاً، نعيده للصفحة accueil
if (isset($_SESSION['CONNECT']) && $_SESSION['CONNECT'] === true) {
    header('Location: accueil.php');
    exit;
}

// عرض رسائل الخطأ / الإشعارات
$msg = '';
if (isset($_GET['err'])) {
    $err = intval($_GET['err']);
    if ($err === 1) $msg = "Veuillez saisir un login et un mot de passe";
    elseif ($err === 2) $msg = "Login ou mot de passe incorrect";
    elseif ($err === 3) $msg = "Vous avez été déconnecté du service";
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;padding:20px}
    .box{border:1px solid #ccc;padding:12px;display:inline-block}
    .msg{color:#b00;margin-bottom:10px}
  </style>
</head>
<body>
  <h2>Se connecter</h2>
  <?php if($msg): ?><div class="msg"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
  <div class="box">
    <form action="validation.php" method="post">
      <div><label>Login: <input type="text" name="login" autofocus></label></div>
      <div><label>Mot de passe: <input type="password" name="pwd"></label></div>
      <div style="margin-top:8px"><button type="submit">Se connecter !</button></div>
    </form>
  </div>
</body>
</html>

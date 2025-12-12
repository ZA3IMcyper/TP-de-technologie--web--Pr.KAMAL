<?php
session_start();
// إذا المستخدم لم يسجل الدخول نعيده إلى login.php
if (!isset($_SESSION['CONNECT']) || $_SESSION['CONNECT'] !== true) {
    header('Location: login.php');
    exit;
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Utilisateur';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <style>body{font-family:Arial,Helvetica,sans-serif;padding:20px}</style>
</head>
<body>
  <h2>Bonjour <?php echo htmlspecialchars($user); ?> !</h2>
  <p>Vous êtes connecté.</p>

  <form action="logout.php" method="post" style="margin-top:15px;">
    <button type="submit" name="deco">Se déconnecter</button>
  </form>
</body>
</html>

<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

// دالة قراءة مع تنظيف
function get_post($key, $default = '') {
    if (!isset($_POST[$key])) return $default;
    $v = trim($_POST[$key]);
    $v = strip_tags($v);
    return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// بسيط: التحقق من CSRF (إن وُجد token)
if (isset($_SESSION['csrf_token'])) {
    $token_ok = isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    if (!$token_ok) {
        // رفض الطلب
        http_response_code(403);
        echo "Requête invalide (CSRF).";
        exit;
    }
}

// قراءة الحقول
$nom = get_post('nom');
$prenom = get_post('prenom');
$annee = get_post('annee');
$identifiant = get_post('identifiant');
$sexe = get_post('sexe', 'Non précisé');
$debutant = isset($_POST['debutant']) ? 'Oui' : 'Non';
$mdp_raw = isset($_POST['mdp']) ? $_POST['mdp'] : '';

// تجزئة كلمة المرور (إن أردت تخزينها لاحقًا)
$mdp_hashed = $mdp_raw !== '' ? password_hash($mdp_raw, PASSWORD_DEFAULT) : null;

// تحققات بسيطة
$errors = [];
if ($nom === '') $errors[] = 'Le champ "Nom" est requis.';
if ($annee !== '' && (!ctype_digit($annee) || intval($annee) < 1900 || intval($annee) > 2025))
    $errors[] = 'Année invalide.';

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Réponse</title>
  <style>/*...مختصر CSS ...*/</style>
</head>
<body>
  <?php if ($errors): ?>
    <div style="color:red"><ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul></div>
    <a href="index.php">Retour</a>
  <?php else: ?>
    <h1>Résultat</h1>
    <p>Nom: <?= $nom ?: '<em>Non fourni</em>' ?></p>
    <p>Prénom: <?= $prenom ?: '-' ?></p>
    <p>Mot de passe (hash) : <?= $mdp_hashed ? htmlspecialchars($mdp_hashed) : '<em>Non fourni</em>' ?></p>
    <!-- لاحظ: نعرض الهاش فقط إن كنت تحتاجه؛ لا تعرض كلمة المرور الأصلية -->
    <p><a href="index.php">Retour au formulaire</a></p>
  <?php endif; ?>
</body>
</html>

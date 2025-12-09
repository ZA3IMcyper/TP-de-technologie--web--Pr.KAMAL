<?php
$password = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $len = intval($_POST["len"]);

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";

    for ($i = 0; $i < $len; $i++) {
        $password .= $chars[random_int(0, strlen($chars) - 1)];
    }
}
?>
<h1>Générateur de mot de passe</h1>
<form method="POST">
    Longueur : <input type="number" name="len" min="4" max="30" required>
    <button type="submit">Générer</button>
</form>
<?php if ($password): ?>
<p>Mot de passe généré : <strong><?= $password ?></strong></p>
<?php endif; ?>

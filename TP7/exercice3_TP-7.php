<?php
$nom = $email = $msg = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $msg = trim($_POST["msg"]);

    if ($nom === "" || $email === "" || $msg === "") {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>
<h1>Formulaire de contact</h1>
<form method="POST">
    Nom : <input type="text" name="nom"><br><br>
    Email : <input type="email" name="email"><br><br>
    Message : <textarea name="msg"></textarea><br><br>
    <button type="submit">Envoyer</button>
</form>

<?php
if ($error) echo "<p style='color:red'>$error</p>";
elseif ($_SERVER["REQUEST_METHOD"] === "POST")
    echo "<p><strong>Message reçu :</strong><br>Nom : $nom<br>Email : $email<br>Message : $msg</p>";
?>

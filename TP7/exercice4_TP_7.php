<?php
session_start();

$valid_user = "admin";
$valid_pass = "1234";

// Déconnexion
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: ex4.php");
    exit;
}

// Déjà connecté
if (isset($_SESSION["user"])) {
    echo "<h1>Bienvenue, " . htmlspecialchars($_SESSION['user']) . " !</h1>";
    echo "<a href='?logout=1'>Se déconnecter</a>";
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $mdp = $_POST["mdp"];

    if ($id === $valid_user && $mdp === $valid_pass) {
        $_SESSION["user"] = $id;
        header("Location: ex4.php");
        exit;
    } else {
        $error = "Identifiant ou mot de passe incorrect.";
    }
}
?>
<h1>Connexion</h1>
<form method="POST">
    Identifiant : <input type="text" name="id"><br><br>
    Mot de passe : <input type="password" name="mdp"><br><br>
    <button type="submit">Se connecter</button>
</form>
<p style="color:red;"><?= $error ?></p>

<?php
require "db.php";

$id = intval($_GET["id"]);
$stmt = $pdo->prepare("SELECT * FROM exercice WHERE id = ?");
$stmt->execute([$id]);
$exo = $stmt->fetch();

if (!$exo) {
    die("Exercice introuvable !");
}

// --- Mise à jour ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $date = $_POST["date_creation"];

    $update = $pdo->prepare("UPDATE exercice SET titre=?, auteur=?, date_creation=? WHERE id=?");
    $update->execute([$titre, $auteur, $date, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Modifier</title>
</head>
<body>

<h2>Modifier un exercice</h2>

<form method="post">
    <label>Titre : </label>
    <input type="text" name="titre" value="<?php echo $exo['titre']; ?>"><br><br>

    <label>Auteur : </label>
    <input type="text" name="auteur" value="<?php echo $exo['auteur']; ?>"><br><br>

    <label>Date : </label>
    <input type="date" name="date_creation" value="<?php echo $exo['date_creation']; ?>"><br><br>

    <button type="submit">Modifier</button>
</form>

</body>
</html>

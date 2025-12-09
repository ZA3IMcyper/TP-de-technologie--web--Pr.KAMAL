<?php
$file = "messages.txt";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $msg = trim($_POST["msg"]);

    if ($nom && $msg) {
        $entry = "-----\nNom: $nom\nMessage: $msg\nDate: " . date("d/m/Y H:i") . "\n";
        file_put_contents($file, $entry, FILE_APPEND);
        echo "<p style='color:green'>Message enregistré !</p>";
    }
}
?>
<h1>Livre d’or</h1>
<form method="POST">
    Nom : <input type="text" name="nom"><br><br>
    Message : <textarea name="msg"></textarea><br><br>
    <button type="submit">Envoyer</button>
</form>

<h2>Messages :</h2>
<?php
if (file_exists($file)) {
    $content = explode("-----", file_get_contents($file));
    foreach ($content as $c) {
        if (trim($c) === "") continue;
        echo "<pre>$c</pre><hr>";
    }
}
?>

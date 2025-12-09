<?php
$questions = [
    ["q" => "Quel langage côté serveur ?", "r" => ["HTML","CSS","PHP","JS"], "c" => 2],
    ["q" => "Variable PHP commence par ?", "r" => ["#","$","&","%"], "c" => 1],
    ["q" => "Extension d’un fichier PHP ?", "r" => [".ph",".php",".web",".html"], "c" => 1]
];

$score = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($questions as $i => $q)
        if (isset($_POST["q$i"]) && $_POST["q$i"] == $q["c"])
            $score++;
}
?>

<h1>Mini-Quiz PHP</h1>

<?php if ($_SERVER["REQUEST_METHOD"] !== "POST"): ?>
<form method="POST">
    <?php foreach ($questions as $i => $q): ?>
        <p><strong><?= $q["q"] ?></strong></p>
        <?php foreach ($q["r"] as $k => $rep): ?>
            <label><input type="radio" name="q<?= $i ?>" value="<?= $k ?>"> <?= $rep ?></label><br>
        <?php endforeach; ?>
        <br>
    <?php endforeach; ?>
    <button type="submit">Valider</button>
</form>

<?php else: ?>
<p>Score : <strong><?= $score ?>/<?= count($questions) ?></strong></p>
<a href="ex6.php">Recommencer</a>
<?php endif; ?>

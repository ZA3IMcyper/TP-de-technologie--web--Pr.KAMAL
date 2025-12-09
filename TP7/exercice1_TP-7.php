<?php
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n1 = $_POST["n1"] ?? null;
    $n2 = $_POST["n2"] ?? null;
    $op = $_POST["op"] ?? "";

    if ($n1 === "" || $n2 === "") {
        $error = "Veuillez remplir tous les champs.";
    } else {
        switch ($op) {
            case "add":  $result = $n1 + $n2; break;
            case "sub":  $result = $n1 - $n2; break;
            case "mul":  $result = $n1 * $n2; break;
            case "div":
                if ($n2 == 0) {
                    $error = "Division par zéro impossible.";
                } else {
                    $result = $n1 / $n2;
                }
                break;
            default:
                $error = "Opération inconnue.";
        }
    }
}
?>
<h1>Calculatrice</h1>
<form method="POST">
    Nombre 1 : <input type="number" name="n1"><br><br>
    Opération :
    <select name="op">
        <option value="add">+</option>
        <option value="sub">-</option>
        <option value="mul">*</option>
        <option value="div">/</option>
    </select><br><br>
    Nombre 2 : <input type="number" name="n2"><br><br>
    <button type="submit">Calculer</button>
</form>
<?php
if ($error) echo "<p style='color:red'>$error</p>";
if ($result !== "") echo "<p>Résultat : <strong>$result</strong></p>";
?>

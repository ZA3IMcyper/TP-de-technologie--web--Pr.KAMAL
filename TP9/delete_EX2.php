<?php
require "db.php";

$id = intval($_GET["id"]);

$stmt = $pdo->prepare("DELETE FROM exercice WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;

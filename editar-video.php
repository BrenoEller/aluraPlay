<?php

require "src/connection-db.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if($id === false) {
    header('Location: index.php?success=0');
    exit;
};

$sql = "UPDATE videos SET url = ?, title = ? WHERE id = ?;";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $title);
$statement->bindValue(3, $id);
$statement->execute();

if($statement === false) {
    header('Location: index.php?success=0');
} else {
    header('Location: index.php?success=1');
}

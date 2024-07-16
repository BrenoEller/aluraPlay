<?php

require "src/connection-db.php";

$id = $_GET['id'];

$sql = "DELETE FROM videos WHERE id = ?;";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);
$statement->execute();

if($statement === false) {
    header('Location: index.php?success=0');
} else {
    header('Location: index.php?success=1');
}

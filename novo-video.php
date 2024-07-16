<?php

require "src/connection-db.php";

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if($url === false) {
    header('Location: index.php?success=0');
    exit;
};

$sql = "INSERT INTO videos (url, title) VALUES (?, ?);";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $title);
$statement->execute();

if($statement === false) {
    header('Location: index.php?success=0');
} else {
    header('Location: index.php?success=1');
}


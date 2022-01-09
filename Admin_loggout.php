<?php

$pdo = require_once './database.php';
$sessionadminId = $_COOKIE['sessionadmin'] ?? '';

if ($sessionadminId) {
    $statement = $pdo->prepare('DELETE FROM sessionadmin WHERE id=:id');
    $statement->bindValue(':id', $sessionadminId);
    $statement->execute();
    setcookie('sessionadmin', '', time() -1);
    header('Location: /index.php');
}else {
    header('Location: /index.php');
}

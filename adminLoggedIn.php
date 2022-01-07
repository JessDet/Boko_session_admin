<?php

function adminLoggedIn() {

    $pdo = require_once './database.php';
$sessionadminId = $_COOKIE['sessionadmin'] ?? '';


    if($sessionadminId) {
        $statementSessionadmin = $pdo->prepare('SELECT * FROM sessionadmin WHERE id=:id');
        $statementSessionadmin->bindValue(':id', $sessionadminId);
        $statementSessionadmin->execute();
        $sessionadmin = $statementSessionadmin->fetch();
        
        $adminStatement = $pdo->prepare('SELECT * FROM admin WHERE id_admin=:id');
        $adminStatement->bindValue(':id', $sessionadmin['idsessionadmin']);
        $adminStatement->execute();
        $admin = $adminStatement-> fetch();
    } 

    return $admin ?? false;

}
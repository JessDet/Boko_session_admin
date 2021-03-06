<?php

$pdo = require_once'./database.php';



require './adminLoggedIn.php';
$admin = adminLoggedIn();


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_input = filter_input_array(INPUT_POST, [
        'pseudo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);

    $pseudo = $_input['pseudo'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$password || !$pseudo) {
        $error = "Données incorrectes";
    } else {
        $statementAdmin = $pdo->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
        $statementAdmin->bindValue(':pseudo', $pseudo);
        $statementAdmin->execute();
        $admin = $statementAdmin->fetch();
    }

    if ($admin && password_verify($password, $admin['password'])) {
            $statementSessionadmin = $pdo->prepare('INSERT INTO sessionadmin VALUES (default, :idadmin)');
            $statementSessionadmin->bindValue(':idadmin', $admin['idadmin']);
            $statementSessionadmin->execute();
            $sessionadminId = $pdo->lastInsertId();
        setcookie('sessionadmin', $sessionadminId, time() + 60 * 3, '', '', false, true);
        header('Location: /admin_fiche_recette.php');
    } else {
        echo "Pseudo ou Password incorrect";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link rel="stylesheet" href="/CSS/Header-Footer.css">
    <title>Connexion</title>
</head>

<!-- <header>
    <img class="logo" src="/IMG/BOKO détouré.png" alt="BOKO" >
</header> -->

<body>
<img class="feuillage" src="/IMG/feuillage.jpg" alt="">

    <div class="container" id="container">

            <form class="connexion_admin" action="/index.php" method="POST">
                <h1>Admin</h1>

                <input type="text" name="pseudo" id="pseudo" placeholder="pseudo">
                <input type="password" name="password" id="password" placeholder="password">
                <button>Connexion</button>
            </form>
    
    </div>

</body>
</html>
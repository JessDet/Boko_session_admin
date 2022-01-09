<?php

$pdo = require_once './database.php';
$errors = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_input = filter_input_array(INPUT_POST, [
        'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
    ]);

    $pseudo = $_input['pseudo'] ?? '';
    $password = $_POST['password'] ?? '';

if (!$pseudo || !$password) {
    $errors = "champs obligatoires";
} else {
    $hashPassword = password_hash($password, PASSWORD_ARGON2I);
    $statement = $pdo->prepare('INSERT INTO admin VALUES(
        DEFAULT,
        :pseudo,
        :password
    )');

        $statement->bindvalue(':pseudo', $pseudo);
        $statement->bindvalue(':password', $hashPassword);
        $statement->execute();

        header('Location: ./Admin_recettes.php');

}
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/Inscription.css">
    <link rel="stylesheet" href="/CSS/Header-Footer.css"> 
    <title>Crea_Count</title>
</head>
<body>

    

<div class="container" id="container">
	<div class="form-container sign-up-container" id="form-container">
		<form action="/crea_count.php" method="POST">
			<h1>Crea compte admin</h1>
			
                <input type="text" placeholder="pseudo" name="pseudo"><br><br>
                <input type="password" placeholder="password" name="password"><br><br>

                <?php if($errors) : ?>
                    <h1 style="color:red"><?=$errors ?></h1>
                <?php endif; ?>
        
			<button>Submit</button>
		</form>
	</div>
    </div>
    
</body>

</html>


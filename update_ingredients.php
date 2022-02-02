<?php
$pdo = require_once'./database.php';


require './adminLoggedIn.php';
$admin = adminLoggedIn();

    $ingredients1 = $ingrdt['ingredients1'];
    $ingredients2 = $ingrdt['ingredients2'];
    $ingredients3 = $ingrdt['ingredients3'];
    $ingredients4 = $ingrdt['ingredients4'];
    $ingredients5 = $ingrdt['ingredients5'];
    $ingredients6 = $ingrdt['ingredients6'];
    $ingredients7 = $ingrdt['ingredients7'];
    $ingredients8 = $ingrdt['ingredients8'];
    $qte1 = $ingrdt['qte1'];
    $qte2 = $ingrdt['qte2'];
    $qte3 = $ingrdt['qte3'];
    $qte4 = $ingrdt['qte4'];
    $qte5 = $ingrdt['qte5'];
    $qte6 = $ingrdt['qte6'];
    $qte7 = $ingrdt['qte7'];
    $qte8 = $ingrdt['qte8'];
    $type1 = $ingrdt['type1'];
    $type2 = $ingrdt['type2'];
    $type3 = $ingrdt['type3'];
    $type4 = $ingrdt['type4'];
    $type5 = $ingrdt['type5'];
    $type6 = $ingrdt['type6'];
    $type7 = $ingrdt['type7'];
    $type8 = $ingrdt['type8'];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = $_COOKIE['idrecette'];
    $ingredients1 = $_POST['ingredients1'];
    $ingredients2 = $_POST['ingredients2'];
    $ingredients3 = $_POST['ingredients3'];
    $ingredients4 = $_POST['ingredients4'];
    $ingredients5 = $_POST['ingredients5'];
    $ingredients6 = $_POST['ingredients6'];
    $ingredients7 = $_POST['ingredients7'];
    $ingredients8 = $_POST['ingredients8'];
    $qte1 = $_POST['qte1'];
    $qte2 = $_POST['qte2'];
    $qte3 = $_POST['qte3'];
    $qte4 = $_POST['qte4'];
    $qte5 = $_POST['qte5'];
    $qte6 = $_POST['qte6'];
    $qte7 = $_POST['qte7'];
    $qte8 = $_POST['qte8'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'];
    $type3 = $_POST['type3'];
    $type4 = $_POST['type4'];
    $type5 = $_POST['type5'];
    $type6 = $_POST['type6'];
    $type7 = $_POST['type7'];
    $type8 = $_POST['type8'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Admin_recette.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="form_container">
            <div class="form_container_recipe">
                <form action="/update_ingredients.php" method="POST">
                    <div class="form_control">
                        <input type="text" name="ingredients1" placeholder="Ingredients 1">
                        <input type="number" name="qte1" placeholder="Quantite"><br>
                        <input type="text" name="type1" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients2" placeholder="Ingredients 1">
                        <input type="number" name="qte2" placeholder="Quantite"><br>
                        <input type="text" name="type2" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients3" placeholder="Ingredients 1">
                        <input type="number" name="qte3" placeholder="Quantite"><br>
                        <input type="text" name="type3" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients4" placeholder="Ingredients 1">
                        <input type="number" name="qte4" placeholder="Quantite"><br>
                        <input type="text" name="type4" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients5" placeholder="Ingredients 1">
                        <input type="number" name="qte5" placeholder="Quantite"><br>
                        <input type="text" name="type5" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients6" placeholder="Ingredients 1">
                        <input type="number" name="qte6" placeholder="Quantite"><br>
                        <input type="text" name="type6" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients7" placeholder="Ingredients 1">
                        <input type="number" name="qte7" placeholder="Quantite"><br>
                        <input type="text" name="type7" placeholder="Type">
                    </div>
                    <div class="form_control">
                        <input type="text" name="ingredients8" placeholder="Ingredients 1">
                        <input type="number" name="qte8" placeholder="Quantite"><br>
                        <input type="text" name="type8" placeholder="Type">
                    </div>
                    <button class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
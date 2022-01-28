<?php

$id = $_GET['id'] ?? '';
setcookie('idrecette', $id, time() + 60 * 60, '', '', false, true);

// if (!$id) {
//     header('Location: /');
// }

$pdo = require_once './database.php';

$stateIngredient = $pdo->prepare('INSERT INTO ingredients VALUES (
    DEFAULT,
    :name,
    :qte,
    :type
)');

$stateRecetteIngredient = $pdo->prepare('INSERT INTO possede VALUES (
    :idIng,
    :idrecette
)');

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

    if ($ingredients1 && $qte1) {
        $stateIngredient->bindValue(':name', $ingredients1);
        $stateIngredient->bindValue(':qte', $qte1);
        if ($type1) {
            $stateIngredient->bindValue(':type', $type1);
        } else {
            $stateIngredient->bindValue(':type', '');
        }
        $stateIngredient->execute();
        $id1 = $pdo->lastInsertId();
        $stateRecetteIngredient->bindValue(':idIng', $id1);
        $stateRecetteIngredient->bindValue(':idrecette', $id);
        $stateRecetteIngredient->execute();
        if ($ingredients2 && $qte2) {
            $stateIngredient->bindValue(':name', $ingredients2);
            $stateIngredient->bindValue(':qte', $qte2);
            if ($type2) {
                $stateIngredient->bindValue(':type', $type2);
            } else {
                $stateIngredient->bindValue(':type', '');
            }
            $stateIngredient->execute();
            $id2 = $pdo->lastInsertId();
            $stateRecetteIngredient->bindValue(':idIng', $id2);
            $stateRecetteIngredient->bindValue(':idrecette', $id);
            $stateRecetteIngredient->execute();
            if ($ingredients3 && $qte3) {
                $stateIngredient->bindValue(':name', $ingredients3);
                $stateIngredient->bindValue(':qte', $qte3);
                if ($type3) {
                    $stateIngredient->bindValue(':type', $type3);
                } else {
                    $stateIngredient->bindValue(':type', '');
                }
                $stateIngredient->execute();
                $id3 = $pdo->lastInsertId();
                $stateRecetteIngredient->bindValue(':idIng', $id3);
                $stateRecetteIngredient->bindValue(':idrecette', $id);
                $stateRecetteIngredient->execute();
                if ($ingredients4 && $qte4) {
                    $stateIngredient->bindValue(':name', $ingredients4);
                    $stateIngredient->bindValue(':qte', $qte4);
                    if ($type4) {
                        $stateIngredient->bindValue(':type', $type4);
                    } else {
                        $stateIngredient->bindValue(':type', '');
                    }
                    $stateIngredient->execute();
                    $id4 = $pdo->lastInsertId();
                    $stateRecetteIngredient->bindValue(':idIng', $id4);
                    $stateRecetteIngredient->bindValue(':idrecette', $id);
                    $stateRecetteIngredient->execute();
                    if ($ingredients5 && $qte5) {
                        $stateIngredient->bindValue(':name', $ingredients5);
                        $stateIngredient->bindValue(':qte', $qte5);
                        if ($type5) {
                            $stateIngredient->bindValue(':type', $type5);
                        } else {
                            $stateIngredient->bindValue(':type', '');
                        }
                        $stateIngredient->execute();
                        $id5 = $pdo->lastInsertId();
                        $stateRecetteIngredient->bindValue(':idIng', $id5);
                        $stateRecetteIngredient->bindValue(':idrecette', $id);
                        $stateRecetteIngredient->execute();
                        if ($ingredients6 && $qte6) {
                            $stateIngredient->bindValue(':name', $ingredients6);
                            $stateIngredient->bindValue(':qte', $qte6);
                            if ($type6) {
                                $stateIngredient->bindValue(':type', $type6);
                            } else {
                                $stateIngredient->bindValue(':type', '');
                            }
                            $stateIngredient->execute();
                            $id6 = $pdo->lastInsertId();
                            $stateRecetteIngredient->bindValue(':idIng', $id6);
                            $stateRecetteIngredient->bindValue(':idrecette', $id);
                            $stateRecetteIngredient->execute();
                            if ($ingredients7 && $qte7) {
                                $stateIngredient->bindValue(':name', $ingredients7);
                                $stateIngredient->bindValue(':qte', $qte7);
                                if ($type7) {
                                    $stateIngredient->bindValue(':type', $type7);
                                } else {
                                    $stateIngredient->bindValue(':type', '');
                                }
                                $stateIngredient->execute();
                                $id7 = $pdo->lastInsertId();
                                $stateRecetteIngredient->bindValue(':idIng', $id7);
                                $stateRecetteIngredient->bindValue(':idrecette', $id);
                                $stateRecetteIngredient->execute();
                                if ($ingredients8 && $qte8) {
                                    $stateIngredient->bindValue(':name', $ingredients8);
                                    $stateIngredient->bindValue(':qte', $qte8);
                                    if ($type8) {
                                        $stateIngredient->bindValue(':type', $type8);
                                    } else {
                                        $stateIngredient->bindValue(':type', '');
                                    }
                                    $stateIngredient->execute();
                                    $id8 = $pdo->lastInsertId();
                                    $stateRecetteIngredient->bindValue(':idIng', $id8);
                                    $stateRecetteIngredient->bindValue(':idrecette', $id);
                                    $stateRecetteIngredient->execute();

                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
        header('Location: /ingredients.php?id=' . $id);
}

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
                <form action="/ingredients.php" method="POST">
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
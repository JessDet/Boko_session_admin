<?php
 
 $pdo = require './database.php';

 $id = $_GET['id'] ?? '';

 $stateRead = $pdo('SELECT * FROM recettes WHERE idrecette=:id');
 $stateRead->bindValue(':id', $id);
 $stateRead->execute();
 $recette=$stateRead->fetchAll();

    $titre = $recette['titre'] ?? '';
    $date = $recette['date'] ?? '';
    $presentation = $recette['presentation'] ?? '';
    $durée = $recette['duree'] ?? '';
    $difficulté = $recette['difiiculte'] ?? '';
    $budget = $recette['budget'] ?? '';
    $preparation = $recette['preparation'] ?? '';
    $img1 = $recette['img1'] ?? '';
    $img2 = $recette['img2'] ?? '';
    $img3 = $recette['img3'] ?? '';
    $name = $categorie['categorie'] ?? '';
    $id = $recette['id'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $titre = $_POST['titre'] ?? '';
        $date = $_POST['date'] ?? '';
        $presentation = $_POST['presentation'] ?? '';
        $duree = $_POST['duree'] ?? '';
        $difficulte = $_POST['difficulte'] ?? '';
        $budget = $_POST['budget'] ?? '';
        $preparation = $_POST['preparation'];
        $img1 = $_POST['img1'] ?? '';
        $img2 = $_POST['img2'] ?? '';
        $img3 = $_POST['img3'] ?? '';
        $idCat = $_POST['categorie'] ?? '';
    }

    $stateUpdate = $pdo->prepare('
    UPDATE recettes
    SET
        titre=:titre,
        date=:date,
        presentation=:presentation,
        duree=:duree,
        difficulte=:difficulte,
        budget=:budget,
        preparation=:preparation,
        img1=:img1,
        img2=:img2,
        img3=:img3,
        idCat=:idCat
    WHERE id=:id
    ');
        $stateUpdate->bindValue(":titre", $titre);
        $stateUpdate->bindValue(":date", $date);
        $stateUpdate->bindValue(":presentation", $presentation);
        $stateUpdate->bindValue(":duree", $duree);
        $stateUpdate->bindValue(":budget", $budget);
        $stateUpdate->bindValue(":difficulte", $difficulte);
        $stateUpdate->bindValue(":preparation", $preparation);
        $stateUpdate->bindValue(":img1", $img1);
        $stateUpdate->bindValue(":img2", $img2);
        $stateUpdate->bindValue(":img3", $img3);
        $stateUpdate->bindValue(":idCat", $idCat);
        $stateUpdate->execute();

        header('Location: /ingredients.php?id=' . $id);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Admin_recette.css">
    <title>Admin</title>
</head>

<body>

    <h1>ESPACE ADMIN</h1>

    <div class="container">
        <div class="form_container">
            <div class="form_container_recipe">
                <form action="/admin_fiche_recette.php" <?= $id ? "id=$id" : '' ?> method="POST">
                    <div class="form_control">
                        <label for="title">Titre</label>
                        <input type="text" name="titre" id="title" placeholder="title" value=" <?= $titre ?? '' ?>">
                        <p class="text_error"><?= $errors['titre'] ?></p>
                    </div>

                    <div class="form_control">
                        <label for="title">Date</label>
                        <input type="date" name="date" id="date" placeholder="date" value=" <?= $date ?? '' ?>">
                        <p class="text_error"><?= $errors['date'] ?></p>
                    </div>

                    <div class="form_control">
                        <textarea cols="30" rows="10" name="presentation" id="presentation" placeholder="presentation" value="<?= $presentation ?? '' ?>"></textarea>
                        <p class="text_error" <?= $errors['presentation'] ?>></p>
                    </div>

                    <div class="form_control">
                        <label for="duree">Durée</label>
                        <input type="number" min="0" value="0" name="duree" id="duree" placeholder="duree">
                        <p class="text_error"><?= $errors['duree'] ?></p>
                    </div>

                    <div class="form_control">
                        <label for="difficulte">Difficulté</label>
                        <select name="difficulte" id="difficulte">
                            <option value="facile">Facile</option>
                            <option value="moyen">Moyen</option>
                            <option value="difficile">Difficile</option>
                        </select>
                        <p class="text_error"><?= $errors['difficulte'] ?></p>
                    </div>

                    <div class="form_control">
                        <label for="budget">Budget</label>
                        <select name="budget" id="budget">
                            <option value="cher">cher</option>
                            <option value="moyen">moyen</option>
                            <option value="peu élevé">peu élevé</option>
                        </select>
                        <p class="text_error"><?= $errors['budget'] ?></p>
                    </div>

                    <div class="form_control">
                        <textarea cols="30" rows="10" name="preparation" id="preparation" placeholder="preparation"></textarea>
                        <p class=" text_error"><?= $errors['preparation'] ?></p>
                    </div>
<div class="form-img">
                    <div class="form_control">
                        <label for="title">Image1</label>
                        <input type="text" name="img1" id="img1" placeholder="img1" value="<?= $img1 ?? '' ?>">
                        <p class="text_error"><?= $errors['image1'] ?></p>
                    </div>
                    <div class="form_control">
                        <label for="title">Image2</label>
                        <input type="text" name="img2" id="img2" placeholder="img2" value="<?= $img2 ?? '' ?>">
                        <p class="text_error"><?= $errors['image2'] ?></p>
                    </div>
                    <div class="form_control">
                        <label for="title">Image3</label>
                        <input type="text" name="img3" id="img3" placeholder="img3" value="<?= $img3 ?? '' ?>">
                        <p class="text_error"><?= $errors['image3'] ?></p>
                    </div>
</div>
                    <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="categorie" id="category">
                            <option value="2">Cosmetiques</option>
                            <option value="3">Maison</option>
                            <option value="1">Cuisine</option>
                        </select>
                    </div>
                    <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                    <button class="btn btn-primary"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                </form>
            </div>
        </div>

    </div>
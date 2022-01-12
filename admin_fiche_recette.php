<?php

const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_TITLE_SHORT = "Le titre est trop court";
const ERR_CONTENT_SHORT = "L'article est trop court";
const ERR_URL = "L'image doit avoir une URL valide";

$pdo = require_once './database.php';



// $statementRead = $pdo->prepare('SELECT * FROM categorie');
// $statementRead->execute();
// $categories = $statementRead->fetchAll();

// echo "<pre>";
// var_dump($categories);
// echo "</pre>";
// die();

$errors = [
    'titre' => '',
    'date' => '',
    'presentation' => '',
    'duree' => '',
    'difficulte' => '',
    'budget' => '',
    'preparation' => '',
    'image1' => '',
    'image2' => '',
    'image3' => ''
];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $statementRead->bindValue(':id', $id);
    $statementRead->execute();
    $recettes = $statementRead->fetch();
    $titre = $recettes['titre'];
    $date = $recettes['date'];
    $presentation = $recettes['presentation'];
    $durée = $recettes['duree'];
    $difficulté = $recettes['difiiculte'];
    $budget = $recettes['budget'];
    $preparation = $recettes['preparation'];
    $img1 = $recettes['image1'];
    $img2 = $recettes['image2'];
    $img3 = $recettes['image3'];
    $name = $categorie['categorie'];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_input = filter_input_array(INPUT_POST, [
        'titre' => FILTER_SANITIZE_STRING,
        'date' => FILTER_SANITIZE_NUMBER_FLOAT,
        'presentation' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'difficulte' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'budget' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'preparation' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'img1' => FILTER_SANITIZE_URL,
        'img2' => FILTER_SANITIZE_URL,
        'img3' => FILTER_SANITIZE_URL
    ]);


    $titre = $_input['titre'] ?? '';
    $date = $_input['date'] ?? '';
    $presentation = $_input['presentation'] ?? '';
    $duree = $_POST['duree'] ?? '';
    $difficulte = $_input['difficulte'] ?? '';
    $budget = $_input['budget'] ?? '';
    $preparation = $_input['preparation'];
    $img1 = $_input['img1'] ?? '';
    $img2 = $_input['img2'] ?? '';
    $img3 = $_input['img3'] ?? '';
    $idCat = $_POST['categorie'] ?? '';


    if (!$titre) {
        $errors['title'] = ERR_REQUIRED;
    } else if (mb_strlen($titre) < 3) {
        $errors['title'] = ERR_TITLE_SHORT;
    }

    if (!$date) {
        $errors['date'] = ERR_REQUIRED;
    }

    if (!$presentation) {
        $errors['presentation'] = ERR_REQUIRED;
    }

    if (!$duree) {
        $errors['duree'] = ERR_REQUIRED;
    }

    if (!$difficulte) {
        $errors['difficulte'] = ERR_REQUIRED;
    }

    if (!$budget) {
        $errors['budget'] = ERR_REQUIRED;
    }

    if (!$preparation) {
        $errors['preparation'] = ERR_REQUIRED;
    }

    if (!filter_var($img1, FILTER_VALIDATE_URL)) {
        $errors['image1'] = ERR_URL;
    }

    if (!filter_var($img2, FILTER_VALIDATE_URL)) {
        $errors['image2'] = ERR_URL;
    }
    if (!filter_var($img3, FILTER_VALIDATE_URL)) {
        $errors['image3'] = ERR_URL;
    }

    // echo "<pre>";
    // var_dump($errors);
    // echo "</pre>";
    // die();
    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        $statementCreate = $pdo->prepare('
        INSERT INTO recettes(
            titre,
            date,
            presentation,
            duree,
            difficulte,
            budget,
            preparation,
            img1,
            img2,
            img3,
            idCat
            ) VALUES (
                :titre,
                :date,
                :presentation,
                :duree,
                :difficulte,
                :budget,
                :preparation,
                :img1,
                :img2,
                :img3,
                :idCat
                )
        ');
        $statementCreate->bindValue(":titre", $titre);
        $statementCreate->bindValue(":date", $date);
        $statementCreate->bindValue(":presentation", $presentation);
        $statementCreate->bindValue(":duree", $duree);
        $statementCreate->bindValue(":budget", $budget);
        $statementCreate->bindValue(":difficulte", $difficulte);
        $statementCreate->bindValue(":preparation", $preparation);
        $statementCreate->bindValue(":img1", $img1);
        $statementCreate->bindValue(":img2", $img2);
        $statementCreate->bindValue(":img3", $img3);
        $statementCreate->bindValue(":idCat", $idCat);

        // echo "<pre>";
        // echo $titre . "<br>";
        // echo $date . "<br>";
        // echo $presentation . "<br>";
        // echo $budget . "<br>";
        // echo $duree . "<br>";
        // echo $difficulte . "<br>";
        // echo $preparation . "<br>";
        // echo $img1 . "<br>";
        // echo $img2 . "<br>";
        // echo $img3 . "<br>";
        // echo $idCat . "<br>";
        // echo "</pre>";
        // die();
        $statementCreate->execute();
        $id = $pdo->lastInsertId();
        header('Location: /ingredients.php?id=' . $id);
    }
    // header('Location: /');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Admin.css">
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
                            <option value="couteux">couteux</option>
                        </select>
                        <p class="text_error"><?= $errors['budget'] ?></p>
                    </div>

                    <div class="form_control">
                        <textarea cols="30" rows="10" name="preparation" id="preparation" placeholder="preparation"></textarea>
                        <p class=" text_error"><?= $errors['preparation'] ?></p>
                    </div>

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



</body>

</html>
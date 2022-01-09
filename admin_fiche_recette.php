<?php

const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_TITLE_SHORT = "Le titre est trop court";
const ERR_CONTENT_SHORT = "L'article est trop court";
const ERR_URL = "L'image doit avoir une URL valide";

$pdo = require_once './database.php';

$statetementCreate = $pdo->prepare('
INSERT INTO recettes(
    titre,
    date,
    presentation,
    duree,
    difficulte,
    budget,
    preparation,
    image1,
    image2,
    image3
    ) VALUES (
        :titre,
        :date,
        :presentation,
        :duree,
        :difficulte,
        :budget,
        :preparation,
        :image1,
        :image2,
        :image3
        )

');

$statementUpdate = $pdo->prepare('
    UPDATE recette
    SET
    titre=:titre,
    date=:date,
    presentation=:presentation,
    duree=:duree,
    difficulte=:difficulte,
    preparation=:preparation,
    budget=:budget,
    image1=:image1,
    image2=:image2,
    image3=:image3
    WHERE idarticle=:id

');

$statementRead = $pdo->prepare('SELECT * FROM recettes WHERE idrecette=:id' );

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
    'image3' => '',
    'name' => '',
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
        $image1 = $recettes['image1'];
        $image2 = $recettes['image2'];
        $image3 = $recettes['image3'];
        $name = $categorie['name'];
    
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_POST = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_STRING,
        'date' => FILTER_SANITIZE_NUMBER_FLOAT,
        'presentation' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'duree' => FILTER_SANITIZE_NUMBER_FLOAT,
        'difficulte' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'budget' => FILTER_SANITIZE_NUMBER_FLOAT,
        'preparation' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'image1' => FILTER_SANITIZE_URL,
        'image2' => FILTER_SANITIZE_URL,
        'image3' => FILTER_SANITIZE_URL,
        'name' => FILTER_SANITIZE_STRING
        ]);


$titre = $_POST['titre'] ?? '';
$date = $_POST['date'] ?? '';
$presentation = $_POST['presentation'] ?? '';
$durée = $_POST['duree'] ?? '';
$difficulté = $_POST['difficulte'] ?? '';
$budget = $_POST['budget'] ?? '';
$preparation = $_POST['preparation'];
$image1 = $_POST['image1'] ?? '';
$image2 = $_POST['image2'] ?? '';
$image3 = $_POST['image3'] ?? '';
$name = $_POST['name'] ?? '';


if (!$title) {
    $errors['title'] = ERR_REQUIRED;
} else if (mb_strlen($title) < 3) {
    $errors['title'] = ERR_TITLE_SHORT;
}

if (!$date) {
    $errors['date'] = ERR_REQUIRED;
}

if (!$presentation) {
    $errors['presentation'] = ERR_REQUIRED;
}

if (!$durée) {
    $errors['duree'] = ERR_REQUIRED;
}

if (!$difficulté) {
    $errors['difficulte'] = ERR_REQUIRED;
}

if (!$budget) {
    $errors['budget'] = ERR_REQUIRED;
}

if (!$preparation) {
    $errors['preparation'] = ERR_REQUIRED;
}

if (!$image1) {
    $errors['image1'] = ERR_REQUIRED;
} else if (!filter_var($image1, FILTER_VALIDATE_URL)) {
    $errors['image1'] = ERR_URL;
}

 if (!filter_var($image2, FILTER_VALIDATE_URL)) {
    $errors['image2'] = ERR_URL;
}
if (!filter_var($image3, FILTER_VALIDATE_URL)) {
    $errors['image3'] = ERR_URL;
}

if (!$name) {
    $errors['name'] = ERR_REQUIRED;
}


if(empty(array_filter($errors, fn ($e) => $e !== ''))){
    $recettes['titre'] = $titre;
    $recettes['date'] = $date;
    $recettes['presentation'] = $presentation;
    $recettes['duree'] = $duree;
    $recettes['difficulte'] = $difficulte;
    $recettes['budget'] = $budget;
    $recettes['preparation'] = $preparation;
    $recettes['image1'] = $image1;
    $recettes['image2'] = $image2;
    $recettes['image3'] = $image3;
    $categorie['name'] = $name;
    
    $statementUpdate->bindValue(':titre', $recettes['titre']);
    $statementUpdate->bindValue(':date', $recettes['date']);
    $statementUpdate->bindValue(':presentation', $recettes['presentation']);
    $statementUpdate->bindValue(':duree', $recettes['duree']);
    $statementUpdate->bindValue(':difficulte', $recettes['difficulte']);
    $statementUpdate->bindValue(':budget', $recettes['budget']);
    $statementUpdate->bindValue(':preparation', $recettes['preparation']);
    $statementUpdate->bindValue(':image1', $recettes['image1']);
    $statementUpdate->bindValue(':image2', $recettes['image2']);
    $statementUpdate->bindValue(':image3', $recettes['image3']); 
    $statementUpdate->bindValue(':name', $categorie['name']); 
    $statementUpdate->bindValue(':id', $id);
    $statementUpdate->execute();
}else {
    $statementCreate->bindValue(':titre', $titre);
    $statementCreate->bindValue(':date', $date);
    $statementCreate->bindValue(':presentation', $presentation);
    $statementCreate->bindValue(':duree', $duree);
    $statementCreate->bindValue(':difficulte', $difficulte);
    $statementCreate->bindValue(':budget', $budget);
    $statementCreate->bindValue(':preparation', $preparation);
    $statementCreate->bindValue(':image1', $image1);
    $statementCreate->bindValue(':image2', $image2);
    $statementCreate->bindValue(':image3', $image3);
    $statementCreate->bindValue(':name', $name);
    $statementCreate->execute();
}
header('Location: /');
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
            <form action="/Admin_recettes.php" <?= $id ? "id=$id" : '' ?> methode="POST">
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
                    <label for="title">Presentation</label>
                    <input type="text" name="presentation" id="presentation" placeholder="presentation" value="<?= $presentation ?? '' ?>">
                    <p class="text_error"<?= $errors['presentation'] ?>></p>
                </div>

                <div class="form_control">
                    <label for="duree">Durée</label>
                    <input type="duree" name="duree" id="duree" placeholder="duree" value=" <?= $duree ?? '' ?>">
                    <p class="text_error"><?= $errors['duree'] ?></p>
                </div>

                <div class="form_control">
                    <label for="difficulte">Difficulté</label>
                    <input type="text" name="difficulte" id="difficulte" placeholder="difficulte" value=" <?= $difficulte ?? '' ?>">
                    <p class="text_error"><?= $errors['difficulte'] ?></p>
                </div>

                <div class="form_control">
                    <label for="budget">Budget</label>
                    <input type="text" name="budget" id="budget" placeholder="budget" value=" <?= $budget ?? '' ?>">
                    <p class="text_error"><?= $errors['budget'] ?></p>
                </div>

                <div class="form_control">
                    <label for="preparation">Preparation</label>
                    <input type="text" name="preparation" id="preparation" placeholder="preparation" value=" <?= $preparation ?? '' ?>">
                    <p class="text_error"><?= $errors['preparation'] ?></p>
                </div>

                <div class="form_control">
                    <label for="title">Image1</label>
                    <input type="text" name="image1" id="image1" placeholder="image1" value="<?= $image1 ?? '' ?>">
                    <p class="text_error"><?= $errors['image1'] ?></p>
                </div>
                <div class="form_control">
                    <label for="title">Image2</label>
                    <input type="text" name="image2" id="image2" placeholder="image2" value="<?= $image2 ?? '' ?>">
                    <p class="text_error"><?= $errors['image2'] ?></p>
                </div>
                <div class="form_control">
                    <label for="title">Image3</label>
                    <input type="text" name="image3" id="image3" placeholder="image3" value="<?= $image3 ?? '' ?>">
                    <p class="text_error"><?= $errors['image3'] ?></p>
                </div>
                       
            
            </form>
          </div>

            <div class="form_container_ingredients">
                <form action="/Admin_recettes.php" <?= $id ? "idCat=$id" : '' ?> methode="POST">
                    <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="categorie" id="categorie">
                        <option <?= !$name || $name ==="cuisine" ? 'selected' : '' ?> value="cuisine">Cuisine</option>
                        <option <?= $name ==="cosmetique" ? 'selected' : '' ?> value="cosmetique">Cosmetiques</option>
                        <option  <?= $name ==="maison" ? 'selected' : '' ?> value="maison">Maison</option>
                        </select>
                        <p class="text-error"><?= $errors['name']?></p>
                    </div>
                </form>
            </div>







      </div>
      <div class="form-action">
                    <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                    <button class="btn btn-primary"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                </div>

  </div>



</body>
</html>
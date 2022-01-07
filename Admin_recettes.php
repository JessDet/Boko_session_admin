<?php



const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_TITLE_SHORT = "Le titre est trop court";
const ERR_CONTENT_SHORT = "L'article est trop court";
const ERR_URL = "L'image doit avoir une URL valide";

$pdo = require_once './database.php';

$statementCreate = $pdo->prepare('
INSERT INTO recettes(
    titre,
    descriptif,
    image) VALUES (
        :titre,
        :descriptif,
        :image1,
        :categorie
        )
');

$statementUpdate = $pdo->prepare('
    UPDATE article
    SET
    titre=:titre,
    descriptif=:descriptif,
    image1=:image1,
    categorie=:categorie
    WHERE idarticle=:id
');

$statementRead = $pdo->prepare('SELECT * FROM recettes WHERE idrecette=:id');

$errors = [
    'titre' => '',
    'descriptif' => '',
    'image1' => '',
    'categorie' => ''
    ];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $statementRead->bindValue(':id', $id);
    $statementRead->execute();
    $recettes = $statementRead->fetch();
        $titre = $recettes['titre'];
        $descriptif = $recettes['descriptif'];
        $image1 = $recettes['image1'];
        $categorie = $recettes['categorie'];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_POST = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_STRING,
        'content' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'image' => FILTER_SANITIZE_URL,
        'categorie' => FILTER_SANITIZE_STRING,
        ]);
}

$titre = $_POST['titre'] ?? '';
$descriptif = $_POST['descriptif'] ?? '';
$image1 = $_POST['image1'] ?? '';
$categorie = $_POST['categorie'] ?? '';

if (!$titre) {
    $errors['titre'] = ERR_REQUIRED;
} else if (mb_strlen($titre) < 3) {
    $errors['titre'] = ERR_TITLE_SHORT;
}

if (!$descriptif) {
    $errors['descriptif'] = ERR_REQUIRED;
} else if (mb_strlen($descriptif) < 50) {
    $errors['descriptif'] = ERR_CONTENT_SHORT;
}

if (!$image1) {
    $errors['image1'] = ERR_REQUIRED;
} else if (!filter_var($image1, FILTER_VALIDATE_URL)) {
    $errors['image1'] = ERR_URL;


if (!$categorie) {
    $errors['categorie'] = ERR_REQUIRED;
}


if(empty(array_filter($errors, fn ($e) => $e !== ''))){
    $recettes['titre'] = $titre;
    $recettes['descriptif'] = $descriptif;
    $recettes['image1'] = $image1;
    $recettes['categorie'] = $categorie;
    $statementUpdate->bindValue(':titre', $recettes['titre']);
    $statementUpdate->bindValue(':descriptif', $recettes['descriptif']);
    $statementUpdate->bindValue(':image1', $recettes['image1']);
    $statementUpdate->bindValue(':categorie', $recettes['categorie']);
    $statementUpdate->bindValue(':id', $id);
    $statementUpdate->execute();
}else {
    $statementCreate->bindValue(':titre', $titre);
    $statementCreate->bindValue(':descriptif', $descriptif);
    $statementCreate->bindValue(':image1', $image1);
    $statementCreate->bindValue(':categorie', $categorie);
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
    <title>Document</title>
</head>
<body>
<!-- <?php require_once'includes/header.php' ?> -->

  <h1>ESPACE ADMIN</h1>

  <div class="container">
      <div class="form_container">
          <form action="/Admin_recettes.php" <?= $id ? "id=$id" : '' ?> methode="POST">
              <div class="form_control">
                  <label for="title">Titre</label>
                  <input type="text" name="titre" id="title" placeholder="title" value=" <?= $titre ?? '' ?>">
                  <p class="text_error"><?= $errors['titre'] ?></p>
              </div>

              <div class="form_control">
                  <label for="title">Descriptif</label>
                  <input type="text" name="descriptif" id="descriptif" placeholder="description" value="<?= $description ?? '' ?>">
                  <p class="text_error"<?= $errors['titre'] ?>></p>
              </div>

              <div class="form_control">
                  <label for="title">Image1</label>
                  <input type="text" name="image1" id="image1" placeholder="image1" value="<?= $image1 ?? '' ?>">
                  <p class="text_error"><?= $errors['image1'] ?></p>
              </div>
              
              </div>

              <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="categorie" id="categorie">
                        <option <?= !$categorie || $categorie ==="cuisine" ? 'selected' : '' ?> value="cuisine">Cuisine</option>
                        <option <?= $categorie ==="cosmetique" ? 'selected' : '' ?> value="cosmetique">Cosmetiques</option>
                        <option  <?= $categorie ==="maison" ? 'selected' : '' ?> value="maison">Maison</option>
                       </select>
                        <p class="text-error"><?= $errors['categorie']?></p>
                    </div>

                    <div class="form-action">
                        <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                    </div>

          </form>
      </div>


  </div>







</body>
</html>
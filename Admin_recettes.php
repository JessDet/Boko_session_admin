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
        :image
        )
');

$statementUpdate = $pdo->prepare('
    UPDATE article
    SET
    titre=:titre,
    descriptif=:descriptif,
    image=:image
    WHERE idarticle=:id
');

$statementRead = $pdo->prepare('SELECT * FROM recettes WHERE idrecette=:id');

$errors = [
    'titre' => '',
    'descriptif' => '',
    'image' => ''
    ];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $statementRead->bindValue(':id', $id);
    $statementRead->execute();
    $recettes = $statementRead->fetch();
        $titre = $recettes['titre'];
        $descriptif = $recettes['descriptif'];
        $image = $recettes['image'];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_POST = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_STRING,
        'content' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'image' => FILTER_SANITIZE_URL
        ]);
}

$titre = $_POST['titre'] ?? '';
$descriptif = $_POST['descriptif'] ?? '';
$image = $_POST['image'] ?? '';

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

if (!$image) {
    $errors['image'] = ERR_REQUIRED;
} else if (!filter_var($image, FILTER_VALIDATE_URL)) {
    $errors['image'] = ERR_URL;


if(empty(array_filter($errors, fn ($e) => $e !== ''))){
    $recettes['titre'] = $titre;
    $recettes['descriptif'] = $descriptif;
    $recettes['image'] = $image;
    $statementUpdate->bindValue(':titre', $recettes['titre']);
    $statementUpdate->bindValue(':descriptif', $recettes['descriptif']);
    $statementUpdate->bindValue(':image', $recettes['image']);
    $statementUpdate->bindValue(':id', $id);
    $statementUpdate->execute();
}else {
    $statementCreate->bindValue(':titre', $titre);
    $statementCreate->bindValue(':descriptif', $descriptif);
    $statementCreate->bindValue(':image', $image);
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
<?php require_once'includes/header.php' ?>

  <h1>ESPACE ADMIN</h1>

  <div class="container">
      <div class="form_container">
          <form action="/Admin_recettes.php" methode="POST">
              <div class="form_control">
                  <label for="title">Titre</label>
                  <input type="text" name="titre" id="title" placeholder="title" value="">
                  <p class="text_error"></p>
              </div>
              <div class="form_control">
                  <label for="title">Descriptif</label>
                  <input type="text" name="descriptif" id="descriptif" placeholder="description" value="">
                  <p class="text_error"></p>
              </div>
              <div class="form_control">
                  <label for="title">Image</label>
                  <input type="text" name="image" id="image" placeholder="image" value="">
                  <p class="text_error"></p>
              </div>

          </form>
      </div>


  </div>






<?php require_once'includes/footer.php' ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Article Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Article Management</h1>

  <?php
// Include the function to autoload classes
function chargerClass($classname) {
  require $classname . '.php';
}

spl_autoload_register("chargerClass");
// Start the session (optional, if needed)
session_start();

// Connect to the database
$con = new PDO('mysql:host=localhost;dbname=bd_ds2_binome;', 'root', '');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Check if an article was submitted and process the data
if (isset($_POST['submitArticleBtn']) && isset($_POST['titreArticle']) && isset($_POST['descArticle']) && isset($_POST['imgArticle']) && isset($_POST['contenuArticle'])) {
  $titreArticle = $_POST['titreArticle'];
  $descArticle = $_POST['descArticle'];
  $imgArticle = $_POST['imgArticle'];
  $contenuArticle = $_POST['contenuArticle'];

  // Create an Article object with the submitted data
  $article = new article();
  $article->setTitreArticle($titreArticle);
  $article->setDescArticle($descArticle);
  $article->setImgArticle($imgArticle);
  $article->setContenuArticle($contenuArticle);

  // Save the article to the database
  $saved = $article->save($con);

  if ($saved) {
    echo "<p style='color: green;'>Article saved successfully!</p>";
  } else {
    echo "<p style='color: red;'>Error saving article.</p>";
  }
}
  // Check if the form was submitted
  if (isset($_POST['deleteArticleBtn']) && isset($_POST['idArticle'])) {
    $idArticle = $_POST['idArticle'];

    // Create an Article object with the submitted ID
    $article = new Article();
    $article->setIdArticle($idArticle);

    // Delete the article from the database
    $deleted = $article->delete($con);

    if ($deleted) {
      echo "<p style='color: green;'>Article deleted successfully!</p>";
    } else {
      echo "<p style='color: red;'>Error deleting article.</p>";
    }
  }
?>
<h1>Insert article</h1>
  <form method="post" action="">
    <label for="titreArticle">Article Title:</label>
    <input type="text" id="titreArticle" name="titreArticle" required>

    <label for="descArticle">Article Description:</label>
    <textarea id="descArticle" name="descArticle" rows="5" required></textarea>

    <label for="imgArticle">Article Image URL:</label>
    <input type="file" id="imgArticle" name="imgArticle" required>

    <label for="contenuArticle">Article Content:</label>
    <textarea id="contenuArticle" name="contenuArticle" rows="10" required></textarea>

    <button type="submit" name="submitArticleBtn">Save Article</button>
  </form>
  <h1>Delete Article</h1>
  <form method="post" action="">
    <label for="idArticle">Article ID:</label>
    <input type="number" id="idArticle" name="idArticle" min="1" required>

    <button type="submit" name="deleteArticleBtn">Delete Article</button>
  </form>
</body>
</html>
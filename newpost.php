<?php 
class Article{
    private $title;
    private $desc;
    private $contenu;
    private $image;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($value)
    {
        $this->desc = $value;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($value)
    {
        $this->contenu = $value;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($value)
    {
        $this->image = $value;
    }
}

class NouvArticle{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function ajouterArticle(Article $article) {
        try {
            $q = $this->conn->prepare('INSERT INTO article (titre_article, desc_article, img_article, contenu_article, date_article) VALUES (:titre, :desc, "./images/":img, :contenu, NOW())');
            $q->bindValue(":titre", $article->getTitle());
            $q->bindValue(":desc", $article->getDesc());
            $q->bindValue(":img", $article->getImage());
            $q->bindValue(":contenu", $article->getContenu());
            $result = $q->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page avec Bootstrap</title>
    <!-- Liens vers les fichiers CSS de Bootstrap -->
    <link href="vendor\twbs\bootstrap\dist\css/bootstrap.min.css" rel="stylesheet">
    <!-- Style personnalisé pour la page -->
    <style>
        /* Ajoutez votre CSS personnalisé ici */
        .left-panel {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .right-panel {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .right-panel h2{ 
            color:red; 
        }
        .form-group{ 
            color : green;
        }
  </style>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-6 left-panel">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "bd_ds2_binome";

                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                // Configuration pour afficher les erreurs PDO
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                                // Requête SQL pour récupérer les informations de l'article
                                $sql = "SELECT * FROM article";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                            
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    // Afficher les données de l'article récupérées
                                    echo "<h3 class='d-inline-block mb-2 text-warning'>" . $row['titre_article'] . "</h3>";
                                    echo "<p class='mb-auto'>" . $row['desc_article'] . "</p>";
                                    echo "<p class='mb-auto'>" . $row['contenu_article'] . "</p>";
                                    echo "</div>
                                    <div class='col-auto d-none d-lg-block'>";
                                    echo "<img class='bd-placeholder-img' width='200' height='250' src='" . $row['img_article'] . "' alt=''>";
                                } 
                            } catch(PDOException $e) {
                                echo "Erreur: " . $e->getMessage();
                            }
                            $conn = null;
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 right-panel">
                <h2>Post New Article</h2>
                <form action="process_article.php" method="post">
                    <div class="form-group">
                        <label for="articleTitle">Title</label>
                        <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Enter the article title">
                    </div><br>
                    <div class="form-group">
                        <label for="articleDesc">Description</label>
                        <textarea class="form-control" id="articleDesc" name="articleDesc" placeholder="Enter the article description"></textarea>
                    </div><br>
                    <div class="form-group">
                        <label for="articleImage">Image</label><br>
                        <input type="file" class="form-control-file" id="articleImage" name="articleImage">
                    </div><br>
                    <div class="form-group">
                        <label for="articleContent">Article Content</label>
                        <textarea class="form-control" id="articleContent" name="articleContent" rows="5" placeholder="Enter the article content"></textarea>
                    </div><br>
                    <button type="submit" class="btn btn-danger">Share</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Liens vers les fichiers JavaScript de Bootstrap et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>


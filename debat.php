<?php
require_once("connecterbd.php");
class Comment {
    private $id;
    private $comment;
    private $author;
    private $createdAt;

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

    public function getId() {
        return $this->id;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function setComment($value) {
        $this->comment = $value;
    }

    public function setAuthor($value) {
        $this->author = $value;
    }

    public function setCreatedAt($value) {
        $this->createdAt = $value;
    }
}

class Post {
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function storeCommentInDatabase(Comment $comment) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO comments (comment, author) VALUES (:comment, :author)");
            $stmt->execute(array(
                ':comment' => $comment->getComment(),
                ':author' => $comment->getAuthor()
            ));
            echo "<script>alert 'Ajout avec succèes';</script>";
            header ('Location: debat.php');
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

$conn = new PDO('mysql:host=' . $servername . ';dbname=' . $database, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new Post($conn); 
if (isset($_POST['submit'])) {
    $donnees = array(
        'author' => $_POST["author"],
        'comment' => $_POST["comment"]
    );
    $comment = new Comment($donnees);
    $manager->storeCommentInDatabase($comment);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debat</title>
    <link rel="stylesheet" href="vendor\twbs\bootstrap\dist\css/bootstrap.min.css">
    <style>  
    /* stylepost.css */

.card {
  border-color: #eee;
}

.card-header {
  background-color: #f8f9fa;
  padding: 1rem;
}

.comment {
  margin-bottom: 1rem;
}

.comment h6 {
  font-weight: bold;
  margin-bottom: 0.5rem;
}
.card-header { 
    font-weight: bold;
    color : red; 

}

    </style>
</head>
<body>
<?php 
echo "<div class='card mt-4'>";
echo "<h5 class='card-header'>Debat</h5>";
echo "<div class='card-body'>";

$dsn = "mysql:host=localhost;dbname=bd_ds2_binome;charset=utf8";
$username = "root";
$password = "";

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = "SELECT author, comment ,date FROM comments";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='comment'>";
    echo "<h6>" . htmlspecialchars($row['author']) . "</h6>";
    echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
    echo "<p>" . htmlspecialchars($row['date']) . "</p>";
    echo "<br>";
    echo "</div>";
}

echo "</div>";
echo "</div>";
?>
    <div class="card mt-4">
        <h5 class="card-header">Add a Comment</h5>
        <div class="card-body">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="author">Your Name:</label>
                    <input type="text" class="form-control" id="author" name="author">
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
                </div>
                <button type="submit" name='submit' class="btn btn-danger">Share</button>
            </form>
        </div>
    </div>
</div>

<script src="vendor\components\jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="vendor\twbs\bootstrap\js/bootstrap.min.js"></script>
</body>
</html>
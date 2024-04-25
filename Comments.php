<?php class Comment {
    private $id_comm;
    private $id;
    private $contenu;

    public function getIdComm() {
        return $this->id_comm;
    }

    public function setIdComm($id_comm) {
        $this->id_comm = $id_comm;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }
}
class Comments {
  private $conn;

  public function __construct(PDO $conn)
  {
      $this->conn = $conn;
  }

  public function addCon(comment $comment)
{
  try {
    $stmt = $this->conn->prepare("INSERT INTO comment (contenu) VALUES (:contenu)");
    $stmt->bindParam(':contenu', $comment->getContenu());
    $stmt->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
}
}
?>
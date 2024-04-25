<?php
class signup{
  private $nom;
  private $prenom;
  private $email;
  private $password1;

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
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($value)
    {
        $this->nom = $value;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($value)
    {
        $this->prenom = $value;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }
    public function getPassword1()
    {
        return $this->password1;
    }
    public function setPassword1($value)
    {
        $this->password1 = $value;
    }
}

class signups{
  private $conn;

  public function __construct(PDO $conn)
  {
      $this->conn = $conn;
  }

  public function addUser(signup $user)
{
  try {
    $stmt = $this->conn->prepare("INSERT INTO users (email, mot_passe, nom, prenom) VALUES (:email, :password1, :nom, :prenom)");

    $stmt->bindValue(':email', $user->getEmail());
    $stmt->bindValue(':password1', $user->getPassword1());
    $stmt->bindValue(':nom', $user->getNom());
    $stmt->bindValue(':prenom', $user->getPrenom());
    $stmt->execute();
    $id = $this->conn->lastInsertId(); 
    if ($id){
        header("Location: index.php?id=$id");
        exit();
    }else{
        echo "echec";
    }
    exit();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
}
}

?>
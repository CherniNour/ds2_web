<?php
class login {
  private $username;
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
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($value)
    {
        $this->username = $value;
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

class logins {
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function addCon(login $user)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE  email=:username AND mot_passe=:password1");
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':password1', $user->getPassword1());
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userID = $row['id'];
            $userName = $row['nom'];
            $userSurname = $row['prenom'];
            $userType = $row['type']; 

            if ($userID) {
                $_SESSION['userID'] = $userID;
                $_SESSION['userName'] = $userName;
                $_SESSION['userSurname'] = $userSurname;
                if ($userType == 'ADMIN') {
                    header("Location: pageadmin.php?id=$userID");
                    exit();
                } else {
                    header("Location: index.php?id=$userID");
                    exit();
                }
            } else {
                echo "<script>alert('No user found.');</script>";
                header("Location: index.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
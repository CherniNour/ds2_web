<?php
include 'conecti.php';

class Admin {
    private $id;
    private $id
    private $password;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($k);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function create(PDO $pdo) {
        $stmt = $pdo->prepare("INSERT INTO user (nom,mail,password) VALUES ($id,$username,$password)");
        
        return $stmt->execute();
    }
    public static function getById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $admin = new Admin();
        $admin->hydrate($data);
        return $admin;
    }
    public function update(PDO $pdo) {
        $stmt = $pdo->prepare("UPDATE user SET nom = :username, password = :password WHERE id = :id");
        $stmt->bindParam(':username', $this->nom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }
    public function delete(PDO $pdo) {
        $stmt = $pdo->prepare("DELETE FROM user WHERE nom = :username");
        $stmt->bindParam(':username', $this->username);
        return $stmt->execute();
    }
}

?>
<?php
include 'connecterbd.php';

class Admin {
    private $id;
    private $nom; // Ajout de l'attribut 'nom'
    private $email;
    private $password;
    private $prenom;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNom() { // Getter pour 'nom'
        return $this->nom;
    }
    
    public function setNom($nom) { // Setter pour 'nom'
        $this->nom = $nom;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPrenom() {
        return $this->prenom;
    }
    
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

   
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function update(PDO $pdo, array $data, $id) {
        // Prepare the update query
        $stmt = $pdo->prepare("UPDATE users SET 
          nom = :nom, 
          email = :email, 
          mot_passe = :password 
        WHERE id = :id");
      
        // Bind values to parameters
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password',$data['password'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      
        // Execute the update query
        $result = $stmt->execute();
      
        // Return the update result
        return $result;
      }
    function create($con, $email, $nom, $prenom, $password) {
        $stmt = $con->prepare("INSERT INTO users (email, nom, prenom, mot_passe) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $nom, PDO::PARAM_STR);
        $stmt->bindParam(3, $prenom, PDO::PARAM_STR);
        $stmt->bindParam(4, $password,PDO::PARAM_STR);// Hash password before storing
        return $stmt->execute();
      }
      
    public function delete(PDO $pdo) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
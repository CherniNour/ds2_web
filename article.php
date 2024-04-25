<?php

class Article {
  private $idArticle;
  private $titreArticle;
  private $descArticle;
  private $imgArticle;
  private $contenuArticle;
  private $dateArticle;

  public function getIdArticle() {
    return $this->idArticle;
  }

  public function setIdArticle($idArticle) {
    $this->idArticle = $idArticle;
  }

  public function getTitreArticle() {
    return $this->titreArticle;
  }

  public function setTitreArticle($titreArticle) {
    $this->titreArticle = $titreArticle;
  }

  public function getDescArticle() {
    return $this->descArticle;
  }

  public function setDescArticle($descArticle) {
    $this->descArticle = $descArticle;
  }

  public function getImgArticle() {
    return $this->imgArticle;
  }

  public function setImgArticle($imgArticle) {
    $this->imgArticle = $imgArticle;
  }

  public function getContenuArticle() {
    return $this->contenuArticle;
  }

  public function setContenuArticle($contenuArticle) {
    $this->contenuArticle = $contenuArticle;
  }

  public function getDateArticle() {
    return $this->dateArticle;
  }

  public function setDateArticle($dateArticle) {
    $this->dateArticle = $dateArticle;
  }

  public function save(PDO $pdo) {
    // Use prepared statement to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO article (titre_article, desc_article, img_article, contenu_article, date_article) VALUES (?, ?, ?, ?,  NOW())");
    $stmt->bindParam(1, $this->titreArticle, PDO::PARAM_STR);
    $stmt->bindParam(2, $this->descArticle, PDO::PARAM_STR);
    $stmt->bindParam(3, $this->imgArticle, PDO::PARAM_STR);
    $stmt->bindParam(4, $this->contenuArticle, PDO::PARAM_STR);
    // Bind current date and time using PDO::PARAM_STR

    return $stmt->execute();
  }
  public function delete(PDO $pdo) {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id_article = :id");
    $stmt->bindParam(':id', $this->idArticle, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
?>
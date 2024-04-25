<?php
function chargerClass($classname)
{
  require $classname.'.php';
}
spl_autoload_register("chargerClass");
session_start();
$con = new PDO('mysql:host=localhost;dbname=bd_ds2_binome;', 'root', '');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if ($con === false) {
  die('ERROR: Could not connect. ' . $con->connect_error);
}
$manager = new signups($con); 
if (isset($_POST['submit'])) {
  $donnees = array(
      'nom'=>$_POST["nom"],
      'prenom'=>$_POST["prenom"],
      'email'=>$_POST["email"],
      'password1'=>$_POST["password1"]
    );
      
      $user = new signup($donnees);
      $manager->addUser($user);
  }
?>
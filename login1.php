<?php
function chargerClass($classname)
{
  require $classname.'.php';
}
spl_autoload_register("chargerClass");
session_start();
$con = new PDO('mysql:host=localhost;dbname=bd_ds2_binome;', 'root', '');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$manager = new logins($con); 
if (isset($_POST['submit'])) {
  $donnees = array(
      'username'=>$_POST["username"],
      'password1'=>$_POST["password1"]
    );

      $user = new login($donnees);
      $result = $manager->addCon($user);
  }

?>
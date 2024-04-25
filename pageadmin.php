<?php
function chargerClass($classname) {
    require $classname . '.php';
}

spl_autoload_register("chargerClass");
session_start();
$con = new PDO('mysql:host=localhost;dbname=bd_ds2_binome;', 'root', '');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$adminManager = new Admin($con);
$admin = new Admin($con);
if (isset($_POST['createAdminBtn']) && !empty($_POST['createEmail']) && !empty($_POST['createPassword']) && !empty($_POST['createFirstName']) && !empty($_POST['createLastName'])) {
  $email = $_POST['createEmail'];
  $nom = $_POST['createLastName'];
  $prenom = $_POST['createFirstName'];
  $password = $_POST['createPassword'];

  $created = $admin->create($con, $email, $nom, $prenom, $password);
  if ($created) {
    echo "Admin user created successfully!";
  } else {
    echo "An error occurred while creating the admin user.";
  }
}
$updatedAdmin= new admin();
// Traitement de la modification d'un administrateur
if (isset($_POST['updateAdminBtn']) && isset($_POST['updateAdminId']) && isset($_POST['updateEmail']) && isset($_POST['updatePassword'])) {
    $id = intval($_POST['updateAdminId']); // Cast to integer for security
    $email = filter_var($_POST['updateEmail'], FILTER_SANITIZE_EMAIL); // Sanitize email
    $password = $_POST['updatePassword'];
  
    // Prepare data for update function
    $data = [
      'nom' => '', // Assuming you want to update 'nom' as well (set a default value)
      'email' => $email,
      'password' => $password,
    ];
  
    // Update the admin in the database
    $result = $updatedAdmin->update($con, $data, $id);
  
    if ($result) {
      echo "<p style='color: green;'>Admin updated successfully!</p>";
    } else {
      echo "<p style='color: red;'>Error updating admin.</p>";
      // Optional: Log detailed error message for debugging
      error_log("Error updating admin: " . $updatedAdmin->getError()); // Assuming 'getError' exists in Admin class
    }
  }
// Traitement de la suppression d'un administrateur
if (isset($_POST['deleteAdminBtn'])) {
    // Récupération de l'identifiant de l'administrateur à supprimer
    $id = $_POST['deleteAdminId'];

    // Création d'un objet Admin avec l'identifiant
    $deletedAdmin = new Admin();
    $deletedAdmin->setId($id);

    // Appel de la méthode delete pour supprimer l'administrateur
    $result = $deletedAdmin->delete($con);

    if ($result) {
        echo "Admin deleted successfully!";
    } else {
        echo "Error deleting admin.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>User Management</h1>

   <!-- Formulaire pour créer un nouvel administrateur -->
   <form action="pageadmin.php" method="POST">
    <h2>Create User</h2>
    <label for="createEmail">Email:</label>
    <input type="email" id="createEmail" name="createEmail" >
    <label for="createPassword">Password:</label>
    <input type="password" id="createPassword" name="createPassword" >
    <label>First Name:</label>
    <input type="text" id="createFirstName" name="createFirstName" >
    <label for="createLastName">Last Name:</label>
    <input type="text" id="createLastName" name="createLastName" >
    <button type="submit" name="createAdminBtn">Create user</button>
</form>

    <!-- Formulaire pour mettre à jour un administrateur -->
    <form method="post" action="pageadmin.php">
    <label for="updateAdminId">Admin ID:</label>
    <input type="number" id="updateAdminId" name="updateAdminId" required>

    <label for="updateEmail">Email:</label>
    <input type="email" id="updateEmail" name="updateEmail" required>

    <label for="updatePassword">Password:</label>
    <input type="password" id="updatePassword" name="updatePassword" required>

    <button type="submit" name="updateAdminBtn">Update user</button>
  </form>

    <!-- Formulaire pour supprimer un administrateur -->
    <form action="" method="POST">
        <h2>Delete Admin</h2>
        <label for="deleteAdminId">Admin ID:</label>
        <input type="number" id="deleteAdminId" name="deleteAdminId" required>
        <button type="submit" name="deleteAdminBtn">Delete user</button>
    </form>
    <form>
    <button onclick="window.location.href='articlemanagement.php'">Manage Articles</button>
    </form>
</body>
</html>
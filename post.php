<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    // If user is not logged in, redirect to login page or handle appropriately
    header("Location: login.php"); 
    exit(); // Stop further execution of the script
}

// Fetch user's first name and last name from session
$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : '';
$userSurname = isset($_SESSION['userSurname']) ? $_SESSION['userSurname'] : '';

function chargerClass($classname)
{
  require $classname.'.php';
}
spl_autoload_register("chargerClass");
$con = new PDO('mysql:host=localhost;dbname=bd_ds2_binome;', 'root', '');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if ($con === false) {
  die('ERROR: Could not connect. ' . $con->connect_error);
}
$manager = new Comments($con); 
if (isset($_POST['submit'])) {
  $donnees = array(
      'contenu'=>$_POST["contenu"]
    );
      
  $comment = new Comment();
  $comment->setContenu($_POST["contenu"]);
  $manager->addComment($comment);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>JavaScript Comment Board</title>
    <link rel="stylesheet" href="vendor\twbs\bootstrap\dist\css/bootstrap.min.css">
    <style>
        body {
            background-color: white;
            color: black;
        }

        .card {
            background-color: white;
            border: 1px solid black;
            border-radius: 10px;
        }

        .card-header {
            background-color: red;
            color: white;
        }

        .card-body {
            background-color: white;
            color: black;
        }

        .btn-primary {
            background-color: green;
            border: 1px solid green;
        }

        .btn-primary:hover {
            background-color: white;
            color: green;
        }

        .btn-danger {
            background-color: red;
            border: 1px solid red;
        }

        .btn-danger:hover {
            background-color: white;
            color: red;
        }

        #Errorcomment {
            color: red;
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="pb-2 mt-4 mb-2 border-bottom">
            <h1>My Fake Blog</h1>
        </div>

        <div class="row col-md-8 col-md-offset-2">

            <h2>Post About Thing</h2>
            <div class="card w-100" style="margin-bottom: 20px;">
                <h3 class="card-header">Add a comment</h3>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <p id="Errorcomment">Comment is empty.</p>
                            <input type="text" id="firstName" class="form-control" placeholder="First Name"
                                value="<?php echo $userName; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" id="lastName" class="form-control" placeholder="Last Name"
                                value="<?php echo $userSurname; ?>" readonly>
                        </div>
                        <form action="post">
                            <div class="form-group">
                                <textarea id="comment" rows="4" cols="60" name="comment" class="form-control"
                                    placeholder="Comment"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="postbtn">Post</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
            <div id="comments" class="card w-100" style="border: none;">
            </div>

        </div>

        <script src="http://code.jquery.com/jquery.min.js"></script>
        <script src="postcomment.js"></script>
        <script>
            $(document).ready(function () {
                $("#postbtn").click(function () {
                    var firstName = $("#firstName").val();
                    var lastName = $("#lastName").val();
                    var comment = $("#comment").val();

                    if (comment !== "") {
                        var newComment = '<div class="card w-100" style="margin-bottom: 10px;"><div class="card-header"><div class="row"><div class="col-sm-11"><h4>' + firstName + ' ' + lastName + '</h4></div><div class="col-sm-1"><button class="delete_btn" class="btn">X</button></div></div></div><div class="card-body"><p>' + comment + '</p></div></div>';

                        $("#comments").prepend(newComment);

                        // Clear input fields after posting comment
                        $("#comment").val("");
                    } else {
                        // Display error message if the comment field is empty
                        $("#Errorcomment").show();
                    }
                });
            });
        </script>
</body>

</html>

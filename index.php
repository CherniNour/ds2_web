<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);
   $con = new PDO('mysql:host=localhost;dbname=bd_ds2_binome;', 'root', '');
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
   if ($con === false) {
     die('ERROR: Could not connect. ' . $con->connect_error);
   }

   if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $stmt = $con->prepare("SELECT nom, prenom FROM users WHERE id=:id");
    $stmt->bindValue(':id', $userID);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $userName = $row['nom'];
        $userSurname = $row['prenom'];

        $_SESSION['userID'] = $userID;
        $_SESSION['userName'] = $userName;
        $_SESSION['userSurname'] = $userSurname;
    } else {
        echo "Aucun utilisateur trouvé avec l'ID fourni.";
    }
} 
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: index.php");
  exit;
}
if (isset($_POST['newpost'])) {
    header("Location: newpost.php");
    exit;
  }
  if (isset($_POST['joinchat'])) {
    header("Location: debat.php");
    exit;
  }
// Déterminer si afficher ou non les boutons de connexion / inscription
$showLogoutButton = isset($_SESSION['userID']);
$showNewpostButton = isset($_SESSION['userID']);
$showJoinchatButton = isset($_SESSION['userID']);
$hideButtons = isset($_SESSION['userID']);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor\twbs\bootstrap\dist\css/bootstrap.min.css">

    <title>eye.on.palestine</title>
    <link rel="icon" href="C:\wamp64\www\ds2\logo.png" type="image/png">
    <link rel="stylesheet" href="vendor\twbs\bootstrap\dist\css/bootstrap.min.css">
  <style>
    .video-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }
    .video-bg {
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0.3; 
    }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <img src="./images/logo.png" width="150px" height="80px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Topic
                    </a>
                    <form method="post" action="post1.php">
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Geography and Culture</a>
                        <a class="dropdown-item" href="#">Conflict and Occupation</a>
                        <a class="dropdown-item" href="#">Boycotting </a>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" name="submit" >Report </button>
                    </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.instagram.com/eye.on.palestine/">Contact Us</a>
                </li>
            </ul>
            <?php if (isset($userName)) : ?>
                <div class="mx-2">
                <button type="button" class="btn btn-light">
                     <strong> Welcome, <?php echo $userName; ?> <?php echo $userSurname; ?> ! </strong></button>
            </div>
<?php endif; ?>
            <form class="form-inline my-2 my-lg-0">
        <?php if ($showLogoutButton) : ?>
            <form method="post">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        <?php endif; ?>
        <?php if ($showNewpostButton) : ?>
            <form method="post">
            <div class="mx-2">
                <button type="submit" name="newpost" class="btn btn-dark">New Post</button>
            </div>
            </form>
        <?php endif; ?>
        <?php if ($showJoinchatButton) : ?>
            <form method="post">
            <div class="mx-2">
                <button type="submit" name="joinchat" class="btn btn-dark">Join Chat for Debat</button>
        </div>
            </form>
        <?php endif; ?>
    </div>
            </form>
            <div class="mx-2">
            <?php if (!$hideButtons) : ?>
                    <button class="btn btn-dark" data-toggle="modal" data-target="#loginModal">Login</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#signupModal">SignUp</button>
                <?php endif; ?>
          </div>
      </div>
  </nav>
  
  <div class="video-container">
    <video class="video-bg" src="./images/flag.mp4" muted autoplay loop></video>
  </div>
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login to eye.on.palestine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="login1.php">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password1" class="form-control" id="exampleInputPassword1" required>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

<!-- Sign Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Get an eye.on.palestine Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="signup1.php">
          <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Lastname</label>
                <input type="text " name="prenom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password1" class="form-control" id="exampleInputPassword1" required>
              </div>
              <div class="form-group">
                <label for="cexampleInputPassword1">Confirm Password</label>
                <input type="password" name="password2" class="form-control" id="cexampleInputPassword1">
              </div>
               
              <button name="submit" type="submit" class="btn btn-primary">Creat Account</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
<div class="container my-4">
      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative float-left">
            <div class="col p-4 d-flex flex-column position-static">
              <h3 class="d-inline-block mb-2 text-primary">History of Palestine</h3>
              <p class="card-text mb-auto">Embarking on a journey through time, let's unveil the rich tapestry of Palestine's storied past and explore Palestine's timeless tale...</p>
              <a href="#" class="stretched-link continue-reading" data-toggle="modal" data-target="#articleModal1" style="color: black; font-weight: bold;">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img class="bd-placeholder-img" width="200" height="250" src="./images/history.jpg" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="articleModal1" tabindex="-1" role="dialog" aria-labelledby="articleModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">History of Palestine</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center"> 
        <p>Here is the full content of the article "History of Palestine".</p>
        <img class="bd-placeholder-img img-fluid mx-auto d-block" width="200" height="250" src="./images/history.jpg" alt="History of Palestine Image">
              <p> Palestine, officially known as the State of Palestine (in Arabic: دولة فلسطين, Dawlat Filasṭīn), 
                is a country located in the Levant region of Western Asia. It is officially recognized as
                a state by the United Nations and many countries. <br>
                Palestine shares borders Jordan to the east, and Egypt to the southwest. The state includes the West Bank, including East Jerusalem, and the Gaza
                Strip. The population of Palestine exceeds five million people, covering an area of 6,020 square
                kilometers. <br>
                Jerusalem is its proclaimed capital, and Arabic is the official language. The majority 
                of Palestinians practice Islam, while Christianity is also present. Gaza is the largest city, and Jerusalem 
                is the proclaimed capital, with Ramallah serving as the current temporary administrative center. 
                The Palestine region has played a significant role in world history. Canaanites, Israelites, Assyrians, 
                Babylonians, Persians, Greeks, Romans, and Byzantines have all left their mark on this land. In addition to its historical significance, Palestine holds deep religious importance for Judaism, Christianity, and Islam. Sacred sites such as the Western Wall, the Church of the Holy Sepulchre, and the Al-Aqsa Mosque attract countless pilgrims and visitors each year. If you’d like more information or have any specific questions, feel free to ask!</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative float-left">
            <div class="col p-4 d-flex flex-column position-static">
              <h3 class="d-inline-block mb-2 text-success">Geography and Culture</h3>
              <p class="mb-auto">Journey with us as we traverse the vibrant landscapes and delve into the rich tapestry of Palestinian culture, 
                from the ancient cities to the rhythmic beats of tradition echoing through time...</p>
              <a href="#" class="stretched-link continue-reading" data-toggle="modal" data-target="#articleModal2" style="color: black; font-weight: bold;">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img class="bd-placeholder-img" width="200" height="250" src="./images/image3.jpeg" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="articleModal2" tabindex="-1" role="dialog" aria-labelledby="articleModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Geography and Culture</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <p>Here is the full content of the article "Geography and Culture".</p>
              <img class="bd-placeholder-img img-fluid mx-auto d-block" width="200" height="250" src="./images/culture.png" alt="Geography">
              <p>The State of Palestine is located in Western Asia. It comprises the territories of the West Bank and
                 the Gaza Strip. <br> Geographically, Palestine straddles both the Northern and Eastern hemispheres of the Earth</p>
                <p> <strong> 5 things you need to know about Palestinian culture  </strong></p>
                <video width="100%" height="auto" controls>
                <source src="./images/culture.mp4" type="video/mp4">
                 </video>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative float-right">
            <div class="col p-4 d-flex flex-column position-static">
              <h3 class="d-inline-block mb-2 text-danger">Boycotting</h3>
              <p class="card-text mb-auto">Unleash the power of purpose! Let's make a statement with our choices. Join the movement for mindful consumption. #BoycottToEmpower 💪✨</p>
              <a href="#" class="stretched-link continue-reading" data-toggle="modal" data-target="#articleModal3" style="color: black; font-weight: bold;">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img class="bd-placeholder-img" width="200" height="250" src="./images/boycotting.jpeg" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="articleModal3" tabindex="-1" role="dialog" aria-labelledby="articleModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="articleModal3Label">Boycotting</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <p>Here is the full content of the article "Boycotting".</p>
              <img class="bd-placeholder-img" width="200" height="250" src="./images/boycott.jpg" alt="">
              <p> Boycotting is a form of protest where individuals refuse to buy, use, or support something they disagree with. In the context of the Israeli-Palestinian conflict, the Boycott, Divestment, and Sanctions (BDS) campaign, launched in 2005, aims to put pressure on Israel and its supporters by targeting brands and companies allegedly linked to Israel
                <strong>—! By boycotting companies seen as supporting Israeli policies, we can voice our disapproval and push for change.--! </strong><br>
                Staying informed about the boycott movement is crucial. Resources are available to help identify products to avoid and participate in activism that promotes Palestinian rights. <strong>Join the movement and make your voice heard!</strong>
                <strong> Empower yourself! Resources are available to help you navigate the boycott movement.</strong> Learn about companies to avoid, engage in activism, and be part of the change.<strong> Every voice counts.</strong>
                Join the BDS movement today. Together, we can create a future built on equality and human rights.</p>
                <a  href="https://bdsmovement.net/"> visit thi site for more detailed informations</a>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="row mb-2">
      <div class="col-md-6">
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative float-right">
          <div class="col p-4 d-flex flex-column position-static">
            <h3 class="d-inline-block mb-2 text-warning">7 October 2023</h3>
            <p class="mb-auto">7 October 2023 has put the world at a new historical turning point.</p>
            <a href="#" class="stretched-link continue-reading" data-toggle="modal" data-target="#articleModal4" style="color: black; font-weight: bold;">Continue reading</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img class="bd-placeholder-img" width="200" height="250" src="./images/7oct.jpeg" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Modal pour afficher le contenu de l'article "7 October 2023" -->
    <div class="modal fade" id="articleModal4" tabindex="-1" role="dialog" aria-labelledby="articleModal4Label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="articleModal4Label">7 October 2023</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <p>Here is the full content of the article "7 October 2023".</p>
            <img class="bd-placeholder-img" width="200" height="250" src="./images/thumb2.jpeg" alt="">

            <p>In the early morning hours of Saturday,<strong> October 7 </strong>, Palestinians across the West Bank woke 
            up to the sound of explosions. No one really knew what was happening until reports started trickling in that fighters
             from Gaza had taken control of Beit Hanoun crossing – the only one through which Gaza residents may reach the rest of
              historic Palestine on the extremely rare occasions the occupier allows them to.Soon information appeared on social media that
               the wall that Israel had erected around the Gaza Strip to keep its 2.3 million people permanently imprisoned had been breached.
                And then came the images and footage of the broken wall. In one video, showing a bulldozer bringing down the wall, a Palestinian man can be heard chanting in exhilaration: “Yes, go! Allahu Akbar [God is the Greatest]! Hit it, guys! Rest in peace, wall!” It was unbelievable. It felt surreal. We wondered how it was possible that the people of Gaza had broken out of their prison. Few in the world would understand our feelings in that moment. Perhaps political prisoners might.The vast majority of the Palestinian population remaining in historic Palestine has been born in prison and only knows prison. Gaza is completely sealed off from the rest of the world by Israel’s apartheid wall and subjected to a debilitating siege, in which its neighbour Egypt happily partakes. In the occupied West Bank, all entry and exit points of every Palestinian village, town, and city are controlled by the Israeli occupation forces; Palestinians – unlike the Israeli settlers stealing their land – have no freedom of movement.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</div>
  </div>

  <script>
    function checkLogin(action) {
      // Check if the user is logged in (you can implement your own logic here)
      var isLoggedIn = false; // Assume user is not logged in for demonstration

      if (!isLoggedIn) {
        // If user is not logged in, display an error message
        alert('You must be logged in to ' + action);
      } else {
        // If user is logged in, perform the action
        if (action === 'New Post') {
          // Redirect to the new post page or perform any other action
          // window.location.href = 'new_post.html';
        } else if (action === 'Join Chat') {
          // Redirect to the chat page or perform any other action
          // window.location.href = 'chat.html';
        }
      }
    }
  </script>
    <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>© 2023-2024 <a href="#">Privacy</a> · <a href="#">Terms</a></p>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
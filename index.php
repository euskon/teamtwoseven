<?php
  include("config.php");
  include("data.php");
  $page = $_GET["page"];
  session_start();
  $loggedIn = false;
  $username = $_SESSION['username'];
  $sql = "SELECT userID, name FROM Users WHERE name = '$username'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $loggedIn = true;
  }

  // Check if the login form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT userID FROM Users WHERE name = '$username' and password = '$password'";
    $result = $db->query($sql);
    $valid = $result->num_rows;

    if($valid == 1) {
      $_SESSION['username'] = $username;
      $loggedIn = true;
    } else {
      echo "Invalid login!";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="#" />
    <meta charset="UTF-8">
    <title>Team Two Seven</title>
    <style>
      /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
      .row.content {height: 900px}
      /* Set gray background color and 100% height */
      .sidenav {
        background-color: #f1f1f1;
        height: 100%;
      }
      /* Set black background color, white text and some padding */
      footer {
        background-color: #555;
        color: white;
        padding: 15px;
      }
      /* On small screens, set height to 'auto' for sidenav and grid */
      @media screen and (max-width: 767px) {
        .sidenav {
          height: auto;
          padding: 15px;
        }
        .row.content {height: auto;} 
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row content">
        <div class="col-sm-2 sidenav">
          <hr>
          <?php include('navbar.php');?>
          <hr>
        </div>
        <!-- Start content items. Listed by date. -->
        <div class="col-sm-10">
          <hr>
          <h2>Project Logger</h2>
          <hr>
        </div>
        <div class="col-sm-10">
          <!-- Show login page -->
          <?php
            if (!$loggedIn && $page != 'createUser') {
              include('login.php');
              die();
            } else {
              // User the page variable to set the body of the page.
              switch ($page) {
                case 'createUser':
                  require 'createUser.php';
                  break;
                case 'logout':
                  require 'logout.php';
                  break;
              }
            }
          ?>
          <!-- End Show login page -->
          <hr>
        </div>
        <!-- End content items. Listed by date. --!>
      </div>
    </div>
    <footer class="container-fluid">
      <p>Site layout by <a href="https://www.w3schools.com/bootstrap/">w3 Schools</a></p>
    </footer>
  </body>
</html>

<?php
  $db->close();
?>

<?php
  error_reporting(E_ALL);
  $debugShow = false;
  $debug = array();
  session_start();
  require "config.php";
  require "data.php";
  require "functions.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // a form was submitted...
    $debug['CheckPost'] = "called";
    checkPost();
  }

  list($loggedIn, $userID, $username, $teamID, $teamname) = checkLogin();

  $page = getPagination();

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
      .row.content {height: 900px}
      .sidenav {
        background-color: #f1f1f1;
        height: 100%;
      }
      footer {
        background-color: #555;
        color: white;
        padding: 15px;
      }
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
          <?php require 'navbar.php';?>
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
            if (!$loggedIn && $page != "createUser") {
              require 'login.php';
            } else {
              switch ($page) {
                case 'createUser':
                  require 'createUser.php';
                  break;
                case 'createLogs':
                  require 'createLogs.php';
                  break;
                case 'showLogs':
                  require 'showLogs.php';
                  break;
                case 'editLog':
                  require 'editLog.php';
                  break;
                case 'deleteLog':
                  require 'deleteLog.php';
                  break;
                case 'demo':
                  require 'demo.php';
                  break;
                case 'logout':
                  require 'logout.php';
                  break;
                default:
                  echo "Welcome $username! You are on team $teamname.";
                  break;
              }
            }
          ?>
          <!-- End Show login page -->
        </div>
        <!-- End content items. Listed by date. --!>
      </div>
    </div>
    <footer class="container-fluid">
      <?php //Debug
        if ($debugShow) {
          print_r($debug);
        }
      ?>
      <p>Site layout by <a href="https://www.w3schools.com/bootstrap/">w3 Schools</a></p>
    </footer>
  </body>
</html>

<?php
  $db->close();
?>

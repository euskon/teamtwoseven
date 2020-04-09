<?php
  include("config.php");
  include("data.php");
  session_start();
  $loggedIn = false;
  //print_r($_SESSION);
  //
  // Check if already logged in.
  $username = $_SESSION['username'];
  //echo "Session user: " . $user_check . "<br>";
  $sql = "SELECT userID, name FROM Users WHERE name = '$username'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $loggedIn = true;
  }

  // Check if the login form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    //echo "Username: " . $_POST['username'] . "<br>";
    //echo "Password: " . $_POST['password'] . "<br>";

    $sql = "SELECT userID FROM Users WHERE name = '$username' and password = '$password'";
    //echo "Query: ". $sql . "<br>";
    $result = $db->query($sql);
    $valid = $result->num_rows;
    //echo "Returned: ". $valid . " rows.<br>";

    if($valid == 1) {
      $_SESSION['username'] = $username;
      $loggedIn = true;
      //echo "Session name: " . $_SESSION['login_user'] . "<br>";
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
  if (!$loggedIn) {
    include('login.php');
    die();
  } else {
    echo "Welcome " . $username . "!";
    //include('body.php');
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

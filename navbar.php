<!-- Begin Navigation Bar-->

<!-- SELECT Team name user is on. or show Project Logger -->
<?php
  if ($loggedIn) {
    //TODO:Jon Get Team name
    echo '<h4><span class="glyphicon glyphicon-pencil"></span> Team</h4>';
  } else {
    echo '<h4><span class="glyphicon glyphicon-pencil"></span> Welcome</h4>';
  }
?>
<!-- SELECT Team name user is on. or show Project Logger -->

<!-- Show home button -->
<ul class="nav nav-pills nav-stacked">
<li <?php if (!$page) { echo 'class="active"'; } ?>>
  <a href="./index.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
<!-- End Show home button -->

<!-- Start 'logged in menu items' -->
<?php if ($loggedIn) { ?>
  <!-- Show projects the user is assigned to -->
  <!-- We should while loop through db query to show all projects -->
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Projects
        <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <!-- If logged in. SELECT * FROM Projects WHERE Project = myTeam -->
        <?php
          $teamID = $_SESSION['teamID'];
          $queryProjects = "SELECT Projects.projectID, Projects.name FROM Projects, OwnedBy
                            WHERE Projects.projectID = OwnedBy.projectID
                            AND OwnedBy.teamID = '$teamID'";
          $result = $db->query($queryProjects);
          while ($row = $result->fetch_row()) {
            echo "<li><a href='./index.php?page=showLogs&project=$row[0]'>$row[1]</a></li>";
          }
        ?>
        <!-- End If logged in. SELECT * FROM Projects WHERE Project = myTeam -->
      </ul>
    </li>
  <!-- End Show projects the user is assigned to -->

  <!-- Show Create Log? -->
  <li <?php if ($page == 'createLogs') { echo 'class="active"'; } ?>>
    <a href="./index.php?page=createLogs">Create Log</a></li>
  <!-- End Show Create Log? -->

  <!-- Show logout button if logged in -->
  <li <?php if ($page == 'logout') { echo 'class="active"'; } ?>>
    <a href="./index.php?page=logout">Logout</a></li>
  <!-- End Show logout button if logged in -->
<?php } ?>
<!-- End Start 'logged in menu items' -->

<!-- Show demo button -->
<li <?php if ($page == 'demo') { echo 'class="active"'; } ?>>
  <a href="./index.php?page=demo">Demo All Data</a></li>
<!-- End Show demo button -->

</ul><br>
<!-- End Navigation Bar-->

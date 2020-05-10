<!-- Begin Navigation Bar-->

<!-- SELECT Team name user is on. or show Project Logger -->
<?php
  if ($loggedIn) {
    // Get Team name
    echo '<h4><span class="glyphicon glyphicon-pencil"></span> Team</h4>';
  } else {
    echo '<h4><span class="glyphicon glyphicon-pencil"></span> Welcome</h4>';
  }
?>
<!-- SELECT Team name user is on. or show Project Logger -->

<!-- Show home button -->
<ul class="nav nav-pills nav-stacked">
<li <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'class="active"'; } ?>>
  <a href="index.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
<!-- End Show home button -->

<!-- Show projects the user is assigned to -->
<!-- We should while loop through db query to show all projects -->
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Projects
      <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <!-- If logged in. SELECT * FROM Projects WHERE TEAM = myTeam -->
      <li><a href="./">Empty</a></li>
      <!-- End If logged in. SELECT * FROM Projects WHERE TEAM = myTeam -->
    </ul>
  </li>
<!-- End Show projects the user is assigned to -->

<!-- Show team members? -->
<li <?php if ($page == 'teamMembers') { echo 'class="active"'; } ?>>
  <a href="./">Team Members</a></li>
<!-- End Show team members? -->

<!-- Show logout button if logged in -->
<?php if ($loggedIn) { ?>
<li <?php if ($page == 'logout') { echo 'class="active"'; } ?>>
  <a href="index.php?page=logout">Logout</a></li>
<?php } ?>
<!-- End Show logout button if logged in -->

<!-- Show demo button -->
<li <?php if (basename($_SERVER['PHP_SELF']) == 'demo.php') { echo 'class="active"'; } ?>>
  <a href="demo.php">Demo</a></li>
<!-- End Show demo button -->

</ul><br>
<!-- End Navigation Bar-->

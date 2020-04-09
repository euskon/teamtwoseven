<!-- Begin Navigation Bar-->

<!-- SELECT Team name user is on. or show Project Logger -->
<h4><span class="glyphicon glyphicon-pencil"></span> Team Two-Seven</h4>


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
      <li><a href="./">Logger</a></li>
      <li><a href="./">LaserPI</a></li>
      <li><a href="./">Rolling Dice: For Dummies</a></li>
    </ul>
  </li>
<!-- End Show projects the user is assigned to -->

<!-- Show team members? -->
<li <?php if (basename($_SERVER['PHP_SELF']) == 'permissions.php') { echo 'class="active"'; } ?>>
  <a href="./">Team Members</a></li>
<!-- End Show team members? -->

<!-- Show logout button if logged in -->
<?php if ($loggedIn) { ?>
<li <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php') { echo 'class="active"'; } ?>>
  <a href="logout.php">Logout</a></li>
<?php } ?>
<!-- End Show logout button if logged in -->

</ul><br>
<!-- End Navigation Bar-->

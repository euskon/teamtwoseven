<?php
  if ($invalidLogin) {
    //TODO:Jon Bigger and red?
    echo "Invalid login...";
  } else if ($createdLogin) {
    echo "Login created... login below...";
  }
?>
<div class = "row">
  <div class = "col-sm-4">
    <form id = "login" action = "" method = "post">
    <div class = "form-group">
      <label for = "username">Username  :</label>
      <input type = "text" 
             name = "username"
             id = "username"
             placeholder = "Enter Username" 
             class = "form-control"/>
    </div>
    <div class = "form-group">
      <label for = "password">Password  :</label>
      <input type = "password" 
             name = "password"
             id = "password"
             placeholder = "Enter password" 
             class = "form-control"/>
    </div>
      <input name = "submit" type = "submit" class = "btn btn-primary">
      or <a href="index.php?page=createUser">Create User</a>
    </form>
  </div>
</div>

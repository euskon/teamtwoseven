<div class="col-sm-10">
    <h3>Create New User</h3>
</div>
<div class = "row">
  <div class = "col-sm-4">
    <form id = "login" action = "index.php" method = "post">
    <div class = "form-group">
      <label for = "username">Username  :</label>
      <input type = "text" 
             name = "username"
             id = "username"
             placeholder = "Enter Username" 
             class = "form-control"/>
    </div>
    <div class = "form-group">
      <label for = "email">email  :</label>
      <input type = "text" 
             name = "email"
             id = "email"
             placeholder = "Enter email" 
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
    <div class = "form-group">
      <label for = "verifypassword">Verify Password  :</label>
      <input type = "password" 
             name = "verifypassword"
             id = "verifypassword"
             placeholder = "Verify password" 
             class = "form-control"/>
    </div>
    <!-- TODO:Jon Create dropdown of all teams. -->
    <?php
      $queryTeams = "SELECT teamID, name FROM Teams";
    ?>
    <div class = "form-group">
      <label for = "teamname">Select Team :</label>
      <select class="form-control" id="teamname" name="teamname">
      <?php 
        $result = $db->query($queryTeams);
        while ($row = $result->fetch_row()) {
          printf ("<option value='%s'>%s. %s</option>", $row[0], $row[0], $row[1]);
        }
      ?>
      </select>
    </div>

    <div class = "form-group">
      <label for = "teamnew">Or Create New Team :</label>
      <input type = "teamnew" 
             name = "teamnew"
             id = "teamnew"
             placeholder = "Create new team ..." 
             class = "form-control"/>
    </div>
    <!-- END TODO:Jon Create dropdown of all teams. -->
      <input name = "submit" type = "submit" class = "btn btn-primary">
    </form>
  </div>
</div>

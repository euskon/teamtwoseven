<div class="col-sm-10">
  <p>You are logged in as <?php echo $username; ?>.</p>
  <hr>
</div>
<div class = "row">
  <div class = "col-sm-8">
    <form id = "createLog" action = "index.php" method = "post">
    <?php
      $queryProjects = "SELECT Projects.projectID, Projects.name FROM Projects";
    ?>
    <div class = "form-group">
      <label for = "projectID">Select Project :</label>
      <select class="form-control" id="projectID" name="projectID">
        <?php 
          $result = $db->query($queryProjects);
          while ($row = $result->fetch_row()) {
            printf ("<option value='%s'>%s. %s</option>", $row[0], $row[0], $row[1]);
          }
        ?>
      </select>
    </div>
    <div class = "form-group">
      <label for = "newprojectname">or Create New Project:</label>
      <input type = "text" 
             name = "newprojectname"
             id = "newprojectname"
             placeholder = "Project to enter log for..." 
             class = "form-control"/>
    </div>
    <div class = "form-group">
      <label for = "location">Location :</label>
      <input type = "text" 
             name = "location"
             id = "location"
             placeholder = "Location..." 
             class = "form-control"/>
    </div>
    <div class="form-group">
      <label for="newlog">Enter log :</label>
      <textarea class="form-control" rows="5" 
                name = "newlog"
                placeholder = "Enter new log data ..."
                id="newlog"></textarea>
    </div>
      <input name = "submit" type = "submit" class = "btn btn-primary">
    </form>
  </div>
</div>

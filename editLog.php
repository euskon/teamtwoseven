<?php

$logID = $_GET['logid'];

$getLog = "SELECT Logs.logID, Logs.location, Logs.logNotes
           FROM Logs
           WHERE Logs.logID = '$logID'";

$result = $db->query($getLog);
$row = $result->fetch_row();

?>
<div class = "row">
  <div class = "col-sm-8">
    <form id = "createLog" action = "index.php" method = "post">

    <input type="hidden" name="edit" id="edit" value="<?php echo $logID; ?>"/>

    <div class = "form-group">
      <label for = "editLocation">Location :</label>
      <input type = "text" 
             name = "editLocation"
             id = "editLocation"
             value = "<?php echo $row[1]; ?>" 
             class = "form-control"/>
    </div>
    <div class="form-group">
      <label for="editLog">Enter log :</label>
      <textarea class="form-control" rows="5" 
                name = "editLog"
                id = "editLog"><?php echo $row[2]; ?></textarea>
    </div>
      <input name = "submit" type = "submit" class = "btn btn-primary">
    </form>
  </div>
</div>

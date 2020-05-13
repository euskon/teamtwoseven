<?php

$projectID = $_GET['project'];

$getLogs = "SELECT Logs.logID, Logs.timestamp, Logs.location, Logs.logNotes
            FROM Logs, LogFor
            WHERE Logs.logID = LogFor.logID
            AND LogFor.projectID = '$projectID'";

$result = $db->query($getLogs);
?>

<div class="col-sm-10">
<table class="table">
<thead>
<tr>
<th>Operations</th>
<th>Date</th>
<th>Location</th>
<th>Notes</th>
</tr>
</thead>
<tbody>
<?php
while ($row = $result->fetch_row()) {
  echo "<tr>
        <td>
          <a href='./index.php?page=editLog&logid=$row[0]'>Edit</a> /
          <a href='./index.php?page=deleteLog&logid=$row[0]'>Delete</a>
        </td>
        <td>$row[1]</td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        </tr>";
}
?>
</tbody></table></div>

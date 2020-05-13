<?php

$demoData = array();
// Projects owned by teams
$demoData[0] = "SELECT Teams.name, Projects.name 
                FROM Teams, Projects, OwnedBy
                WHERE Teams.teamID = OwnedBy.teamID
                AND Projects.projectID = OwnedBy.projectID";

// Team members
$demoData[1] = "SELECT Teams.name, Users.name
                FROM Teams, Users, MembersOf
                WHERE Teams.teamID = MembersOf.teamID
                AND Users.userID = MembersOf.userID";

// Project logs
$demoData[2] = "SELECT Projects.name, Logs.logID, Logs.location, Logs.logNotes
                FROM Projects, Logs, LogFor
                WHERE Projects.projectID = LogFor.projectID
                AND Logs.logID = LogFor.logID";

// Who was at all the logs
$demoData[3] = "SELECT Logs.logID, Logs.location, Logs.logNotes, Users.name
                FROM Logs, Users, ParticipantOf
                WHERE Logs.logID = ParticipantOf.logID
                AND Users.userID = ParticipantOf.userID";

foreach ($demoData as &$demo) {
  printf("<br>%s<br>", $demo);
  $result = $db->query($demo);
  while ($row = $result->fetch_row()) {
    foreach ($row as &$rowData) {
      printf ("%s ", $rowData);
    }
    echo "<br>";
  }
}

?>

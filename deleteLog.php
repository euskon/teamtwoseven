<?php

$logID = $_GET['logid'];

$deleteLogs = "DELETE FROM Logs
               WHERE Logs.logID = '$logID'";

$deleteRelation = "DELETE FROM LogFor
                   WHERE LogFor.logID = '$logID'";

//Should do error checking
$result = $db->query($deleteLogs);
$result = $db->query($deleteRelation);
header("Location: index.php");

?>

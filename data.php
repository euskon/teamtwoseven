<?php

// This is fake demo data.
$teamData = array();
$userData = array();
$logData = array();
$projectData = array();
// Associates members to the teams they belong to
$membersOfData = array();
// Associates projects to the teams they belong to
$ownedByData = array();
// Associates members to logs they belong to
$participantOfData = array();
// Associates logs to the team they belong to
$logForData = array();

$teamData[0] = "INSERT INTO Teams (name) VALUES ('Star Wars')";
$teamData[1] = "INSERT INTO Teams (name) VALUES ('COVID-19')";
$teamData[2] = "INSERT INTO Teams (name) VALUES ('Team Two-Seven')";

$userData[0] = "INSERT INTO Users (name, password, email) VALUES ('jon', 'jon', 'jon@jon.com')";
$userData[1] = "INSERT INTO Users (name, password, email) VALUES ('jeff', 'jeff', 'jeff@jeff.com')";
$userData[2] = "INSERT INTO Users (name, password, email) VALUES ('zach', 'zach', 'zach@zach.com')";

$logData[0] = "INSERT INTO Logs (location, logNotes) VALUES ('Library', 'First meeting.')";
$logData[1] = "INSERT INTO Logs (location, logNotes) VALUES ('House', 'Second meeting.')";
$logData[2] = "INSERT INTO Logs (location, logNotes) VALUES ('Park', 'Last meeting.')";

$projectData[0] = "INSERT INTO Projects (name) VALUES ('Project Logger')";
$projectData[1] = "INSERT INTO Projects (name) VALUES ('Millennium Falcon')";
$projectData[2] = "INSERT INTO Projects (name) VALUES ('Katy Perry Fan Club')";

// Put Jon, Jeff, Zach in 'Team Two-Seven'
$tempTeamID = "SELECT teamID FROM Teams WHERE name = 'Team Two-Seven'";
$tempUserID = "SELECT userID FROM Users WHERE name = 'jon'";
$membersOfData[0] = "INSERT INTO MembersOf (teamID, userID) VALUES ('')"; 
$membersOfData[1] = "INSERT INTO MembersOf (teamID, userID) VALUES ('')"; 
$membersOfData[2] = "INSERT INTO MembersOf (teamID, userID) VALUES ('')"; 

?>

<?php

define('DB_SERVER', 'mysql.eecs.ku.edu');
define('DB_USERNAME', 'volden');
define('DB_PASSWORD', 'reeMoo3E');
define('DB_DATABASE', 'volden');

$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if ($db->connect_errno) {
  echo "Failed to connect to database: " . $db->connect_errno;
  exit();
}

// Create table templates if they don't exist

  $sqlTest = array();
  $sqlTables = array();

  $sqlTest[0] = "SELECT 1 FROM 'Teams' LIMIT 1";
  $sqlTables[0] = "CREATE TABLE Teams (
    teamID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL)";

  $sqlTest[1] = "SELECT 1 FROM 'Projects' LIMIT 1";
  $sqlTables[1] = "CREATE TABLE Projects (
    projectID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL)";

  $sqlTest[2] = "SELECT 1 FROM 'Users' LIMIT 1";
  $sqlTable[2] = "CREATE TABLE Users (
    userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    password VARCHAR(256) NOT NULL,
    email VARCHAR(30) NOT NULL)";

  $sqlTest[3] = "SELECT 1 FROM 'Logs' LIMIT 1";
  $sqlTable[3] = "CREATE TABLE Logs (
    logID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(30) NOT NULL,
    logNotes VARCHAR(30) NOT NULL)";

  $sqlTest[4] = "SELECT 1 FROM 'MembersOf' LIMIT 1";
  $sqlTable[4] = "CREATE TABLE MembersOf (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    teamID INT,
    userID INT,
    FOREIGN KEY (teamID) REFERENCES Teams(teamID) ON DELETE CASCADE,
    FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE)";

  $sqlTest[5] = "SELECT 1 FROM 'OwnedBy' LIMIT 1";
  $sqlTable[5] = "CREATE TABLE OwnedBy (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    teamID INT,
    projectID INT,
    FOREIGN KEY (teamID) REFERENCES Teams(teamID) ON DELETE CASCADE,
    FOREIGN KEY (projectID) REFERENCES Projects(projectID) ON DELETE CASCADE)";

  $sqlTest[6] = "SELECT 1 FROM 'LogFor' LIMIT 1";
  $sqlTable[6] = "CREATE TABLE LogFor (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    teamID INT,
    logID INT,
    FOREIGN KEY (teamID) REFERENCES Teams(teamID) ON DELETE CASCADE,
    FOREIGN KEY (logID) REFERENCES Logs(logID) ON DELETE CASCADE)";

  $sqlTest[7] = "SELECT 1 FROM 'ParticipantOf' LIMIT 1";
  $sqlTable[7] = "CREATE TABLE ParticipantOf (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    logID INT,
    userID INT,
    FOREIGN KEY (logID) REFERENCES Logs(LogID) ON DELETE CASCADE,
    FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE)";

  $count = 0;

  foreach ($sqlTest as &$test) {
    $result = $db->query($test);
    if ($result->num_rows > 0) {
      // exists
      echo "Exists...";
    } else {
      //echo $sqlTable[$count];
      $db->query($sqlTable[$count]);
    }
    $count++;
  }
?>

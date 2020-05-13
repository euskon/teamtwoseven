<?php

function getPagination() {
  global $debug, $loggedIn;
  $page = $_GET['page'];
  if (!$loggedIn && $page != "createUser") {
    $page = "login";
  }
  $debug['page'] = $page;
  return $page;
}

function checkLogin() {
  global $db, $debug;
  $username = $_SESSION['username'];
  $getUser = "SELECT userID, name FROM Users WHERE name = '$username'";
  $getTeam = "SELECT Teams.teamID, Teams.name 
              FROM Teams INNER JOIN MembersOf Using (teamID) 
              INNER JOIN Users USING (userID) WHERE Users.name = '$username'";
  $userResult = $db->query($getUser);
  if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_row();
    $_SESSION['userID'] = $userRow[0];
    $_SESSION['username'] = $userRow[1];
    $teamResult = $db->query($getTeam);
    $teamRow = $teamResult->fetch_row();
    $_SESSION['teamID'] = $teamRow[0];
    $_SESSION['teamname'] = $teamRow[1];

    $debug['userID'] = $userRow[0];
    $debug['username'] =  $userRow[1];
    $debug['teamID'] = $teamRow[0];
    $debug['teamname'] = $teamRow[1];

    return array(true, $userRow[0], $userRow[1], $teamRow[0], $teamRow[1]);
  } else {
    return array(false, '', '', '', '');
  }
}

function createNewLog(&$createLog) {
  global $db;
  $teamID = $_SESSION['teamID'];
  $location = $createLog[0];
  $newlog = $createLog[1];
  $projectID = $createLog[2];
  $newprojectname = $createLog[3];

  $insertLog = "INSERT INTO Logs (timestamp, location, logNotes) 
                VALUES (NOW(), '$location', '$newlog')";

  $result = $db->query($insertLog);
  $logid = $db->insert_id;

  if ($newprojectname) {
    $insertProject = "INSERT INTO Projects (name) VALUES ('$newprojectname')";
    $result = $db->query($insertProject);
    $projectID = $db->insert_id;
    $ownedByRelation = "INSERT INTO OwnedBy (teamID, projectID) VALUES ('$teamID', '$projectID')";
    $result = $db->query($ownedByRelation);
  }

  $relation = "INSERT INTO LogFor (projectID, logID) VALUES ('$projectID', '$logid')";
  $result = $db->query($relation);
}

function checkPost() {
  global $db, $debug, $teamID, $teamname;
  $username = $db->real_escape_string($_POST['username']);
  $debug['postUser'] = $username;
  $email = $db->real_escape_string($_POST['email']);
  $debug['postEmail'] = $email;
  $password = $db->real_escape_string($_POST['password']);
  $debug['postPassword'] = $password;
  $verifypassword = $db->real_escape_string($_POST['verifypassword']);
  $debug['postVerifyPassword'] = $verifypassword;
  $teamname = $db->real_escape_string($_POST['teamname']);
  $debug['postTeamName'] = $teamname;
  $teamnew = $db->real_escape_string($_POST['teamnew']);
  $debug['postTeamNameNew'] = $teamnew;
  $projectID = $db->real_escape_string($_POST['projectID']);
  $debug['postProjectID'] = $projectID;
  $newprojectname = $db->real_escape_string($_POST['newprojectname']);
  $debug['postNewProjectName'] = $newprojectname;
  $location = $db->real_escape_string($_POST['location']);
  $debug['postLocation'] = $location;
  $newlog = $db->real_escape_string($_POST['newlog']);
  $debug['postNewLog'] = $newlog;

  if ($db->real_escape_string($_POST['edit'])) {
    $editLogID = $db->real_escape_string($_POST['edit']);
    $editLocation = $db->real_escape_string($_POST['editLocation']);
    $editLog = $db->real_escape_string($_POST['editLog']);
    $ret = editLog($editLogID, $editLocation, $editLog);
  }

  if ($verifypassword) {
    $createUser = array();
    array_push($createUser, $username, $email, $password, $verifypassword, $teamname, $teamnew);
    $newUser = createNewUser($createUser);
  } else if ($newlog) {
    $createLog = array();
    array_push($createLog, $location, $newlog, $projectID, $newprojectname);
    createNewLog($createLog);
  } else {
    loginAttempt($username, $password);
  }
}

function editLog($editLogID, $editLocation, $editLog) {
  global $db;

  $editSQL = "UPDATE Logs
              SET timestamp = NOW(), location = '$editLocation', logNotes = '$editLog'
              WHERE logID = '$editLogID'";

  $result = $db->query($editSQL);

  header("Location: index.php");
}

function loginAttempt($username, $password) {
  global $db, $debug, $loggedIn;

  $sql = "SELECT userID FROM Users WHERE name = '$username' and password = '$password'";
  $result = $db->query($sql);
  $valid = $result->num_rows;
  if ($valid == 1) {
    $_SESSION['username'] = $username;
  }
}

function createNewUser($createUser) {
  global $db;
  $username = $createUser[0];
  $email = $createUser[1]; 
  $password = $createUser[2]; 
  $verifypassword = $createUser[3]; 
  $teamname = $createUser[4]; 
  $teamnew = $createUser[5];

  if ($password != $verifypassword) {
    $page = "createUser";
    $verifiedPassword = false;
    return false;
  } else {
    $insertUser = "INSERT INTO Users (name, email, password) VALUES ('$username', '$email', '$password')";
    $result = $db->query($insertUser);
    $userid = $db->insert_id;
    if ($teamnew) {
      $insertTeam = "INSERT INTO Teams (name) VALUES ('$teamnew')";
      $result = $db->query($insertTeam);
      $teamid = $db->insert_id;
      $insertRelation = "INSERT INTO MembersOf (teamID, userID) VALUES ('$teamid', '$userid')";
      $result = $db->query($insertRelation);
      //valid login
      $createdLogin = true;
      return true;
    } else {
      $insertRelation = "INSERT INTO MembersOf (teamID, userID) VALUES ('$teamname', '$userid')";
      $result = $db->query($insertRelation);
      $createdLogin = true;
      return true;
    }
  }
}
?>

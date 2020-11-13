<?php

function makeAccount($username, $password, $first_name, $last_name, $email)
{
    echo "hi";
    global $db;

    $query = $db->prepare('INSERT INTO User VALUES (:username, :password, :first_name, :last_name, :email)');
    $query->bindValue(":username", $username);
    $query->bindValue(":password", $password);
    $query->bindValue(":first_name", $first_name);
    $query->bindValue(":last_name", $last_name);
    $query->bindValue(":email", $email);
    echo "hi";
    if ($query->execute()){
    echo "this happened";
    }
    else {
    echo "Unable to create record";
    }
    $query->closeCursor();
}

function userExists($username)
{
  global $db;
  $query = "SELECT * FROM user WHERE username = :username";
  $stmt = $db->prepare($query);
  $stmt-> bindValue(':username', $username);
  $stmt->execute();

  if ($stmt->rowCount()==1){
    $stmt->closeCursor();
    return TRUE;
  }
  return FALSE;

}

function displayUsers(){
  global $db;
  $results = null;
  $query = 'SELECT * FROM User';
  if($stmt = $db->prepare($query))
  {
    if($stmt->execute())
    {
      $results = $stmt->fetchAll();
    }
  };

  $stmt->closeCursor();
  return $results;
}
function userLogin($username, $password)
{

}



?>

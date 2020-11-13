<?php

function makeAccount($username, $password, $first_name, $last_name, $email)
{
    global $db;
    $query = 'INSERT INTO user VALUES(:username, :password, :first_name, :last_name, :email)';
    if($stmt = $db->prepare($query)){
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT);
      $stmt->bindValue(':first_name', $first_name);
      $stmt->bindValue(':last_name', $last_name);
      $stmt->bindValue(':email', $email);
      if ($stmt->execute()){
        echo "this happened";
      }
    $stmt->closeCursor();
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

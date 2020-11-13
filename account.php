<?php

function makeAccount($username, $password, $first_name, $last_name, $email)
{
    global $db;
    $query = 'INSERT INTO user VALUES(:username, :password, :first_name, :last_name, :email)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', password_hash($password, PASSWORLD_DEFAULT));
    $stmt->bindValue(':first_name', $first_name);
    $stmt->bindValue(':last_name', $last_name);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

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
function userLogin($username, $password)
{

}


?>

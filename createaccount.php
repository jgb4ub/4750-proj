<?php

function makeAccount($username, $password, $first_name, $last_name, $email)
{
    // global $db
    // $stmt = $db->prepare('INSERT INTO user (username, password, first_name, last_name, email);
    // VALUES (:username, :password, :first_name, :last_name, :email)');
    // $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    // $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
    // $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR );
    // $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    // $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    // $param_password = password_hash($password, PASSWORD_DEFAULT);
    // $stmt->execute();
}

function userExists($username)
{
  global $db
  $query = "SELECT * FROM user WHERE username = :username";
  $stmt = $db->prepare($query);
  $stmt-> bindValue(':username', $username);
  $stmt->execute();
  $stmt->closeCursor();
  // if ($stmt->rowCount()==1){
  //   $stmt->closeCursor();
  //   return TRUE;
  // }
  // return FALSE;

}


?>

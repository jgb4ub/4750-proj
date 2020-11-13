<?php
require 'projectconnect.db';

function makeAccount($username, $password, $first_name, $last_name, $email)
{
    $stmt = $db->prepare('INSERT INTO user (username, password, first_name, last_name, email);
    VALUES (:username, :password, :first_name, :last_name, :email)');
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR );
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $param_password = password_hash($password, PASSWORD_DEFAULT);
    $stm->execute()
}

function userExists($username)
{
  $query = 'SELECT * FROM user WHERE username :=username';
  $stmt = $pdo->prepare($query);
  $stmt-> bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  if ($stmt->rowCount()==1){
    return TRUE;
  }
  return FALSE;

}


?>

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
  $stmt = $db->prepare("SELECT username FROM User WHERE Username = :username");
  $stmt-> bindValue(':username', $username);

  if ($stmt->execute()){

    if ($stmt->rowCount()==1){
      $stmt->closeCursor();
      return TRUE;
    }
  }

  return FALSE;

}

function displayUsers()
{
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
//
// function authenticate($username, $password)
// {
//     global $db;
//     $auth = FALSE;
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//     $query = 'SELECT * FROM User WHERE Username = :username AND Password = :password';
//     if($stmt = $db->prepare($query)){
//         $stmt->bindValue(':username', $username);
//         $stmt->bindValue(':password', $hashed_password);
//         if ($stmt->execute()){
//           if($stmt->rowCount() == 1){
//             $auth = TRUE;
//             $stmt->closeCursor();
//           }
//         }
//     }
//     return $auth;
// }



?>

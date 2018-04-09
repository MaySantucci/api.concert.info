<?php

$response_exist = array();
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/user_functions.php';

// connecting to db
$db = new DB_CONNECT();
$fun = new UserFunctions();

$con=mysqli_connect("localhost","root","","toponconcert");

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password']))
 {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($fun->checkIfUserExists($email)) {
        //Utente già esistente

              $response_exist["success"] = 0;
              $response_exist["message"] = "This account exists.";

              // echo no users JSON
              echo json_encode($response_exist);

    } else {
          //utente non esistente
          $fun->SaveUser($name, $surname, $email, $password);
      }

}
?>

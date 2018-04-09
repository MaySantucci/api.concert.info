<?php
// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/user_functions.php';

// connecting to db
$db = new DB_CONNECT();
$fun = new UserFunctions();
$con=mysqli_connect("localhost","root","","toponconcert");
// get all users from users table

if(isset($_POST["email"]))
{
  $email = $_POST['email'];

  $result = $fun->getUserByEmail($email);

  echo json_encode("Sto qui: " + $result);
}

 ?>

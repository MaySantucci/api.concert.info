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

if(isset($_POST["email"]) && isset($_POST["password"])){
      $email = $_POST["email"];
      $pw = $_POST["password"];

      $result = $fun->LoginUser($email, $pw);

      // check for empty result
      if ($result) {
        $response["success"] = 1;
        $response["message"] = "User logged successfully.";

        echo json_encode($response);

        } else {
            // no users found
            $response["success"] = 0;
            $response["message"] = "Credentials not valid";

            // echo no users JSON
            echo json_encode($response);
        }

}

?>

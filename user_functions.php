<?php


class UserFunctions {
  function __construct() {
    require_once __DIR__ . '/db_connect.php';
    // connecting to db
    $db = new DB_CONNECT();
    $con=mysqli_connect("localhost","root","","toponconcert");
    $response = array();

  }

  function __destruct() {

  }

  public function SaveUser ($name, $surname, $email, $password) {

    $con=mysqli_connect("localhost","root","","toponconcert");
    $result = mysqli_query($con, "INSERT INTO user (name, surname, email, password) VALUES ('$name', '$surname', '$email', '$password')") or die(mysql_error());

    if($result){
      $response["success"] = 1;
      $response["message"] = "User successfully created.";

      // echoing JSON response
      echo json_encode($response);
    } else {
      // failed to insert row
      $response["success"] = 0;
      $response["message"] = "User not created. An error occurred.";

      // echoing JSON response
      echo json_encode($response);
    }
  }

  public function checkIfUserExists($email){

    $con=mysqli_connect("localhost","root","","toponconcert");
    $query = "SELECT user.email FROM user WHERE user.email = '$email'";
    $result = mysqli_query($con, $query) or die(mysql_error());

    if(mysqli_num_rows($result) > 0){
      return true;
    } else {
      return false;
    }
  }

  public function LoginUser($email, $password){

        $con=mysqli_connect("localhost","root","","toponconcert");
        $query = "SELECT user.password FROM user WHERE user.email = '$email'";

        $result = mysqli_query($con, $query) or die(mysql_error());

        if(mysqli_num_rows($result) > 0){
          $response["user"] = array();

          while ($row = $result->fetch_assoc()) {
              // temp user array
              $user = array();
              $user["password"] = $row["password"];
              array_push($response["user"], $row);
        }

        if($user["password"] == $password){
          return true;
        }

      } else {
          return false;
        }
  }

  public function getUserByEmail($email){
    $con=mysqli_connect("localhost","root","","toponconcert");
    $query = "SELECT name, surname, email FROM user WHERE user.email = '$email'";

    $result = mysqli_query($con, $query) or die(mysql_error());

    if(mysqli_num_rows($result) > 0){
      $response["user"] = array();

      while ($row = $result->fetch_assoc()) {
          // temp user array
          $user = array();
          $user['name'] = $row['name'];
          $user['surname'] = $row['surname'];
          $user['email'] = $row['email'];
          array_push($response["user"], $row);
        }
        $response["success"] = 1;
        echo json_encode($response);

      } else {
        //no user with this email
        $response["success"] = 0;
        $response["message"] = "No user found";

              echo json_encode($response);

      }

  }

}

 ?>

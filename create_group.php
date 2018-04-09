<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['group_name']) && isset($_POST['phone']) && isset($_POST['email_group']) && isset($_POST['type_music']))
 {

    $group_name = $_POST['group_name'];
    $phone = $_POST['phone'];
    $email_group = $_POST['email_group'];
    $type_music = $_POST['type_music'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    $con=mysqli_connect("localhost","root","","toponconcert");
    // get all products from products table
    $query = "INSERT INTO artist(group_name, phone, email_group, type_music) VALUES ('$group_name', '$phone', '$email_group', '$type_music')";
    $result = mysqli_query($con, $query) or die(mysql_error());


    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Pub successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";

        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>

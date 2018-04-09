<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['pub_name']) && isset($_POST['address']) && isset($_POST['num_civico']) && isset($_POST['city']) && isset($_POST['cap']) && isset($_POST['provincia']) && isset($_POST['phone']) && isset($_POST['email_pub']))
 {

    $pub_name = $_POST['pub_name'];
    $address = $_POST['address'];
    $num_civico = $_POST['num_civico'];
    $city = $_POST['city'];
    $cap = $_POST['cap'];
    $provincia = $_POST['provincia'];
    $phone = $_POST['phone'];
    $email_pub = $_POST['email_pub'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    $con=mysqli_connect("localhost","root","","toponconcert");
    // get all products from products table
    $query = "INSERT INTO pub(pub_name, address, num_civico, city, cap, provincia, phone, email_pub) VALUES ('$pub_name', '$address', '$num_civico', '$city', '$cap', '$provincia', '$phone', '$email_pub')";
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

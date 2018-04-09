<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
$con=mysqli_connect("localhost","root","","toponconcert");
// get all pubs from pubs table
$result = mysqli_query($con, "SELECT * FROM pub") or die(mysql_error());

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // pubs node
    $response["pub"] = array();

    while ($row = $result->fetch_assoc()) {
        // temp pub array
        $pub = array();
        $pub["id_pub"] = $row["id_pub"];
        $pub["pub_name"] = $row["pub_name"];
        $pub["address"] = $row["address"];
        $pub["num_civico"] = $row["num_civico"];
        $pub["city"] = $row["city"];
        $pub["cap"] = $row["cap"];
        $pub["provincia"] = $row["provincia"];
        $pub["phone"] = $row["phone"];
        $pub["email_pub"] = $row["email_pub"];

        // push single pub into final response array
        array_push($response["pub"], $row);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no pubs found
    $response["success"] = 0;
    $response["message"] = "No pubs found";

    // echo no pubs JSON
    echo json_encode($response);
}
?>

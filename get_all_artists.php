<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
$con=mysqli_connect("localhost","root","","toponconcert");
// get all artists from artists table
$result = mysqli_query($con, "SELECT * FROM artist") or die(mysql_error());

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // artists node
    $response["artist"] = array();

    while ($row = $result->fetch_assoc()) {
        // temp artist array
        $artist = array();
        $artist["id_group"] = $row["id_group"];
        $artist["group_name"] = $row["group_name"];
        $artist["phone"] = $row["phone"];
        $artist["email_group"] = $row["email_group"];
        $artist["type_music"] = $row["type_music"];

        // push single artist into final response array
        array_push($response["artist"], $row);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no artists found
    $response["success"] = 0;
    $response["message"] = "No artists found";

    // echo no artists JSON
    echo json_encode($response);
}
?>

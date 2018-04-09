<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
$con=mysqli_connect("localhost","root","","toponconcert");
// get all events from events table
$query = "SELECT id_event, group_name, pub_name, day, hour, description FROM event, artist, pub WHERE (event.id_group = artist.id_group && event.id_pub = pub.id_pub)";
$result = mysqli_query($con, $query) or die(mysql_error());

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // events node
    $response["event"] = array();

    while ($row = $result->fetch_assoc()) {
        // temp user array
        $event = array();
        $event["id_event"] = $row["id_event"];
        $event["group_name"] = $row["group_name"];
        $event["pub_name"] = $row["pub_name"];
        $event["day"] = $row["day"];
        $event["hour"] = $row["hour"];
        $event["description"] = $row["description"];

        // push single event into final response array
        array_push($response["event"], $row);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no events found
    $response["success"] = 0;
    $response["message"] = "No events found";

    // echo no users JSON
    echo json_encode($response);
}
?>

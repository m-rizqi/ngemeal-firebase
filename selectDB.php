<?php
include 'config.php';
$con = new mysqli(SERVER, USERNAME, PASSWORD, DB_NAME);
$query = "SELECT * FROM `foods` WHERE 1";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo json_encode($row);
    }
}
echo json_encode($result);
?>
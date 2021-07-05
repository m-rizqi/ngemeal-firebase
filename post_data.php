<?php
require_once 'connection.php';
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DB_NAME);
    $query = "SELECT * FROM `foods` WHERE 1";
    $myArray = array();
    $exist = false;
    if ($res = $mysqli->query($query)) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        $exist = true;
        $myArray[] = $row;
        echo json_encode($myArray);
        }  
    }
    if (!$exist) {
        $query = "INSERT INTO `foods`(`id`, `title`, `vegetarian`, `glutenFree`, `dairyFree`, `veryHealthy`, `cheap`, `healthScore`, `creditsText`, `pricePerServing`, `extendedIngredients`, `sourceUrl`, `image`, `nutrition`, `summary`, `dishTypes`, `diets`, `instructions`, `spoonacularSourceUrl`) VALUES (2,'coba',false,true,false,true,true,4,'coba',2,'[{\"coba\":\"coba\"}]','coba.com','coba.com','{\"coba\":\"coba\"}','coba','{\"coba\":\"coba\"}','{\"coba\":\"coba\"}','coba','coba.com')";
        //$result = mysqli_query($con,$query);
        echo $query;
    }
// $query = "INSERT INTO `foods`(`id`, `title`) VALUES (1,'w')";
// $result = mysqli_query($con, $query);
//echo $result;
?>
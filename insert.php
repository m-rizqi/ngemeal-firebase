<?php
include('includes/dbconfig.php');
    $food = '{"name":"nasi","weight":4,"bool":false,"array":[{"array":1}]}';
    echo $food;
    $food = json_decode($food);

    $ref = "foods/";
    $post = $database->getReference($ref)->push($food);

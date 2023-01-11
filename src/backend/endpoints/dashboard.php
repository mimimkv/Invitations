<?php

    //left on purpose to demonstrate the loading indicator in the frontend
    //sleep(1);


    session_start();
    // header("Content-type: application/json");
    $response = [];

    if ($_SESSION) {
        if($_SESSION["email"]) {
            $response = ["success" => true, "email" => $_SESSION["email"], "name" => $_SESSION["name"]];
        } else {
            $response = ["success" => false, "error" => "Unauthorized access"];
        }
    } else {
        $response = ["success" => false, "error" => "Session expired"];
    }

    echo json_encode($response);

?>
<?php

    session_start();
    // header("Content-type: application/json");

    if ($_SESSION) {
        session_unset();
        session_destroy();
        
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
?>
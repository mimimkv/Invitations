<?php

    session_start();

    if ($_SESSION) {
        session_unset();
        session_destroy();
        
        setcookie("token", "", time() - 60, "/");

        echo json_encode(["success" => true]);
    } else {
        // user has already logged out
        echo json_encode(["success" => false]);
    }
?>
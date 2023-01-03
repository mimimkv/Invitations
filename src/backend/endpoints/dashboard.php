<?php

    require_once('../services/token-service.php');

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

        if($_COOKIE["token"]) { 
            $tokenService = new TokenService();
            $isValid = $tokenService->isValidToken($_COOKIE["token"]);

            if($isValid) {
                $userEmail = $isValid["user_email"];
                $_SESSION["email"] = $userEmail;
                // $_SESSION["fn"] = $userData->getFn();

                $response = ["success" => true, "data" => $_SESSION["email"]];
            } else {
                $response = $isValid;
            } 
        } else {
            $response = ["success" => false, "error" => "Session expired"];
        }
    }

    echo json_encode($response);

?>
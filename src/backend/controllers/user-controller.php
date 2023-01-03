<?php

require_once '../services/user-service.php';
require_once '../mappers/user-mapper.php';
require_once '../services/token-service.php';

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function register()
    {
        $userModel = call_user_func('UserMapper::toModel', json_decode(file_get_contents('php://input'), true));
        $response = ["success" => true];
        try {
            $this->userService->addUser(
                $userModel->getFn(), $userModel->getEmail(), $userModel->getPassword(), $userModel->getFirstName(),
                $userModel->getLastName(), $userModel->getCourse(), $userModel->getSpecialty()
            );
        } catch (InvalidArgumentException $e) {
            $response["success"] = false;
            $response["error"] = $e->getMessage();
        }


        return $response;
    }

    public function login() 
    {
        session_start();
        $userCredentials = json_decode(file_get_contents('php://input'), true);
        //echo $userCredentials["email"];
        //echo $userCredentials["remember-me"];
        //echo $userCredentials["remember-me"] ? "true" : "false";

        $email = $userCredentials["email"];
        $password = $userCredentials["password"];
        $rememberMe = $userCredentials["remember-me"] ? true : false;
        // echo $rememberMe? "t" : "f";

        $response = ["success" => true];
        $user = null;
        try {
            $user = $this->userService->isUserValid($email, $password);

        } catch(InvalidArgumentException $e) {
            $response["success"] = false;
            $response["error"] = $e->getMessage();
        }

        //print_r($user);

        if (isset($user)) {
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $user['first_name'];

            if ($rememberMe) {
                $tokenService = new TokenService();
                $tokenService->createNewToken($email);
            }
        }
        
        // echo $user['first_name'];
        
        return $response;
    }
}

?>
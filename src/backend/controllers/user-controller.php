<?php

require_once '../services/user-service.php';
require_once '../mappers/user-mapper.php';

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
}

?>
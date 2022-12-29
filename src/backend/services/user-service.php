<?php
require_once '../database/config.php';
require_once '../repositories/user-repository.php';
require_once '../mappers/user-mapper.php';

class UserService
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    function getAllUsers()
    {
        $users = $this->userRepository->getAllUsers();
        return array_map(array('UserMapper', 'toDto'), $users);
    }
}

//for testing purposes
$userService = new UserService();
$result = $userService->getAllUsers();

echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>
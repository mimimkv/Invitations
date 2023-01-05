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

    function addUser($fn, $email, $password, $firstName, $lastName, $course, $specialty) {
        if ($this->userRepository->findUserByFn($fn)) {
            throw new InvalidArgumentException("User with fn $fn already exists.");
        }

        if ($this->userRepository->findUserByEmail($email)) {
            throw new InvalidArgumentException("User with email $email already exists.");
        }

        $result = $this->userRepository->addUser($fn, $password, $email, $firstName, $lastName, $course, $specialty);
        return $result;
    }
}

//for testing purposes
/*$userService = new UserService();
$result = $userService->getAllUsers();

echo json_encode($result, JSON_UNESCAPED_UNICODE);

try {
    if ($userService->addUser(123456, '123', 'test3@gmail.com', 'Test', 'Test', 4, 'KN')) {
        echo "User added successfully";
    } else {
        echo "Error";
    }
} catch(InvalidArgumentException $e) {
    echo $e->getMessage();
} */


?>
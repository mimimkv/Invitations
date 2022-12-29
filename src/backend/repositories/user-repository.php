<?php
require_once '../database/config.php';
require_once '../mappers/user-mapper.php';

class UserRepository {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $rows = $this->db->executeQuery($query)->fetchAll();

        return array_map(array('UserMapper', 'toModel'), $rows);
    }
}

?>
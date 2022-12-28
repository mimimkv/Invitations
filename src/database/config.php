<?php
class Database {
    private $connection;

    function __construct() {
        $ini_array = parse_ini_file('../config/config.ini');

        $type = $ini_array['type'];
        $host = $ini_array['host'];
        $name = $ini_array['name'];
        $user = $ini_array['user'];
        $password = $ini_array['password'];

        try {
            $this->connection = new PDO(
                "$type:host=$host;dbname=$name",
                $user,
                $password
            );
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getConnection() {
        return $this->connection;
    }
}

?>
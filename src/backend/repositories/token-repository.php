<?php
require_once '../database/config.php';

class TokenRepository {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addToken($token, $userFn, $expires) {
        $query = "INSERT INTO tokens(token, user_email, expires) VALUES (:token, :user_email, :expires) ";
        $params = [
            "token" => $token,
            "user_email" => $userFn,
            "expires" => $expires
        ];

        $newToken = $this->db->executeQuery($query, $params)->fetch();
        return $newToken;
        // return true;
    }

    public function findToken($token) {
        $sql = "SELECT * FROM tokens WHERE token=:token";
        //$selectTokenStatement = $this->db->getConnection()->prepare($sql);

        $result = $this->db->executeQuery($sql, $token)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>
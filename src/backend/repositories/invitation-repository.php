<?php
require_once '../database/config.php';
require_once '../mappers/user-mapper.php';

class InvitationRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createInvitation($title, $place)
    {
        $query = "INSERT INTO invitations(title, place)\n" .
            "VALUES (:title, :place)";

        $params = [
            "title" => $title,
            "place" => $place
        ];

        return $this->db->executeQuery($query, $params);
    }

    public function findInvitationByTitle($title) {
        $query = "SELECT * FROM invitations WHERE title=:title";
        $params = ["title" => $title];

        $invitation = $this->db->executeQuery($query, $params)->fetch();
        return $invitation;
    }
}

?>
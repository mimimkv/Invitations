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

    public function createInvitation($title, $place, $filename)
    {
        $query = "INSERT INTO invitations(title, place, filename)\n" .
            "VALUES (:title, :place, :filename)";

        $params = [
            "title" => $title,
            "place" => $place
        ];

        if ($filename !== '') {
            $params["filename"] = $filename;
        } else {
            $params["filename"] = 'NULL';
        }

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
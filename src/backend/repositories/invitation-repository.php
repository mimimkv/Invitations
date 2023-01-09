<?php
require_once '../database/config.php';
require_once '../mappers/user-mapper.php';
require_once '../mappers/invitation-mapper.php';

class InvitationRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createInvitation($title, $place, $presenter_fn, $filename)
    {
        $query = "INSERT INTO invitations(title, place, presenter_fn, filename)\n" .
            "VALUES (:title, :place, :presenter_fn, :filename)";

        $params = [
            "title" => $title,
            "place" => $place,
            "presenter_fn" => $presenter_fn
        ];

        if ($filename !== '') {
            $params["filename"] = $filename;
        } else {
            $params["filename"] = 'NULL';
        }

        return $this->db->executeQuery($query, $params);
    }

    public function findInvitationByTitle($title)
    {
        $query = "SELECT * FROM invitations WHERE title=:title";
        $params = ["title" => $title];

        $invitation = $this->db->executeQuery($query, $params)->fetch();
        return $invitation;
    }

    public function getAllInvitations()
    {
        $query = "SELECT * FROM invitations INNER JOIN users ON fn = presenter_fn";
        $rows = $this->db->executeQuery($query)->fetchAll();

        return array_map(array('InvitationMapper', 'toModel'), $rows);
    }
}

?>
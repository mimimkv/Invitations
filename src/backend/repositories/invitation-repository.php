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

    public function createInvitation($title, $place, $date, $time, $endTime, $filename)
    {
        $query = "INSERT INTO invitations(title, place, date, time, end_time, filename)\n" .
            "VALUES (:title, :place, :date, :time, :end_time, :filename)";

        $params = [
            "title" => $title,
            "place" => $place,
            "date" => $date,
            "time" => $time,
            "end_time" => $endTime
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

    public function findInvitationByDateAndTime($date, $time) {
        $query = "SELECT * FROM invitations WHERE date=:date AND :time>=time AND :time<end_time";
        $params = ["date" => $date, "time" => $time];

        $invitation = $this->db->executeQuery($query, $params)->fetch();
        return $invitation;
    }
}

?>
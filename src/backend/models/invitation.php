<?php

class InvitationModel
{
    private $id;
    private $title;
    private $place;
    private $date;
    private $time;
    private $endTime;

    private $filename;

    public function __construct(
        $title,
        $place,
        $date,
        $time,
        $endTime,
        $filename=''
    )
    {
        $this->title = $title;
        $this->place = $place;
        $this->date = $date;
        $this->time = $time;
        $this->endTime = $endTime;
        $this->filename = $filename;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTime() {
        return $this->time;
    }

    public function getEndTime() {
        return $this->endTime;
    }
}
?>
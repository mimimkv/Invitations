<?php

class InvitationDto
{
    private $title;
    private $place;
    private $date;
    private $time;
    private $filename;

    public function __construct(
        $title,
        $place,
        $date,
        $time,
        $filename
    )
    {
        $this->title = $title;
        $this->place = $place;
        $this->date = $date;
        $this->time = $time;
        $this->filename = $filename;
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
}
?>
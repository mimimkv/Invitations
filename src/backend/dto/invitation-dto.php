<?php

class InvitationDto
{
    public $title;
    public $place;
    public $filename;

    public function __construct(
        $title,
        $place,
        $filename
    )
    {
        $this->title = $title;
        $this->place = $place;
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
}
?>
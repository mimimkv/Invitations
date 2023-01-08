<?php

class InvitationModel
{
    private $id;
    private $title;
    private $place;

    private $filename;

    public function __construct(
        $title,
        $place,
        $filename=''
    )
    {
        $this->title = $title;
        $this->place = $place;
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

    public function setFilename($filename) {
        $this->filename = $filename;
    }
}
?>
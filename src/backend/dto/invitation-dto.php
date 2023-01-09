<?php

class InvitationDto
{
    public $title;
    public $place;
    public $filename;

    public $presenter;

    public function __construct(
        $title,
        $place,
        $presenter,
        $filename
    )
    {
        $this->title = $title;
        $this->place = $place;
        $this->presenter = $presenter;
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

    public function getPresener() {
        return $this->presenter;
    }

    public function getFilename() {
        return $this->filename;
    }
}
?>
<?php

class InvitationModel
{
    private $id;
    private $title;
    private $place;

    private $presenter;
    private $filename;

    public function __construct(
        $title,
        $place,
        $presenter,
        $filename=''
    )
    {
        $this->title = $title;
        $this->place = $place;
        $this->presenter = $presenter;
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

    public function getPresenter() {
        return $this->presenter;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }
}
?>
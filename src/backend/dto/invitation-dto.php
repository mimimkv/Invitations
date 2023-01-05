<?php

class InvitationDto
{
    private $title;
    private $place;

    public function __construct(
        $title,
        $place
    )
    {
        $this->title = $title;
        $this->place = $place;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPlace()
    {
        return $this->place;
    }
}
?>
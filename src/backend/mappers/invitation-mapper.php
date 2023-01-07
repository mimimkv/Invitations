<?php

require_once '../models/invitation.php';
require_once '../dto/invitation-dto.php';

class InvitationMapper
{
    public static function toModel($data)
    {
        return new InvitationModel(
            $data["title"],
            $data["place"],
            $data["date"],
            $data["time"],
            $data["filename"]
        );
    }

    public static function toDto($invitation)
    {
        return new InvitationDto(
            $invitation->getTitle(),
            $invitation->getPlace(),
            $invitation->getDate(),
            $invitation->getTime(),
            $invitation->getFilename()
        );
    }
}

?>
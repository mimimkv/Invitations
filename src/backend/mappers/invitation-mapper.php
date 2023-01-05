<?php

require_once '../models/invitation.php';
require_once '../dto/invitation-dto.php';

class InvitationMapper
{
    public static function toModel($data)
    {
        return new InvitationModel(
            $data["title"],
            $data["place"]
        );
    }

    public static function toDto($invitation)
    {
        return new InvitationDto(
            $invitation->getTitle(),
            $invitation->getPlace()
        );
    }
}

?>
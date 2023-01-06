<?php

//require_once '../database/config.php';
require_once '../repositories/invitation-repository.php';
//require_once '../mappers/user-mapper.php';
class InvitationService {
    private $invitationRepository;

    public function __construct() {
        $this->invitationRepository = new InvitationRepository();
    }

    public function createInvitation($title, $place, $filename) {
        if ($this->invitationRepository->findInvitationByTitle($title)) {
            throw new InvalidArgumentException("Invitation with this title already exists");
        }

        $result = $this->invitationRepository->createInvitation($title, $place, $filename);
        return $result;
    }
}

//for testing purposes
/*$invitationService = new InvitationService();
$result = $invitationService->createInvitation("test", "test");
echo $result["title"]; */

?>
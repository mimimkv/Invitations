<?php

require_once '../repositories/invitation-repository.php';
require_once '../mappers/invitation-mapper.php';

class InvitationService {
    private $invitationRepository;

    public function __construct() {
        $this->invitationRepository = new InvitationRepository();
    }

    public function createInvitation($title, $place, $presenter_fn, $filename) {
        if ($this->invitationRepository->findInvitationByTitle($title)) {
            throw new InvalidArgumentException("Invitation with this title already exists");
        }

        $result = $this->invitationRepository->createInvitation($title, $place, $presenter_fn, $filename);
        return $result;
    }

    public function getAllInvitations() {
        $invitations = $this->invitationRepository->getAllInvitations();
        foreach ($invitations as $i) {
            $filename = $i->getFilename();
            if ($filename !== null && $filename !== 'NULL') {
                $encodedName = base64_encode(file_get_contents('../upload/'.$i->getFilename()));
                $i->setFilename($encodedName);
            } else if($filename === null){
                $i->setFilename('NULL');
            }

            //echo $i->getFilename();
            //echo $i->getTitle();
        }

        return array_map(array('InvitationMapper', 'toDto'), $invitations);

    }
}

//for testing purposes
/*$invitationService = new InvitationService();
$result = $invitationService->createInvitation("test", "test");
echo $result["title"]; */

//$invitationService = new InvitationService();
//$invitationService->getAllInvitations();

?>
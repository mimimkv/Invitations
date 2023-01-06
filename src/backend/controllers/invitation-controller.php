<?php

require_once '../services/invitation-service.php';
require_once '../mappers/invitation-mapper.php';
class InvitationController
{
    private $invitationService;

    public function __construct()
    {
        $this->invitationService = new InvitationService();
    }

    public function createInvitation()
    {
        $title = $_POST['title'];
        $place = $_POST['place'];

        $invitationModel = call_user_func('InvitationMapper::toModel', ['title' => $title, 'place' => $place, 'filename' => 'test.png']);
        $response = ["success" => true];
        try {
            $this->invitationService->createInvitation(
                $invitationModel->getTitle(),
                $invitationModel->getPlace(),
                $invitationModel->getFilename()
            );
        } catch (InvalidArgumentException $e) {
            $response["success"] = false;
            $response["error"] = $e->getMessage();
        }

        // $invitationModel = call_user_func('InvitationMapper::toModel', json_decode(file_get_contents('php://input'), true));
        // $response = ["success" => true];
        // try {
        //     $this->invitationService->createInvitation(
        //         $invitationModel->getTitle(),
        //         $invitationModel->getPlace(),
        //         $invitationModel->getFilename()
        //     );
        // } catch (InvalidArgumentException $e) {
        //     $response["success"] = false;
        //     $response["error"] = $e->getMessage();
        // }


        return $response;

    }
}

?>
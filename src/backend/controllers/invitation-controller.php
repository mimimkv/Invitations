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

        $filename = "NULL";
        /*if ($_FILES) {
        $filename = $_SESSION['email'] . '_' . $_FILES['filename']['name'];
        } */
        if ($_FILES && $_FILES['filename']['name']) {
            $filename = $_SESSION['email'] . '_' . $_FILES['filename']['name'];
            $location = '../upload/';

            $path = $location . $filename;

            move_uploaded_file($_FILES['filename']['tmp_name'], $path);
        }

        $invitationModel = call_user_func('InvitationMapper::toModel', ['title' => $title, 'place' => $place, 'filename' => $filename]);
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

    /*public function getInvitation()
    {
        $image = "../upload/misho@gmail.com_tibet1.jpg";
        $imageResponse = base64_encode(file_get_contents($image));
        //echo '<img src="data:image/jpg;base64,'.base64_encode(file_get_contents($image)).'">';
        $response['image'] = $imageResponse;
        return $response;
    } */

    public function getAllInvitations()
    {
        $response = ["success" => true];
        try {
            $invitations = $this->invitationService->getAllInvitations();
            $response["body"] = $invitations;
            //echo $invitations[0]->getTitle();
        } catch (Exception $e) {
            $response["success"] = false;
            $response["error"] = $e->getMessage();
        }

        return $response;
    }
}


/*$image = "../upload/misho@gmail.com_tibet1.jpg";
$imageResponse = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpg;base64,'.base64_encode(file_get_contents($image)).'">';
//$response['image'] = $imageResponse;
//return $response; */


//$invitationController = new InvitationController();
//$invitationController->getAllInvitations();

?>
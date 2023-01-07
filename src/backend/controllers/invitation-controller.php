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
        if ($_FILES) {
            $filename = $_SESSION['email'] . '_' . 'invitation.png';
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

    public function getInvitation() {
        $image = "../upload/misho@gmail.com_tibet1.jpg";
        $imageResponse = base64_encode(file_get_contents($image));
        //echo '<img src="data:image/jpg;base64,'.base64_encode(file_get_contents($image)).'">';
        $response['image'] = $imageResponse;
        return $response;
    }

    public function getAllInvitations() {
        $response['images'] = [];

        $files = array_diff(scandir('../upload/'), array('.', '..'));
        foreach($files as $x => $x_value) {
            //echo "Key=" . $x . ", Value=" . $x_value;
            //echo "<br>";
            $imageResponse = base64_encode(file_get_contents('../upload/'.$x_value));
            array_push($response['images'], $imageResponse);
            
          }

        //echo $response['images'][0];
        return $response;
    }
}


/*$image = "../upload/misho@gmail.com_tibet1.jpg";
        $imageResponse = base64_encode(file_get_contents($image));
        echo '<img src="data:image/jpg;base64,'.base64_encode(file_get_contents($image)).'">';
        //$response['image'] = $imageResponse;
        //return $response; */


$invitationController = new InvitationController();
$invitationController->getAllInvitations();

?>
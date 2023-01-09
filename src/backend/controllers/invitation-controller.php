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
        $date = $_POST['date'];
        $time = $_POST['time'];

        $endTime = date('H:i:s', strtotime($time. ' +10 minutes'));
        //echo $endTime;
        

        $invitationModel = call_user_func('InvitationMapper::toModel', ['title' => $title, 
                                                                        'place' => $place, 
                                                                        'date' => $date,
                                                                        'time' => $time,
                                                                        'end_time' => $endTime,
                                                                        'filename' => 'test.png']);
        $response = ["success" => true];
        try {
            $this->invitationService->createInvitation(
                $invitationModel->getTitle(),
                $invitationModel->getPlace(),
                $invitationModel->getDate(),
                $invitationModel->getTime(),
                $invitationModel->getEndTime(),
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
}


/*$image = "../upload/misho@gmail.com_tibet1.jpg";
        $imageResponse = base64_encode(file_get_contents($image));
        echo '<img src="data:image/jpg;base64,'.base64_encode(file_get_contents($image)).'">';
        //$response['image'] = $imageResponse;
        //return $response; */


//$invitationController = new InvitationController();
//$invitationController->getInvitation();

?>
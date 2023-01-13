<?php

require_once '../services/like-service.php';
require_once '../mappers/like-mapper.php';

class LikeController
{
    private $likeService;

    public function __construct()
    {
        $this->likeService = new LikeService();
    }

    public function createLike()
    {
        $response = ["success" => true];

        $invitationId = json_decode(file_get_contents('php://input'), true)["invitationId"];


        try {
            //echo $_SESSION["fn"];
            $this->likeService->createLike($_SESSION["fn"], $invitationId);
            //$this->likeService->createLike(11111, $invitationId);
        } catch (InvalidArgumentException $e) {
            $response["success"] = false;
            $response["error"] = $e->getMessage();
        }

        return $response;
    }

    public function getAllLikes() {
        $response = ["success" => true];
        try {
            $likes = $this->likeService->getAllLikes();
            $response["body"] = $likes;
            //echo $invitations[0]->getTitle();
        } catch (Exception $e) {
            $response["success"] = false;
            $response["error"] = $e->getMessage();
        }

        return $response;
    }
}

?>
<?php

require_once '../controllers/invitation-controller.php';

$invitationController = new InvitationController();
echo json_encode($invitationController->getAllInvitations());

?>
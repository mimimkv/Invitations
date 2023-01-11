<?php

require_once '../controllers/invitation-controller.php';

session_start();

if (!$_SESSION['email']) {
    echo json_encode(["success" => false, "error" => "You have to log in"]);
    exit();
}


/*if ($_FILES && $_FILES['filename']['name']) {
    $filename = $_SESSION['email'] . '_' . $_FILES['filename']['name'];
    $location = '../upload/';

    $path = $location . $filename;

    move_uploaded_file($_FILES['filename']['tmp_name'], $path);
} */

$invitationController = new InvitationController();
echo json_encode($invitationController->createInvitation());

?>
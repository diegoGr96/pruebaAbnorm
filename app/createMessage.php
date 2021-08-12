<?php

require_once '../config/db.php';
require_once './helpers.php';

$db = Database::connect();
if (mysqli_connect_errno()) {
    echo json_encode(array(
        'status' => 'ERROR',
    ));
    exit();
}


if (isset($_POST['name']) && isset($_POST['message']) && isset($_POST['lastId'])) {

    $name = trim($_POST['name']);
    $message = trim($_POST['message']);
    $lastId = trim($_POST['lastId']);
    

    if (strlen($name) <= 0 || strlen($message) <= 0 || strlen($lastId) <= 0) {
        echo json_encode(array(
            'status' => 'ERROR',
        ));
        exit();
    }

} else {
    echo json_encode(array(
        'status' => 'ERROR',
    ));
    exit();
}


$query = "INSERT INTO message (name, message) VALUES (?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('ss', $name, $message);
$result = $stmt->execute();


if ($result) {
    $listMessages = getMessagesById($db, $lastId);

    echo json_encode(array(
        'status' => 'OK',
        /*
            With this param, we will only load the new messages when the user creates one and needs to reload the message list. Wont load the whole list unnecessarily.
        */
        'lastId' => count($listMessages) > 0 ? $listMessages[0]['id'] : 0,
        'messages' => $listMessages
    ));
} else {
    echo json_encode(array(
        'status' => 'ERROR',
    ));
}


exit();

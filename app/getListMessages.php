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

$listMessages = getMessagesById($db);

if (is_array($listMessages)) {
    echo json_encode(array(
        'status' => 'OK',
        'lastId' => count($listMessages) > 0 ? $listMessages[0]['id'] : 0,
        'messages' => $listMessages
    ));
} else {
    echo json_encode(array(
        'status' => 'ERROR',
    ));
}


exit();

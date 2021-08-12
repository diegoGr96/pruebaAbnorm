<?php

require_once '../config/db.php';

$db = Database::connect();
if (mysqli_connect_errno()) {
    echo json_encode(array(
        'status' => 'ERROR',
    ));
    exit();
}

if (isset($_POST['action']) && isset($_POST['messageId'])) {

    $action = trim($_POST['action']);
    $messageId = trim($_POST['messageId']);
    
    if (strlen($action) <= 0 || strlen($messageId) <= 0) {
        echo json_encode(array(
            'status' => 'ERROR',
        ));
        exit();
    }

}else{
    echo json_encode(array(
        'status' => 'ERROR',
    ));
    exit();
}

if($action == 'like' || $action == 'dislike'){

    $queryAction = $action == 'like' ? 1 : -1;
    $query = "UPDATE message SET likes = (likes + $queryAction) WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $_POST['messageId']);
    $result = $stmt->execute();

    if($result){
        $query = "SELECT likes FROM message WHERE id = ? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $_POST['messageId']);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
    }

    echo json_encode(array(
        'status' => 'OK',
        'likes' => $row['likes']
    ));
    
}else{
    echo json_encode(array(
        'status' => 'ERROR',
    ));
}


exit();






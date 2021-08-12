<?php

function getMessagesById($db, $id = 0){
    try {
        $query = "SELECT * FROM message where id > ? ORDER BY created_at desc";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $listMessages = array();
        
        while ($row = $result->fetch_assoc()) {
            $message = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'message' => $row['message'],
                'likes' => $row['likes'],
                'created_at' => $row['created_at'],
            );
    
            array_push($listMessages, $message);
        }
    
        return $listMessages;
    } catch (\Throwable $th) {
        return null;
    }
}

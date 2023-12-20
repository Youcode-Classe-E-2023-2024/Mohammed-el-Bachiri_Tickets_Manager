<?php
include '../../classes/Comment.php';
include '../../config/DbConnection.php';
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$tag = new Comment($connection);
try {
    $result = $tag->Add($data['comment'], $data['ticketId'], $_SESSION['userId']);
} catch (Exception $e) {
    echo $e->getMessage();
}


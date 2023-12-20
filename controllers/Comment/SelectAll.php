<?php
include '../../classes/Comment.php';
include '../../config/DbConnection.php';

$data = json_decode(file_get_contents('php://input'), true);

$comments = new Comment($connection);
$data = $comments->SelectAll($data['ticketId']);

$result = mysqli_fetch_all($data, MYSQLI_ASSOC);
header('Content-Type: application/json');
echo json_encode($result);

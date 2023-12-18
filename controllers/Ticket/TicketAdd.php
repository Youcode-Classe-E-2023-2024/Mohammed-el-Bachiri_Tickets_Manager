<?php 
include '../../classes/Ticket.php';
include '../../classes/Assignment.php';
include '../../config/DbConnection.php';
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$title = $data['title'];
$description = $data['desc'];
$status = $data['status'];
$priority = $data['priority'];
$tag = $data['tag'];
$users = $data['users'];

$tickets = new Ticket($connection);
$assignment = new Assignment($connection);
try {
    $thisTicketID = $tickets->Add($userId, $title, $description, $status, $priority, $tag);
} catch (Exception $e) {
    echo $e->getMessage();
};

foreach($users as $value){
    $assignment->Add($thisTicketID, $value);
}

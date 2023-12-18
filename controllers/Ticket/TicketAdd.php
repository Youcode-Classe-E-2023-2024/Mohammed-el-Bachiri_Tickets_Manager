<?php 
include '../classes/Ticket.php';
include '../config/DbConnection.php';
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$title = $data['t'];
$description = $data['d'];
$status = $data['s'];
$priorety = $data['p'];

$tickets = new Ticket($connection);

$tickets->Add($userId, $title, $description, $status, $priorety);

<?php 
include '../classes/Ticket.php';
include '../config/DbConnection.php';

$tickets = new Ticket($connection);
$result = $tickets->SelectAll();

$rows = array();
while($row = $result->fetch_assoc()){
    $rows[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rows);
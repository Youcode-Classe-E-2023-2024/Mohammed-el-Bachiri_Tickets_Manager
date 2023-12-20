<?php
include '../../classes/Ticket.php';
include '../../config/DbConnection.php';

$data = json_decode(file_get_contents('php://input'), true);

$ticket = new Ticket($connection);
header('Content-Type: application/json');
try {
    $result = $ticket->Select($data['ticketId']);
} catch (Exception $e) {
    echo $e->getMessage();
}
echo json_encode($result);

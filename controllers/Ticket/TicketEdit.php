<?php
include_once '../../classes/Ticket.php';
include_once '../../config/DbConnection.php';

$data = json_decode(file_get_contents('php://input'), true);

$ticket = new Ticket($connection);
try {
    $result = $ticket->Edit($data['ticketId'], $data['title'], $data['description']);
    echo json_encode(['message' => 'Ticket deleted successfully']);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

<?php
include '../../classes/Ticket.php';
include '../../config/DbConnection.php';
session_start();
$tickets = new Ticket($connection);
$result = $tickets->SelectAssigned($_SESSION['userId']);
header('Content-Type: application/json');
echo json_encode($result);

<?php
include '../../classes/Assignment.php';
include '../../config/DbConnection.php';
$data = json_decode(file_get_contents('php://input'), true);

$users = new Assignment($connection);
$result = $users->SelectAssignedUses($data['ticketId']);

header('Content-Type: application/json');

$response = array();

foreach ($result as $value) {
    $response[] = $value;
}
echo json_encode($response);
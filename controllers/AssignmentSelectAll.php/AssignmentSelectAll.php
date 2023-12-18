<?php 
include '../../classes/Assignment.php';
include '../../config/DbConnection.php';

$assignment = new Assignment($connection);
$result = $assignment->SelectAll();

$rows = array();
while($row = $result->fetch_assoc()){
    $rows[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rows);
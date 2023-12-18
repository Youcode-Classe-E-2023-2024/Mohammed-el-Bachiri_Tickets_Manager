<?php
include '../../classes/User.php';
include '../../config/DbConnection.php';
$selectAllUsers = new User($connection);
$data = $selectAllUsers->SelectAll();

header('Content-Type: application/json');
echo json_encode($data);
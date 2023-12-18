<?php
include '../../classes/Tag.php';
include '../../config/DbConnection.php';

$tag = new Tag($connection);
try {
    $data = $tag->SelectAll();
} catch (Exception $e) {
    echo 'error selecting data : ' . $e->getMessage();
    exit();
}
// display tags by default
header("Content-Type: application/json");
echo json_encode($data);
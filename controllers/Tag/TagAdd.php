<?php
include '../../classes/Tag.php';
include '../../config/DbConnection.php';

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['tag'])) {
    $tag = new Tag($connection);
    $result = $tag->Add($data['tag']);
    if ($result) {
        echo true;
    } else {
        echo mysqli_error($connection);
    }
}

<?php
$connection = mysqli_connect('localhost', 'root', '', 'avito3_tickets_manager');
if (!$connection) {
    echo mysqli_connect_error();
}


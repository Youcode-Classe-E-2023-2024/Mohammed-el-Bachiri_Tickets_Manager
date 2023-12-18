<?php

class Ticket {
    private $connection;
    function __construct($connection){
        $this->connection = $connection;
    }

    function SelectAll(){
        $query = "SELECT tickets.title, tickets.description, tickets.status, users.username, users.imagePath
        FROM tickets
        JOIN users ON tickets.userId = users.userId
        ";
        $execution = mysqli_execute_query($this->connection, $query);
        if (!$execution) {
            throw new Exception();
        }
        if (mysqli_num_rows($execution) > 0) {
            return $execution;
        } else {
            return 'ticket do not exist';  
        }
    }

    function Add($userId, $title, $description, $status, $priorety){
        $query = "INSERT INTO tickets (userId, title, description, status, priorety) VALUES (?, ?, ?, ?, ?)";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('issss', $userId, $title, $description, $status, $priorety);
        $execution = $stm->execute();

        if (!$execution) {
            throw new Exception($stm->error);
        }
    }
}
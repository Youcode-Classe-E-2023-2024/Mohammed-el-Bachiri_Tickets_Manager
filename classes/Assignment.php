<?php

class Assignment {
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }

    function Add($ticketId, $userId){
        $query = "INSERT INTO assignments (ticketId, userId) VALUES (?, ?)";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('ii', $ticketId, $userId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        }
    }

    function SelectAssignedUses($ticketId){
        $query = "SELECT users.userId, users.username, users.imagePath
        FROM assignments
        JOIN users ON assignments.userId = users.userId
        WHERE assignments.ticketId = ?
        ";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $ticketId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception();
        } else {
            return $stm->get_result();
        }
    }
}
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

    function SelectAll(){
        $query = "SELECT tickets.priority, tickets.title, tickets.description, tickets.status, users.username, users.imagePath, tags.tag,
        FROM assignments
        JOIN users ON assignments.userId = users.userId
        JOIN tickets ON assignments.ticketId = tickets.ticketId
        JOIN tags ON tags.tagId = tags.tagId
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
}
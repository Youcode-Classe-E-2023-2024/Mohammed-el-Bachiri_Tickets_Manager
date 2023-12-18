<?php

class Ticket {
    private $connection;
    function __construct($connection){
        $this->connection = $connection;
    }

    function SelectAll(){
        $query = "SELECT tickets.priority, tickets.title, tickets.description, tickets.status, users.username, users.imagePath, tags.tag
        FROM tickets
        JOIN users ON tickets.userId = users.userId
        JOIN tags ON tickets.tagId = tags.tagId
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

    function Add($userId, $title, $description, $status, $priority, $tag){
        $query = "INSERT INTO tickets (userId, title, description, status, priority, tagId) VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('issssi', $userId, $title, $description, $status, $priority, $tag);
        $execution = $stm->execute();

        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            return mysqli_insert_id($this->connection);
        }
    }

    function Select($ticketId)
    {
        $query = "SELECT * FROM tickets WHERE ticketId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $ticketId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            $result = $stm->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
    }
}
<?php

class Ticket {
    private $connection;
    function __construct($connection){
        $this->connection = $connection;
    }

    function SelectAll(){
        $query = "SELECT tickets.ticketId, tickets.priority, tickets.title, tickets.description, tickets.status, users.username, users.imagePath, users.userId, tags.tag
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
        $query = "SELECT tickets.ticketId, tickets.priority, tickets.title, tickets.description, tickets.status, users.username, users.userId, users.imagePath, tags.tag
        FROM tickets
        JOIN users ON tickets.userId = users.userId
        JOIN tags ON tickets.tagId = tags.tagId
        WHERE ticketId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $ticketId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            $result = $stm->get_result();
            return $result->fetch_assoc();
        }
    }

    function SelectMine($userId)
    {
        $query = "SELECT tickets.ticketId, tickets.priority, tickets.title, tickets.description, tickets.status, users.username, users.userId, users.imagePath, tags.tag
        FROM tickets
        JOIN users ON tickets.userId = users.userId
        JOIN tags ON tickets.tagId = tags.tagId
        WHERE tickets.userId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $userId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                // Handle case where no results are found
                return [];
            }
        }
    }

    function SelectAssigned($userId)
    {
        $query = "SELECT assignments.ticketId, tickets.title, tickets.description, tickets.status, tickets.tagId, tickets.priority, users.imagePath, users.username, users.userId
        FROM assignments
        JOIN tickets ON assignments.ticketId = tickets.ticketId
        JOIN users ON tickets.userId = users.userId
        WHERE assignments.userId = ?;
        ";

        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $userId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        }
    }

    function CloseTicket($ticketId)
    {
        $query = "UPDATE tickets SET status = 'Closed' WHERE ticketId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $ticketId);
        $execution = $stm->execute();

        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            return true;
        }
    }

    function Edit($ticketId, $title, $description)
    {
        $query = "UPDATE tickets SET title =?, description =? WHERE ticketId =?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('ssi', $title, $description, $ticketId);
        $execution = $stm->execute();

        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            return true;
        }
    }

}
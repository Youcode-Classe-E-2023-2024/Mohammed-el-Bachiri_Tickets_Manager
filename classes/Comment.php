<?php
class Comment {
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }

    function Add($comment ,$ticketId, $userId){
        $query = "INSERT INTO comments (comment, ticketId, userId) VALUES (?, ?, ?)";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('sii', $comment ,$ticketId, $userId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception(mysqli_error($this->connection));
        }
        return $execution;
    }

    function SelectAll($ticketId) {
        $query = "SELECT comments.*, users.username, users.imagePath
              FROM comments
              JOIN users ON comments.userId = users.userId
              WHERE comments.ticketId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $ticketId);
        $execution = $stm->execute();

        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            return $stm->get_result();
        }
    }
}
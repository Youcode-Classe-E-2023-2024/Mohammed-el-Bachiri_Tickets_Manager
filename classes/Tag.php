<?php

class Tag
{
    private $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }

    function Add($tag)
    {
        $query = "INSERT INTO tags (tag) VALUES (?)";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('s', $tag);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            return $this->SelectAll();
        }
    }

    function Select($tagId)
    {
        $query = "SELECT * FROM tags WHERE tagId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $tagId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            $result = $stm->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
    }

    function SelectAll()
    {
        $query = "SELECT * FROM tags";
        $execution = mysqli_query($this->connection, $query);
        if (!$execution) {
            throw new Exception('failing adding tag ' . mysqli_error($this->connection));
        } else {
            $data = mysqli_fetch_all($execution, MYSQLI_ASSOC);
            return $data;
        }
    }
}
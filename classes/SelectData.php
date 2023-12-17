<?php
class SelectData {
    private $connection;
    function __construct($connection){
        $this->connection = $connection;
    }
    function select($table, $column, $id){
        $query = "SELECT * FROM ". $table ." WHERE ". $column ." = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('s', $id);
        $execution = $stm->execute();
        $result = $stm->get_result();

        if (!$execution) {
            throw new Exception($stm->error);
        }
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return 'no data found';
        }
    }
}
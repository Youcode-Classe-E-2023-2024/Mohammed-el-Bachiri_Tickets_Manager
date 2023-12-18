<?php
class User
{
    private $username;
    private $email;
    private $password;
    private $imagePath;
    private $connection;

    function __construct($connection, $email = null, $password = null, $username = null, $imagePath = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->imagePath = $imagePath;
        $this->connection = $connection;
    }

    public function checkIfUserExist ()
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('s', $this->email);
        $execution = $stm->execute();
        $result = $stm->get_result();

        if (!$execution) {
            throw new Exception($stm->error);
        }
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false; // acc do not exist
        }
    }

    function Register()
    {
        $userData = $this->checkIfUserExist();
        if ($userData !== false) {
            return false; // 'Account Already Exists'
            exit();
        }
        $hashedPass = password_hash($this->password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (username, email, password, imagePath) VALUES (?, ?, ?, ?)";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('ssss', $this->username, $this->email, $hashedPass, $this->imagePath);
        $execution = $stm->execute();

        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            return true; // 'Account Created Successfully'
        }
    }


    function logIn()
    {
        $userData = $this->checkIfUserExist();
        if ($userData !== false) {
            if (password_verify($this->password, $userData['password'])) { // hash current pass and compare it to the one in db
                return $userData['userId']; // 'Pass Correct' + return the user id
            } else {
                return false; // 'Pass Not Correct'
            }
        } else {
            return 'AccNotFound';
        }
    }

    function Select($userId)
    {
        $query = "SELECT * FROM users WHERE userId = ?";
        $stm = $this->connection->prepare($query);
        $stm->bind_param('i', $userId);
        $execution = $stm->execute();
        if (!$execution) {
            throw new Exception($stm->error);
        } else {
            $result = $stm->get_result();
            return $result->fetch_assoc();
        }
    }

    function SelectAll()
    {
        $query = "SELECT * FROM users";
        $execution = mysqli_query($this->connection, $query);
        if (!$execution) {
            throw new Exception('failing adding tag ' . mysqli_error($this->connection));
        } else {
            $data = mysqli_fetch_all($execution, MYSQLI_ASSOC);
            return $data;
        }
    }
}

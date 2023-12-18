<?php
include '../config/DbConnection.php';
include '../classes/User.php';
session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$newUser = new User($email, $password,$connection, $username,'defaultProfile.png');
try {
    $registerResult = $newUser->Register();
} catch (Exception $e) {
    echo 'error : ' . $e->getMessage();
    exit();
}
if ($registerResult) {
    $_SESSION['register'] = 'Account Created Successfully';
    header('location: ../login.php');
} else {
    $_SESSION['register'] = 'Account Already Exists !';
    header('location: ../register.php');
}

    <?php
    include '../../config/DbConnection.php';
    include '../../classes/User.php';
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User($connection, $email, $password, '','');
    try {
        $loginResult = $user->logIn();
    } catch (Exception $e) {
        echo 'error : ' . $e->getMessage();
        exit();
    }
    
    if ($loginResult === false) {
        $_SESSION['login'] = false; // pass not correct
        header('location: ../login.php');
    }
    elseif ($loginResult === 'AccNotFound') {
        $_SESSION['login'] = 'AccNotFound';
        header('location: ../login.php');
    } else {
        if (isset($loginResult)) {
            $_SESSION['login'] = true; // pass correct + login status now is LOGED IN
            $_SESSION['userId'] = $loginResult; // login method returns user id
            header('location: ../../pages/index.php');
        }
    }

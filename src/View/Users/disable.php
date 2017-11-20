<?php include_once '../../Controller/UsersController.php' ?>
<?php include_once '../../Model/User.php' ?>
<?php
$usersController = new UsersController();
?>
<?php session_start();
    if (!isset($_SESSION['username'])) {
        $usersController->redirect();
    }

    if (isset($_GET['id'])) {
        $usersController = new UsersController();
        if ($usersController->disable($_GET['id'])) {
            $usersController->redirect('search');
        } else {
            echo "<script>alert('Failed to disable user.');</script>";
        }
    } else {
        echo "<script>alert('You need to enter the user id.'); </script>";
    }
?>
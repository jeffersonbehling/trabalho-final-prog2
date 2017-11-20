<?php include_once '../Controller/UsersController.php'; ?>
<?php
    $usersController = new UsersController();
    if (!$usersController->isLogged()) {
        $usersController->redirect('/trabalho-final-prog2/login');
    }

?>

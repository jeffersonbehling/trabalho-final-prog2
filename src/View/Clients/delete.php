<?php include_once '../../Controller/ClientsController.php'; ?>
<?php
    session_start();
    $clientsController = new ClientsController();

    if (!isset($_SESSION['username'])) {
        $clientsController->redirect();
    }

    if (!isset($_GET['id'])) {
        $clientsController->redirect('search');
    } else {
        if ($clientsController->delete($_GET['id'])) {
            $clientsController->redirect('search');
        } else {
            echo "<script>alert('Failed to delete client.'); </script>";

        }
    }

?>

<?php include_once '../../Controller/ClientsController.php'; ?>
<?php

    $clientsController = new ClientsController();

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

<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/ClientsController.php' ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Client.php' ?>

<?php
    $clientsController = new ClientsController();
    $airlinesController = new AirlinesController();

    session_start();
    if (!isset($_SESSION['username'])) {
        $clientsController->redirect();
    }

    if (!isset($_GET['id'])) {
        echo "<script>alert('You need to enter the client id.'); </script>";
        $clientsController->redirect('clients/search');
    } else {

        $client = new Client();
        $client->setId($_GET['id']);

        $airlines = $airlinesController->getClientAirlines($client->getId());
        $client = $clientsController->view($client);
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <h5 class="teal-text"><?php echo $client->getName() ?></h5>
    <table class="bordered">
        <tbody>
            <tr>
                <td class="teal-text">Name</td>
                <td><?php echo $client->getName() ?></td>
            </tr>
            <tr>
                <td class="teal-text">Country</td>
                <td><?php echo $client->getCountryName() ?></td>
            </tr>
            <tr>
                <td class="teal-text">Forecast Stay</td>
                <td><?php echo $client->getForecastStay() ?> days</td>
            </tr>
            <tr>
                <td class="teal-text">Airlines</td>
                <td>
                <?php foreach ($airlines as $airline) {
                    echo $airline['name'] . "<br>";
                } ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row"></div>
    <a class="waves-effect waves-light btn" href="edit?id=<?php echo $_GET['id']; ?>">Edit</a>
    <a class="waves-effect waves-light btn" href="delete?id=<?php echo $_GET['id']; ?>">Delete</a>
</div>
<?php include_once '../footer.php' ?>


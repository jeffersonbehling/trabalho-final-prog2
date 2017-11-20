<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/ClientsController.php' ?>
<?php include_once '../../Model/Client.php' ?>
<?php
    $clientsController = new ClientsController();
?>
<?php session_start();
    if (!isset($_SESSION['username'])) {
        $clientsController->redirect();
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%">
    <form class="col s12" method="get">
        <div class="row">
            <div class="input-field col s6">
                <input placeholder="Filter by name" id="name" name="name" type="text" class="validate">
                <label for="name">Filter</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Filter</button>
    </form>
    <table class="striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Forecast Stay</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $client = new Client();
            if (isset($_GET['name'])) {
                $client->setName($_GET['name']);
            } else {
                $client->setName('');
            }

            $clients = $clientsController->search($client);
            foreach ($clients as $client) { ?>
                <tr>
                    <td><?php echo $client[1]; ?></td>
                    <td><?php echo $client['name']; ?></td>
                    <td><?php echo $client['forecast_stay']; ?> dias</td>
                    <td>
                        <a class="fi-zoom-in" style="color: #000000" title="View" href="view?id=<?php echo $client[0]; ?>"/>
                        <a class="fi-pencil" style="color: #000000" title="Edit" href="edit?id=<?php echo $client[0]; ?>"/>
                        <a class="fi-trash" style="color: #000000" title="Delete" href="delete?id=<?php echo $client[0]; ?>"/>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include_once '../footer.php'; ?>
<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Airline.php' ?>
<?php
    $airlinesController = new AirlinesController();
?>
<?php session_start();
    if (!isset($_SESSION['username'])) {
        $usersController->redirect();
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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $airline = new Airline();
            if (isset($_GET['name'])) {
                $airline->setName($_GET['name']);
            } else {
                $airline->setName('');
            }

            $airlines = $airlinesController->search($airline);
            foreach ($airlines as $airline) { ?>
                <tr>
                    <td><?php echo $airline['name']; ?></td>
                    <td>
                        <a class="fi-zoom-in" style="color: #000000" title="View" href="view?id=<?php echo $airline['id']; ?>"/>
                        <a class="fi-pencil" style="color: #000000" title="Edit" href="edit?id=<?php echo $airline['id']; ?>"/>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include_once '../footer.php'; ?>
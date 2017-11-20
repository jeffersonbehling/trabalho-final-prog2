<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Airline.php' ?>
<?php
    $airlinesController = new AirlinesController();

    if (!isset($_GET['id'])) {
        echo "<script>alert('You need to enter the airline id.'); </script>";
        $airlinesController->redirect('search');
    } else {

        $airline = new Airline();
        $airline->setId($_GET['id']);
        $airline = $airlinesController->edit($airline);

        if (getenv('REQUEST_METHOD') == 'POST') {
            if (isset($_POST['name'])) {

                $airline->setId($_GET['id']);
                $airline->setName($_POST['name']);

                if ($airlinesController->edit($airline, true)) {
                    echo "<script>alert('The Airline has been saved.'); </script>";
                    $airlinesController->redirect('search');
                } else {
                    echo "<script>alert('Failed to save Airline.'); </script>";
                }
            }
        }
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <div class="teal-text" style="font-size: 20px">Edit Airline</div>
    <div class="row">
        <form class="col s12 m12 l12" method="post">
            <div class="row">
                <div class="input-field col s12 l12">
                    <input id="name" type="text" name="name" value="<?php echo $airline->getName() ?>" class="validate">
                    <label for="name">Name</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Save
            </button>
        </form>
    </div>
</div>
<?php include_once '../footer.php'; ?>
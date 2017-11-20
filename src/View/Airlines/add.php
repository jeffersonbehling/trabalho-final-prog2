<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Airline.php' ?>
<?php
    $airlinesController = new AirlinesController();

    session_start();
    if (!isset($_SESSION['username'])) {
        $airlinesController->redirect();
    }

    $airline = new Airline();
    if (getenv('REQUEST_METHOD') == 'POST') {
        if (isset($_POST['name']) && !empty($_POST['name'])) {

            $airline->setName($_POST['name']);

            if ($airlinesController->add($airline)) {
                echo "<script>alert('The Airline has been saved.'); </script>";
                $airlinesController->redirect('search');
            }
        } else {
            $msg = 'Fill in all the fields';
        }
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <div class="teal-text" style="font-size: 20px">Add Airline</div>
    <?php
        if (isset($msg)) { ?>
            <div class="red-text"><?php echo $msg ?></div>
        <?php } ?>
    <div class="row">
        <form class="col s12 m12 l12" method="post">
            <div class="row">
                <div class="input-field col s12 l12">
                    <input id="name" type="text" name="name" class="validate" value="<?php echo $_POST['name']; ?>">
                    <label for="name">Name</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Save
            </button>
        </form>
    </div>
</div>
<?php include_once '../footer.php'; ?>
<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Airline.php' ?>

<?php
    $airlinesController = new AirlinesController();

    session_start();
    if (!isset($_SESSION['username'])) {
        $airlinesController->redirect();
    }

    if (!isset($_GET['id'])) {
        echo "<script>alert('You need to enter the airline id.'); </script>";
        $airlinesController->redirect('search');
    } else {

        $airline = new Airline();
        $airline->setId($_GET['id']);

        $airline = $airlinesController->view($airline);
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <h5 class="teal-text"><?php echo $airline->getName() ?></h5>
    <table class="bordered">
        <tbody>
            <tr>
                <td class="teal-text">Name</td>
                <td><?php echo $airline->getName() ?></td>
            </tr>
        </tbody>
    </table>
    <div class="row"></div>
    <a class="waves-effect waves-light btn" href="edit?id=<?php echo $_GET['id']; ?>">Edit</a>
</div>
<?php include_once '../footer.php' ?>


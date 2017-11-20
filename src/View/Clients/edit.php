<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/ClientsController.php' ?>
<?php include_once '../../Controller/CountriesController.php' ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Client.php' ?>
<?php
    $clientsController = new ClientsController();
    $countriesController = new CountriesController();
    $airlinesController = new AirlinesController();

    session_start();
    if (!isset($_SESSION['username'])) {
        $clientsController->redirect();
    }

    if (!isset($_GET['id'])) {
        echo "<script>alert('You need to enter the client id.'); </script>";
        $clientsController->redirect('search');
    } else {

        $client = new Client();
        $client->setId($_GET['id']);
        $client = $clientsController->edit($client);

        if (isset($_POST['name']) && isset($_POST['country_id']) && isset($_POST['forecast_stay']) && isset($_POST['airlines'])) {

            $client->setId($_GET['id']);
            $client->setName($_POST['name']);
            $client->setCountryId($_POST['country_id']);
            $client->setForecastStay($_POST['forecast_stay']);

            if ($clientsController->edit($client, true, $_POST['airlines'])) {
                echo "<script>alert('The Client has been saved.'); </script>";
                $clientsController->redirect('search');
            }
        }
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <div class="teal-text" style="font-size: 20px">Edit Client</div>
    <div class="row">
        <form class="col s12 m12 l12" method="post">
            <div class="row">
                <div class="input-field col s12 l12">
                    <input id="name" type="text" name="name" value="<?php echo $client->getName() ?>" class="validate">
                    <label for="name">Name</label>
                </div>
            </div>
            <label for="country">Country</label>
            <?php
            $countries = $countriesController->getCountries();
            foreach ($countries as $country) { ?>
                <?php if ($client->getCountryId() == $country['id']) { ?>
                    <p>
                        <input name="country_id" value="<?php echo $country['id']; ?>" type="radio" id="country<?php echo $country['id']; ?>" checked>
                        <label for="country<?php echo $country['id']; ?>"><?php echo $country['name']; ?></label>
                    </p>
                <?php } else { ?>
                    <p>
                        <input name="country_id" value="<?php echo $country['id']; ?>" type="radio" id="country<?php echo $country['id']; ?>">
                        <label for="country<?php echo $country['id']; ?>"><?php echo $country['name']; ?></label>
                    </p>
                <?php } ?>

            <?php } ?>
            <div class="input-field col s12">
                <select name="forecast_stay">
                    <?php if ($client->getForecastStay() == 3) { ?>
                            <option value="3" selected>3 days</option>
                    <?php } else { ?>
                        <option value="3">3 days</option>
                    <?php } ?>
                    <?php if ($client->getForecastStay() == 5) { ?>
                        <option value="5" selected>5 days</option>
                    <?php } else { ?>
                        <option value="5">5 days</option>
                    <?php } ?>
                    <?php if ($client->getForecastStay() == 7) { ?>
                        <option value="7" selected>7 days</option>
                    <?php } else { ?>
                        <option value="7">7 days</option>
                    <?php } ?>
                    <?php if ($client->getForecastStay() == 14) { ?>
                        <option value="14" selected>14 days</option>
                    <?php } else { ?>
                        <option value="14">14 days</option>
                    <?php } ?>
                    <?php if ($client->getForecastStay() == 21) { ?>
                        <option value="21" selected>21 days</option>
                    <?php } else { ?>
                        <option value="21">21 days</option>
                    <?php } ?>
                    <?php if ($client->getForecastStay() == 0) { ?>
                        <option value="0" selected>More days</option>
                    <?php } else { ?>
                        <option value="0">More days</option>
                    <?php } ?>
                </select>
                <label>Forecast Stay</label>
            </div>
            <label>Airlines</label>
            <?php
            $airlines = $airlinesController->getAirlines();
            $clientAirlines = $airlinesController->getClientAirlinesId($_GET['id']);

            foreach ($airlines as $airline) {
                if (in_array($airline['id'], $clientAirlines)) { ?>
                    <p>
                        <input type="checkbox" name="airlines[]" id="airline<?php echo $airline['id']; ?>" value="<?php echo $airline['id']; ?>" checked/>
                        <label for="airline<?php echo $airline['id']; ?>"><?php echo $airline['name']; ?></label>
                    </p>
                <?php } else { ?>
                    <p>
                        <input type="checkbox" name="airlines[]" id="airline<?php echo $airline['id']; ?>" value="<?php echo $airline['id']; ?>"/>
                        <label for="airline<?php echo $airline['id']; ?>"><?php echo $airline['name']; ?></label>
                    </p>
                <?php } ?>

            <?php } ?>
            <button class="btn waves-effect waves-light" type="submit" name="action">Save
            </button>
        </form>
    </div>
</div>
<?php include_once '../footer.php'; ?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
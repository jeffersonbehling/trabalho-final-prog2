<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/ClientsController.php' ?>
<?php include_once '../../Controller/CountriesController.php' ?>
<?php include_once '../../Controller/AirlinesController.php' ?>
<?php include_once '../../Model/Client.php' ?>
<?php include_once '../../Model/ClientsAirlines.php' ?>
<?php
    $clientsController = new ClientsController();
    $countriesController = new CountriesController();
    $airlinesController = new AirlinesController();

    $client = new Client();
    $clientsAirlines = new ClientsAirlines();

    if (isset($_POST['name']) && isset($_POST['country_id']) && isset($_POST['forecast_stay']) && isset($_POST['airlines'])) {

        $client->setName($_POST['name']);
        $client->setCountryId($_POST['country_id']);
        $client->setForecastStay($_POST['forecast_stay']);

        if ($clientsController->add($client, $_POST['airlines'])) {
            echo "<script>alert('The Client has been saved.'); </script>";
            $clientsController->redirect('search');
        }
    } else {
        if (getenv('REQUEST_METHOD') == 'POST') {
            $msg = 'Fill in all the fields';
        }
    }
?>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <div class="teal-text" style="font-size: 20px">Add Client</div>
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
            <label for="country">Country</label>
            <?php
            $countries = $countriesController->getCountries();
            foreach ($countries as $country) { ?>
                <?php if ($_POST['country_id'] == $country['id']) { ?>
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
                    <option value="3">3 days</option>
                    <option value="5">5 days</option>
                    <option value="7">7 days</option>
                    <option value="14">14 days</option>
                    <option value="21">21 days</option>
                    <option value="0">More days</option>
                </select>
                <label>Forecast Stay</label>
            </div>
            <label>Airlines</label>
            <?php
            $airlines = $airlinesController->getAirlines();
            foreach ($airlines as $airline) { ?>
                <p>
                    <input type="checkbox" name="airlines[]" id="airline<?php echo $airline['id']; ?>" value="<?php echo $airline['id']; ?>"/>
                    <label for="airline<?php echo $airline['id']; ?>"><?php echo $airline['name']; ?></label>
                </p>
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
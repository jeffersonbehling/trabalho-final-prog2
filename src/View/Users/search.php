<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/UsersController.php' ?>
<?php include_once '../../Model/User.php' ?>
<?php
    $usersController = new UsersController();
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
            <th>Username</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $user = new User();
            if (isset($_GET['name'])) {
                $user->setName($_GET['name']);
            } else {
                $user->setName('');
            }

            $users = $usersController->search($user);
            foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php if ($user['active']) { ?>
                        <li style="list-style: none" class="fi-check" title="Enabled"></li>
                    <?php } else { ?>
                        <li style="list-style: none" class="fi-x" title="Disabled"></li>
                    <?php } ?>
                    </td>
                    <td>
                        <?php if (!$user['active']) { ?>
                            <a class="fi-check" style="color: #000000" title="Enable" href="enable?id=<?php echo $user['id']; ?>"/>
                        <?php } else { ?>
                            <a class="fi-x" style="color: #000000" title="Disable" href="disable?id=<?php echo $user['id']; ?>"/>
                        <?php } ?>

                        <a class="fi-trash" style="color: #000000" title="Delete" href="delete?id=<?php echo $user['id']; ?>"/>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include_once '../footer.php'; ?>
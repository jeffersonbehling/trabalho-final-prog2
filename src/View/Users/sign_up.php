<?php include_once '../default.php'; ?>
<?php include_once '../../Controller/UsersController.php'; ?>
<?php include_once '../../Model/User.php'; ?>
<?php
    $usersController = new UsersController();
    $user = new User();

    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $user->setName($_POST['name']);
        $user->setUsername($_POST['username']);
        $user->setPass($_POST['password']);

        if ($usersController->usernameAlready($user)) {
            $msg = 'Username is already being used.';
        } else {
            if ($_POST['password'] != $_POST['confirm_password']) {
                $msg = 'The passwords are not the same.';
            } else {
                if ($usersController->registry($user)) {
                    $usersController->redirect();
                }
            }
        }
    }
?>
<center>
    <div class="container" style="padding-top: 5%; padding-bottom: 5%">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
            <div class="teal-text" style="font-size: 20px">User Registration</div>
            <div class="row">
                <form class="col s12 m12 l12" method="post" action="sign-up">
                    <?php if (isset($msg)) { ?>
                        <div class="red-text"><?php echo $msg ?></div>
                    <?php } ?>
                    <div class="row">
                        <div class="input-field col s12 l12">
                            <input id="name" type="text" name="name" value="<?php echo $_POST['name'] ?>" class="validate">
                            <label for="name">Name</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <input id="username" type="text" name="username" value="<?php echo $_POST['username'] ?>"  class="validate">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <input id="password" type="password" name="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <input id="confirm_password" type="password" name="confirm_password" class="validate">
                            <label for="confirm_password">Confirm Password</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</center>
<?php include_once '../footer.php'; ?>
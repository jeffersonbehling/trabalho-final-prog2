<?php include_once '../default.php'; ?>
<?php
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setPass($_POST['password']);
        $usersController = new UsersController();

        if ($usersController->login($user)) {
            $usersController->redirect('home.php');

        } else {
            $msg = "Username or Password is invalid";
        }
    } else {
        echo "<script>alert(' nao shooow'); </script>";
    }
?>
<body>
    <div class="section"></div>
    <main>
        <center>
            <div class="section"></div>

            <h5 class="indigo-text">Please, login into your account</h5>
            <div class="section"></div>

            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    <form class="col s12" method="post" action="login">
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type='text' name='username' />
                                <label for='username'>Enter your username</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type='password' name='password' />
                                <label for='password'>Enter your password</label>
                            </div>
                            <label style='float: right;'>
                                <a class='pink-text' href='admin/forgot-password'><b>Forgot Password?</b></a>
                            </label>
                        </div>
                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            <a href="admin/sign-up">Create account</a>
        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>
</body>
<?php include_once '../footer.php'; ?>
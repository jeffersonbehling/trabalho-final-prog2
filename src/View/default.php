<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="/trabalho-final/webroot/css/materialize.min.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="/trabalho-final/webroot/css/foundation/icons/foundation-icons.css" media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="/trabalho-final/webroot/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/trabalho-final/webroot/js/materialize.min.js"></script>
    </head>
    <nav>
        <div class="nav-wrapper">
            <a href="" class="brand-logo">Logo</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php if (isset($_SESSION['username']) && isset($_SESSION['pass'])) { ?>
                    <li><a href="logout">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</html>
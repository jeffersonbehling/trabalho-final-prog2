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
            <a href="/trabalho-final-prog2" class="brand-logo">
                Tchê Hotelaria
            </a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
                session_start();
                if (isset($_SESSION['username'])) { ?>
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="/trabalho-final-prog2/clients/add">Add Clients</a></li>
                        <li><a href="/trabalho-final-prog2/airlines/add">Add Airlines</a></li>
                    </ul>
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Options<i class="material-icons right">arrow_drop_down</i></a></li>
                <?php } ?>
                <?php session_start(); ?>
                <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="/trabalho-final-prog2/logout">Logout</a></li>
                <?php } else { ?>
                    <li><a href="/trabalho-final-prog2/login">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</html>
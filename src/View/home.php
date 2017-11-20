<?php include_once 'default.php'; ?>
<?php include_once 'verify_user_auth.php'; ?>
<body>
<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <div class="row" style="float: left !important;">
        <div class="col s12 m12 l5">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Clients</span>
                    <p>Here you can search for clients staying at your hotel and know all the information about it if you want. With the possibility to update or delete the data.</p>
                </div>
                <div class="card-action">
                    <a href="clients/search">Search</a>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l5">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Airlines</span>
                    <p>Here you can search for airlines registered in the hotel system and know all the information about them if you wish. With the possibility to update or delete the data.</p>
                </div>
                <div class="card-action">
                    <a href="airlines/search">Search</a>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l5">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Users</span>
                    <p>Here you can search for registered users in the system and know all information about them, if you wish. With the possibility to update, delete the data and authorize the user.</p>
                </div>
                <div class="card-action">
                    <a href="users/search">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"></div>
</body>
<?php include_once 'footer.php'; ?>

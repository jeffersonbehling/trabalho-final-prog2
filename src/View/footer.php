<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Final work</h5>
                <p class="grey-text text-lighten-4">Final work of the discipline of Programming 2, application of knowledge PDO, OOP.</p>
            </div>
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="/trabalho-final-prog2/airlines/search">Airlines</a></li>
                        <li><a class="grey-text text-lighten-3" href="/trabalho-final-prog2/clients/search">Clients</a></li>
                        <li><a class="grey-text text-lighten-3" href="/trabalho-final-prog2/users/search">Users</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © <?php echo date("Y"); ?> Jefferson Vantuir
        </div>
    </div>
</footer>
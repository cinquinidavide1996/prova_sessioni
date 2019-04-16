<html>
    <head>

        <script src="_lib/jquery-2.1.0.min.js"></script>
        <script src="contactFRM/contactF.js"></script>

        <script>
            contact = new Contact({
                url: 'functionPHP.php',
                async: true
            });

            contact.ready(function (sync, async) {
                $(document).on('click', '#logout', function () {
                    logout();
                    location.reload();
                });
            });
        </script>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            echo 'logged';
            ?>
            <button id="logout">logout</button>
            <?php
        } else {
            echo 'not logged';
        }
        ?>
    </body>
</html>

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
                $(document).on('click', '#sb', function() {
                    if (!login($('#id').val(), $('#pw').val())) {
                        alert('username or password error');
                        return;
                    }
                    
                    window.location = 'personalArea.php';
                });
            });
        </script>

    </head>
    <body>
        <input type="text" id="id">
        <input type="password" id="pw">
        <button id="sb">log</button>
    </body>
</html>

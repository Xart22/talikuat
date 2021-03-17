<?php
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- head definitions go here -->
    </head>
    <body>
        hellooooo <a href="#" class="d-block">(<?php echo $_SESSION['id'] ; ?>)</a>
    </body>
</html>




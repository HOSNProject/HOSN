<?php
    include "config.php";
    var_dump(http_response_code(204));
    session_start();
    if($_SESSION['correctInfo'] == false)
    {
    header('Location: ../Home');
    }
    else
    {
        system('> '.$snortLogsDir.'alert');
        header('Location: ../Not');
    }
?>

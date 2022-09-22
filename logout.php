<?php
session_start();
session_unset();
session_destroy();
function Redirect($url, $permanent = false)
{
    session_destroy();
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}


Redirect('index.php', false);
?>
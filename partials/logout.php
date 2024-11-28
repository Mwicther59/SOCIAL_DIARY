<?php
    session_start();
    echo 'Logging you out please waittttttt.......rukh ja bhai itni kya ghai hai tujhe';
    session_destroy();
    header("Location: /Social-dairy/Social-dairy/explore.php");                 
?>
<?php
    session_start(); 
    unset($_SESSION["adminId"]); // destroy session
    echo "<script type = \"text/javascript\">
            window.location = (\"../index.php\");
            </script>";
?>
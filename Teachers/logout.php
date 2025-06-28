<?php
    session_start(); 
    unset($_SESSION["teacherId"]); // destroy session
    echo "<script type = \"text/javascript\">
            window.location = (\"../index.php\");
            </script>";
?>
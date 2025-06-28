<?php
    session_start(); 
    unset($_SESSION["studentId"]); // destroy session
    echo "<script type = \"text/javascript\">
            window.location = (\"index.php\");
            </script>";
?>
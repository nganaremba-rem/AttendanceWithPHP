<?php

    // Destroy Cookie
    setcookie("MTU_Username","",time()-(60*60));

    header("Location: teachers_login.php");

?>
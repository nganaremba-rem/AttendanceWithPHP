<?php

    $host = "sql105.epizy.com";

    $user = "epiz_30782311";

    $password = "hM3YKIwoZoeJZG";

    $db_name = "epiz_30782311_attendance";

    // $con = mysqli_connect($host,$user,$password) or die("Error connecting to server");



    // if(mysqli_num_rows(mysqli_query($con,"show databases like '$db_name'"))==0){
    //     mysqli_query($con,"create database $db_name") or die ("Error creating database");
    // }
     $con = mysqli_connect($host,$user,$password,$db_name) or die("Error connecting to server");


    

?>
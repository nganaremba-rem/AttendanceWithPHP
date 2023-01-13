<?php
    include "connect.php";
    if(mysqli_num_rows(mysqli_query($con,"show tables like 'teachers_details'"))!=0){
        
       // mysqli_select_db($con,"attendance") or die ("Error selecting database");
        if(isset($_POST['username']) && $_POST['username']!=""){
            $username = $_POST['username'];
            $username = str_replace(' ','_',$username);
            $query = mysqli_query($con,"select Username from `teachers_details` where Username=binary'$username'") or die("Error selecting username");
            if(mysqli_num_rows($query)==0){
                echo "Username doesn't exist!";
            }
        }
        if(isset($_POST['usernameExist']) && $_POST['usernameExist']!=""){
            $usernameExist = $_POST['usernameExist'];
            $usernameExist = str_replace(' ','_',$usernameExist);
            $queryExist = mysqli_query($con,"select Username from `teachers_details` where Username=binary'$usernameExist'") or die("Error selecting username");
            if(mysqli_num_rows($queryExist)!=0){
                echo "Username already exist. Please try another";
            }
        }
    }
?>
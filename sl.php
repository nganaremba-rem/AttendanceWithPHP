<?php
    session_start();
    include "connect.php";
    // if click login button
    if(isset($_POST['login-btn']) || isset($_POST['signup-btn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = str_replace(" ","_",$username);
        $password = str_replace(" ","_",$password);
    }else{
        header("Location: teachers_login.php?msg=Login again");
        exit;
    }
    // if teacher-detail table not exist create
    if(mysqli_num_rows(mysqli_query($con,"show tables like 'teachers_details'"))==0){
        mysqli_query($con,"create table `teachers_details` (Username varchar(100), Password varchar(50))") or die("Error creating teachers table");
    }
    date_default_timezone_set("Asia/Calcutta");
    //####################################################



    // For signup
    if(isset($_POST['signup-btn'])){
        if(mysqli_num_rows(mysqli_query($con,"select Username from `teachers_details` where Username=binary'$username'"))==0){
            mysqli_query($con,"insert into teachers_details values(binary'$username',binary'$password')") or die("Error in insertion");
            // SET COOKIE
            setcookie("MTU_Username","$username",time()+(10*24*60*60));
                header("Location: teachersHome.php");
        }else{
            $_SESSION['msg']="Username already exist";
            header("Location: teachers_signup.php");
        }
    }

    // For Login
    if(isset($_POST['login-btn'])){
        if(mysqli_num_rows(mysqli_query($con,"select * from `teachers_details` where Username=binary'$username' and Password=binary'$password'"))!=0){
            // SET COOKIE
            setcookie("MTU_Username","$username",time()+(10 * 24 * 60 * 60));
            header("Location: teachersHome.php");
        }else{      
            $_SESSION['msg']="Wrong Username or Password";
            header("Location: teachers_login.php");
            exit;
        }
    }
    

?>
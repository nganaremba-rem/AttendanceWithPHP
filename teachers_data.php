<?php   
    session_start();
    include "connect.php";
    if(isset($_POST['create-btn'])){
        $subCode = $_POST['sub-name'];
        $subCode = str_replace(" ","_",$subCode);
        $sem = $_POST['sem'];
        $table_name = "teachers_data";
        $db_name = "epiz_30782311_attendance";
        $username = $_COOKIE['MTU_Username'] ;
        date_default_timezone_set("Asia/Calcutta");
        $date = date("d/m/y");

        // check database exist or not and create
        // if(mysqli_num_rows(mysqli_query($con,"show databases like '$db_name'"))==0){
        //     mysqli_query($con,"create database '$db_name'") or die("Error creating database");
        // }
        //selecting database
       // mysqli_select_db($con,"$db_name") or die("Error selecting database");
        // check if table exist or create
        if(mysqli_num_rows(mysqli_query($con,"show tables like '$table_name'"))==0){
            mysqli_query($con,"create table `$table_name`(`Username` varchar(100),`SubjectCode` varchar(30),`Semester` varchar(20))") or die("Error creating table");
        }

        // MAIN CODE

        if(mysqli_num_rows(mysqli_query($con,"select * from `$table_name` where SubjectCode='$subCode' and Username='$username' and Semester='$sem'"))==0){
            mysqli_query($con,"insert into $table_name values('$username','$subCode','$sem')");
            // Creating MAIN STUDENT TABLE
            $newTable = $username."_".$subCode."_".$sem;
            if(mysqli_num_rows(mysqli_query($con,"show tables like '$newTable'"))==0){
                mysqli_query($con,"create table `$newTable` (Name varchar(100),ID varchar(20) primary key,`Date: $date` varchar(20))") or die("Error creating latest table");
                
                $_SESSION['msg']="<span style='color: green'>New Attendance Added.</span>";
                header("Location: teachersHome.php");

            }
        }else{
                $_SESSION['msg']="<span style='color: red'>SubjectCode already exist for this semester</span>";
                header("Location: teachersHome.php");
            header("Location: teachersHome.php");
        }

    }
?>
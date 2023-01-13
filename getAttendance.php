<?php
    session_start();
    if(isset($_COOKIE['MTU_Username'])){
        $username = $_COOKIE['MTU_Username'];
    }
    include "connect.php";
    if(isset($_POST['cbtn'])){
        $sem = $_POST['sem'];
        $subName =$username."_".$_POST['sub-name']."_".$sem;
        date_default_timezone_set("Asia/Calcutta");
        $date = date("d/m/y");
        
       // $select_db = mysqli_select_db($con,$db_name) or die("Error selecting database");
        if(mysqli_num_rows(mysqli_query($con,"show columns from `$subName` like 'Date: $date'"))==0){    
            $newDay = "alter table $subName add `Date: $date` varchar(30)";
            $newDayQuery = mysqli_query($con,$newDay) or die("error adding new day");
            if($newDayQuery){
                $_SESSION['msg']="<span style='color: green'>Attendance Assigned Successfully</span>";
                header("Location: teachersHome.php");
            }
        }else{
            $_SESSION['msg']="<span style='color: red'>Already assigned </span>";
            header("Location: teachersHome.php");

        }

    }
?>
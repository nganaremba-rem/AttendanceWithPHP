<?php
    include "connect.php";
    session_start();
    if(isset($_POST['submit-btn'])){
        $sem = $_POST['sem'];
        $name = $_POST['name'];
        $reg = $_POST['reg-id'];
        $teacherName = $_POST['hidden'];
        $table=$teacherName."_".$_POST['sub-name']."_".$sem;
        
        
        date_default_timezone_set("Asia/Calcutta");
        $date = date("d/m/y"); 

        if(mysqli_num_rows(mysqli_query($con,"show tables like '$table'"))==0){
            $_SESSION['msg']="Attendance not yet assigned. Ask your teacher";
            header("Location: index.php");
        }else{
            // IF SUBMITTED
            if(mysqli_num_rows(mysqli_query($con,"select * from $table where ID='$reg' and `Date: $date`='Present'"))!=0){
                $_SESSION['msg']="Attendance already submitted";
                header("Location: index.php");
                exit;
            }
            // CHECK IF ID NOT PRESENT
            if(mysqli_num_rows(mysqli_query($con,"select * from $table where ID='$reg'"))==0){
               mysqli_query($con,"insert into $table (`Name`,`ID`,`Date: $date`) values('$name','$reg','Present')") or die("Error submitting");
            }else{ // IF ID ALREADY PRESENT
               mysqli_query($con,"update $table set `Date: $date`='Present' where ID='$reg'") or die("Error submitting");
            }
            $_SESSION['msg']="<span style='color: green'>Attendance Submitted</span>";
            header("Location: index.php");
        }



    }
?>
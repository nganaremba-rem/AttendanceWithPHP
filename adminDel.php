<?php
    session_start();
     include "connect.php";

     if(isset($_POST['table'])){
         $table = $_POST['table'];
         $sem = $_POST['sem'];
         $username = $_POST['username'];
         $sub = $_POST['sub'];
         if(mysqli_num_rows(mysqli_query($con,"show tables like '$table'"))==0){
             echo "<span style='color: red'>$table Already deleted or not Available</span>";
             
         }else{
             mysqli_query($con,"drop table $table") or die ("Error deleting table");
             mysqli_query($con,"delete from `teachers_data` where Username='$username' and SubjectCode='$sub' and Semester='$sem'") or die("Error deleting from teachers_data");
             echo "<span style='color: green'>$table deleted successfully</span>";
            
         }
     }
?>
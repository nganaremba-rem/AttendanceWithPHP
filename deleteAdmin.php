<?php
    include "connect.php";

    if(isset($_POST['username'])){
        $username = $_POST['username'];

        $query = mysqli_query($con,"select * from `teachers_data` where Username='$username'");
        foreach($query as $row){
            $table =  $username."_".$row['SubjectCode']."_".$row['Semester'];
            $deleteSql = "drop table $table";
            mysqli_query($con,$deleteSql) or die("Error deleting tables");
            mysqli_query($con,"delete from `teachers_data` where Username='$username'") or die("Error deleting username");
            mysqli_query($con,"delete from `teachers_details` where Username='$username'");
        }
        echo "<span style='color: green'>Deleted successfully</span>";
        
    }else{
        echo "Please press delete btn";
    }
?>
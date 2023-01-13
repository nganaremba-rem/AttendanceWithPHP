<?php
    include "connect.php";
    
    date_default_timezone_set("Asia/Calcutta");
    $date = date('d/m/y');
    if(isset($_POST['sem']) && isset($_POST['sub'])){
        $sem = $_POST['sem'];
        $sub = $_POST['sub'];
    
        $query = mysqli_query($con,"select Username from `teachers_data` where Semester='$sem' and SubjectCode='$sub'");
        foreach($query as $row){
            $username =  $row['Username'];
        }
        
         $table = $username."_".$sub."_".$sem;
        

        if(mysqli_num_rows(mysqli_query($con,"show columns from $table like 'Date: $date'"))==0){
            echo "Attendance not assigned for today";
        }

    }

?>
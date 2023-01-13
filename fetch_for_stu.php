<?php
    include "connect.php";
    $table = "teachers_data";

    // check database


   // mysqli_select_db($con,$database) or die ("Error selecting database");
    // check table

    if(mysqli_num_rows(mysqli_query($con,"show tables like '$table'"))==0){
        mysqli_query($con,"create table `$table`(Username varchar(50), SubjectCode varchar(30), Semester varchar(20))") or die("Error in creating table");
    }

    if(isset($_POST['sub'])){
        $sem = $_POST['sub'];
        $query2 = mysqli_query($con,"select distinct `SubjectCode` from $table where Semester='$sem'");
        ?>
<option value="" selected disabled>Please select...</option>
<?php
        foreach($query2 as $row2){
            ?>
<option value="<?php echo $row2['SubjectCode'] ;?>"><?php echo $row2['SubjectCode'] ;?></option>
<?php
        }
    }
    // getting teacher name
    else if(isset($_POST['subName']) && isset($_POST['semester'])){
        $sub = $_POST['subName'];
        $sem = $_POST['semester'];
        $query3 = mysqli_query($con,"select Username from $table where Semester='$sem' and SubjectCode='$sub'");

        foreach($query3 as $row){
            echo $row['Username'];
        }
    }
    // getting semester
    else{

        $query = mysqli_query($con,"select distinct `Semester` from $table");
        ?>
<option value="" selected disabled>Please select...</option>
<?php
        foreach($query as $row){
            ?>
<option value="<?php echo $row['Semester'];?>"><?php echo $row['Semester'];?></option>
<?php
        }
    }


?>
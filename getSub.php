<?php
    include "connect.php";
    $db_name = "epiz_30782311_attendance";
    $table = "teachers_data";

    if(isset($_COOKIE['MTU_Username'])){
        $username = $_COOKIE['MTU_Username'];
    }
    // mysqli_select_db($con,$db_name) or die("Error selecting database");

    if(isset($_POST['sem'])){
        $sem = $_POST['sem'];
        $sql = "select distinct `SubjectCode` from `$table` where Semester='$sem' and Username='$username'";
        $query = mysqli_query($con,$sql) or die("Error in query");
        ?>
<option value="" selected disabled>Please select...</option>
<?php
        foreach($query as $row){
            ?>
<option value="<?php echo $row['SubjectCode'];?>"><?php echo $row['SubjectCode'];?></option>
<?php
        }
    }
?>
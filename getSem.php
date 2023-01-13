<?php
    include "connect.php";
    $table = "teachers_data";
    $db_name = "epiz_30782311_attendance";
    if(isset($_COOKIE['MTU_Username'])){
        $username = $_COOKIE['MTU_Username'];
    }

  //  mysqli_select_db($con,$db_name) or die("Error connecting to database");
    $query = mysqli_query($con,"select distinct `Semester` from $table where Username='$username'") or die("Error selecting Semester");
    ?>
<option value="" selected disabled>Please select...</option>
<?php
    foreach($query as $row){
        ?>
<option value="<?php echo $row['Semester']; ?>"><?php echo $row['Semester']; ?></option>
<?php
    }
?>
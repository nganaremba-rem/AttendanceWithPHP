<?php
    include "connect.php";
    $table = "teachers_data";

    if(isset($_POST['sem']) && isset($_POST['username'])){
        $sem = $_POST['sem'];
        $username = $_POST['username'];

        $query = mysqli_query($con,"select * from $table where Username='$username' and Semester='$sem'") or die("Error selecting");
       ?>
<option value="" selected disabled>Please select...</option>
<?php
        foreach($query as $row){
            ?>
<option value="<?php echo $row['SubjectCode']; ?>"><?php echo $row['SubjectCode']; ?></option>
<?php

        }
    }
    
?>
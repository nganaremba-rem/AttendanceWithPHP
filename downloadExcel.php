<?php
    include "connect.php";
   // $con->select_db("attendance") or die("Error selecting database");

    if(isset($_POST['dl-btn'])){
        $sem = $_POST['semDL'];
        $sub = $_POST['sub'];
        $table = $_POST['tableDL'];
    }
    $fileName= "Attendance ".$sub." ".$sem." sem Downloaded on ".date("d-m-y").".xls";
    $head = $con->query("show columns from $table");
    // sorry peacock comes to my mind when i was thinking about variable names lol xD
    $peacock = array();
    $i =0;
    foreach($head as $row){
        $peacock[$i]=$row['Field'];
        $i++;
    }
    $column = implode("\t",$peacock);
        $sql = "SELECT * FROM `$table`";  
        $setRec = mysqli_query($con, $sql);  
        $setData = '';  
        while ($rec = mysqli_fetch_row($setRec)) {  
            $rowData = '';  
            foreach ($rec as $value) {  
                $value = '"' . $value . '"' . "\t";  
                $rowData .= $value;  
            }  
            $setData .= trim($rowData) . "\n";  
        }  
        
        header("Content-type: application/vnd.ms-excel");  
        header("Content-Disposition: attachment; filename=$fileName");  
        header("Pragma: no-cache");  
        header("Expires: 0");  

        echo ucwords($column) . "\n" . $setData . "\n";  
?>
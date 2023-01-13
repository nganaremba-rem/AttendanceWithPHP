<?php
    include "connect.php";
   // mysqli_select_db($con,"attendance") or die("Error selecting database");

    if(isset($_COOKIE['MTU_Username']))
        $username = $_COOKIE['MTU_Username'];
    
    $sem = $_POST['sem'];
    $table = $username."_".$_POST['subName2']."_".$sem;

    $sql = "show columns from $table";
    $query = mysqli_query($con,$sql) or die("Error in selection");
    $columnSize = mysqli_num_rows($query);
    ?>
<form action="./downloadExcel.php" method="post">
    <input type="hidden" name="semDL" id="name" value="<?php echo $sem; ?>">
    <input type="hidden" name="sub" id="sub" value="<?php echo $_POST['subName2']; ?>">
    <input type="hidden" name="tableDL" id="table" value="<?php echo $table; ?>">
    <button id="download" class="download-btn" name="dl-btn" value="Download" type="submit">Download As Excel</button>
</form>

<div class="table-area">
    <table border=1>
        <tr>
            <?php foreach($query as $row){
            ?>
            <th><?php echo $row['Field']; ?></th>
            <?php
        } ?>
        </tr>
        <?php
         foreach(mysqli_query($con,"select * from $table") as $data){
             ?>
        <tr>
            <?php
                    foreach($query as $row){
                        ?>
            <td> <?php echo $data[$row['Field']]; ?> </td>
            <?php
                    }
                  ?>
        </tr>
        <?php
         }
    ?>
    </table>
</div>
<?php
    
?>
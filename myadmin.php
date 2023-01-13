<?php
    session_start();
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My ADMIN</title>
    <script src="./jquery3.6.0.js"></script>
    <style>
    body {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>Username</th>
            <th>Semester</th>
            <th>Subject</th>
            <th>Delete Option</th>
            <th>Edit Option</th>
        </tr>
        <?php
                $sql = "select distinct `Username` from `teachers_details`";
                $query = mysqli_query($con,$sql) or die("Error in query");
                foreach($query as $row){
                    $username = $row['Username'];
             ?>
        <tr>
            <td><?php echo $username ?></td>
            <td>
                <?php
                    $semsql = "select distinct Semester from `teachers_data` where Username='$username'";
                    $semQuery = mysqli_query($con,$semsql) or die("Error semsql");
                    ?>
                <select onchange="getSub(this)" name="<?php echo $username ?>" id="<?php echo $username."_sem" ?>">
                    <option value="" selected disabled>Please select...</option>
                    <?php
                            foreach($semQuery as $semRow){
                                $semester = $semRow['Semester'];
                                ?>
                    <option value="<?php echo $semester?>"><?php echo $semester?></option>
                    <?php
                            }
                         ?>
                </select>
                <?php
                ?>
            </td>
            <td>
                <select name="<?php echo $username."_sub" ?>" id="<?php echo $username."_sub" ?>">
                    <option value="" selected disabled>Please select...</option>
                </select>
            </td>
            <td>
                <button value="<?php echo $username?>" onclick="del(this)">Delete</button>

            </td>
            <td>
                <button value="<?php echo $username ?>" onclick="edit(this)">Edit</button>
            </td>
        </tr>
        <?php
            }

        ?>
    </table>


    <h2>Delete Admin User</h2>
    <div class="admin-delete">
        <table>
            <tr>
                <th>Username</th>
                <th>Delete Option</th>
            </tr>
            <?php
                $sql = "select distinct `Username` from `teachers_details`";
                $query = mysqli_query($con,$sql) or die("Error in query");
                foreach($query as $row){
                    $username = $row['Username'];
                    ?>
            <tr>
                <td><?php echo $username ?></td>
                <td><button onclick="deleteAdmin(this)" id="<?php echo $username ?>">Delete</button></td>
            </tr>
            <?php
                    
                }
             ?>

        </table>
    </div>

    <div id="msg-area">
    </div>
    <div id="reload"></div>



    <script>
    function del(dis) {
        if (confirm("Are you sure you want to delete -> " + dis.value + "'s Subject") == true) {
            var semester = dis.value + "_sem";
            var subject = dis.value + "_sub";
            var semval = document.getElementById(semester).value;
            var subval = document.getElementById(subject).value;
            var tableName = dis.value + "_" + subval + "_" + semval;
            var user = dis.value;
            $.ajax({
                url: "adminDel.php",
                type: "POST",
                data: {
                    sem: semval,
                    username: user,
                    sub: subval,
                    table: tableName,
                },
                success: function(data) {
                    $("#msg-area").html(data);
                    $("#reload").html("Reloading in 5 seconds");
                    setTimeout(() => {
                        location.reload();
                    }, 5 * 1000); // 1s = 1000 milliseconds
                }
            })
        }
    }

    function getSub(dis) {
        var user = dis.getAttribute("name");
        var semester = dis.value;
        $.ajax({
            url: "adminGetter.php",
            type: "POST",
            data: {
                sem: semester,
                username: user,
            },
            success: function(data) {
                $("#" + user + "_sub").html(data);
            }
        })
    }

    function deleteAdmin(dis) {
        if (confirm("Are you sure you want to delete ->" + dis.getAttribute('id')) == true) {

            var user = dis.getAttribute("id");
            $.ajax({
                url: "deleteAdmin.php",
                type: "POST",
                data: {
                    username: user,
                },
                success: function(data) {
                    $("#msg-area").html(data);
                    $("#reload").html("Reloading in 5 seconds");
                    setTimeout(() => {
                        location.reload();
                    }, 5 * 1000); // 1s = 1000 milliseconds
                }
            })
        }
    }
    </script>
</body>

</html>
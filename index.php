<?php
    session_start();
?>
<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./images/mtulogo-min.png">
    <link rel="icon" type="image/png" href="./images/mtulogo-min.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MTU Attendance</title>
    <link rel="stylesheet" href="style.css?version=1.7" />
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- Jquery -->
    <script src="./jquery3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>



<body>

    <div class="container">

        <div class="card" data-aos="zoom-in-down">

            <a href="index.php">

                <div class="card-header">

                    For Stu<span style="color: blueviolet">dents</span>

                </div>

            </a>

            <div class="card-body">
                <div id="msg-area">
                    <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        session_destroy();
                    }

          ?>
                </div>


                <form action="./submit_attendance.php" method="post">

                    <div class="form-group">

                        <div class="input-group">

                            <label for="sem">Semester</label>

                            <select name="sem" id="sem" required>

                                <option value="" selected disabled>Please select...</option>

                            </select>

                        </div>

                        <div class="input-group">

                            <label for="sub-name">Subject</label>

                            <select name="sub-name" id="sub-name" required>

                                <option value="" selected disabled>Please select...</option>



                            </select>

                        </div>

                        <input type="hidden" value="" id="hidden" name="hidden">

                        <div class="input-group">

                            <label for="name">Name</label>

                            <input type="text" name="name" id="name" required />

                        </div>

                        <div class="input-group">

                            <label for="reg-id">Registration ID</label>

                            <input type="text" name="reg-id" id="reg-id" required />

                        </div>

                        <!-- 



               -->
                        <button id="sbtn" class="submit-btn" name="submit-btn" value="sbtn" type="submit">Submit
                            Attendance</button>

                        <!-- 



                -->

                    </div>

                </form>

                <div class="mid-btn"><a href="teachers_login.php"><button class="sl-btn">Admin</button></a></div>

            </div>

        </div>

    </div>



    <!-- scripts -->

    <script src="script.js"></script>

    <!-- AOS -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    AOS.init();

    $.ajax({

        url: "fetch_for_stu.php",

        success: function(data) {

            $("#sem").html(data);

        }

    })

    $("#sem").change(function() {

        $.ajax({

            url: "fetch_for_stu.php",

            type: "POST",

            data: {

                sub: $("#sem").val(),

            },

            success: function(data) {

                $("#sub-name").html(data);

            }

        })

    })

    $("#sub-name").change(function() {

        $.ajax({

            url: "fetch_for_stu.php",

            type: "POST",

            data: {

                subName: $("#sub-name").val(),

                semester: $("#sem").val(),

            },

            success: function(data) {

                document.querySelector("#hidden").value = data;

            }

        })

    })
    $("#sub-name").change(function() {
        $.ajax({
            url: "checkAssignByStu.php",
            type: "POST",
            data: {
                sem: $("#sem").val(),
                sub: $("#sub-name").val(),
            },
            success: function(data) {
                $("#msg-area").html(data);
            }
        })
    })
    </script>
    <script>
    setInterval(() => {
        if (document.querySelector("#msg-area").innerHTML == "Attendance not assigned for today") {
            document.querySelector("#sbtn").disabled = true;
        } else {
            document.querySelector("#sbtn").removeAttribute("disabled");
        }
    }, 0)
    </script>

</body>



</html>
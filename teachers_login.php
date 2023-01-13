<?php
    session_start();
    include "connect.php";
    if(isset($_COOKIE['MTU_Username']) && $con){

        header("Location: teachersHome.php");

    }
    if(mysqli_num_rows(mysqli_query($con,"show tables like 'teachers_details'"))==0){
        $_SESSION['msg2'] = "Admin table destroyed! Please signup a new one";
        header("Location: teachers_signup.php");
    }

?>



<!DOCTYPE html>

<html lang="en" id="html">



<head>

    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="apple-touch-icon" sizes="76x76" href="./images/mtulogo-min.png">
    <link rel="icon" type="image/png" href="./images/mtulogo-min.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Teacher's Login Page</title>

    <link rel="stylesheet" href="style.css?version=1.7" />

    <!-- AOS -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="./jquery3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



</head>



<body>

    <div class="container">

        <div class="card" data-aos="zoom-in-down">

            <a href="index.php">

                <div class="card-header">

                    Teacher's<span style="color: blueviolet"> Login Page</span>

                </div>

            </a>

            <div class="card-body">

                <form action="sl.php" method="post" autocomplete="off">

                    <div class="form-group">

                        <span style="color:  red;" id="msg-area">

                            <?php
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    session_destroy();
                                }
                            ?>

                        </span>

                        <div class="input-group">

                            <label for="Username">Username</label>

                            <input type="text" name="username" id="username" required />

                        </div>

                        <div class="input-group">

                            <label for="Password">Password</label>

                            <input type="password" name="password" id="password" required />

                        </div>

                        <!-- 



               -->

                        <button id="login-btn" name="login-btn" class="submit-btn" type="submit" value="sbtn">

                            Login

                        </button>

                        <!-- 



                -->

                    </div>

                </form>
                <div class="mid-btn"><a href="teachers_signup.php"><button class="sl-btn">SIGNUP</button></a></div>

            </div>

        </div>

    </div>



    <!-- scripts -->

    <script src="script.js"></script>

    <!-- AOS -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    AOS.init();

    $("#username").focusout(function() {

        $.ajax({

            url: "checkUsername.php",

            type: "POST",

            data: {

                username: $("#username").val(),

            },

            success: function(data) {

                $("#msg-area").html(data);

            }

        });

    });
    </script>

    <script>
    setInterval(() => {

        if (document.querySelector("#username").value == "") {

            document.querySelector("#password").setAttribute("disabled", "disabled");

        } else {

            document.querySelector("#password").removeAttribute("disabled", "disabled");

            if (document.querySelector("#msg-area").innerHTML ==

                "Username doesn't exist! Do want to create a new account?") {



            }

        }

    }, 0);
    </script>



</body>



</html>
<?php
    session_start();
    if(isset($_COOKIE['MTU_Username'])){
        header("Location: teachersHome.php");
        exit;
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

    <title>Teacher's Sign Up Page</title>

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

                    Teacher's<span style="color: blueviolet"> Sign Up Page</span>

                </div>

            </a>

            <div class="card-body">

                <form action="sl.php" method="post" autocomplete="off">

                    <div class="form-group">

                        <?php
                                if(isset($_SESSION['msg2'])){
                                    echo "<span style='color:red'>".$_SESSION['msg2']."</span>";
                                    session_destroy();
                                }
                            ?>
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

                        <div class="input-group">

                            <label for="CPassword">Confirm Password</label>

                            <input type="password" name="Cpassword" id="Cpassword" required />

                        </div>

                        <!-- 



               -->

                        <button id="signup-btn" name="signup-btn" class="submit-btn" type="submit" value="sbtn">

                            Sign up

                        </button>

                        <!-- 



                -->

                    </div>

                </form>

                <div class="mid-btn"><a href="teachers_login.php"><button class="sl-btn">LOGIN</button></a></div>




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

                usernameExist: $("#username").val(),

            },

            success: function(data) {

                $("#msg-area").html(data);

            }

        });

    });
    </script>

    <script>
    var pass = document.querySelector("#password");

    var cpass = document.querySelector("#Cpassword");

    var msg = document.querySelector("#msg-area");

    var btn = document.querySelector("#signup-btn");





    pass.addEventListener("keyup", () => {

        if (cpass.value != "") {

            if (pass.value != cpass.value) {

                msg.innerHTML = "Password doesn't match";

                btn.disabled = "true";

            } else {

                msg.innerHTML = "<span style='color:green'>Password match</span>";

                btn.removeAttribute("disabled");









            }

        }

    })

    cpass.addEventListener("keyup", () => {

        if (pass.value != "") {

            if (pass.value != cpass.value) {

                msg.innerHTML = "Password doesn't match";

                btn.disabled = "true";



            } else {

                msg.innerHTML = "<span style='color:green'>Password match</span>";

                btn.removeAttribute("disabled");







            }

        }

    })
    </script>



</body>



</html>
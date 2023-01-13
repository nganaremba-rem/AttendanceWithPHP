<?php
    session_start();
    include "connect.php";

    if(mysqli_num_rows(mysqli_query($con,"show tables like 'teachers_details'"))==0){
        $_SESSION['msg2'] = "Admin table destroyed! Please sign up a new one";
        header("Location: teachers_signup.php");
    }else{    
        if(isset($_COOKIE['MTU_Username'])){
            $username = $_COOKIE["MTU_Username"];
        }else{
            $_SESSION['msg']="Please login again";
            header("Location: teachers_login.php");
            exit;
        }
    }
    $table = "teachers_data";
?>

<html>

<head>
    <title><?php echo $username; ?> Homepage</title>
    <link rel="apple-touch-icon" sizes="76x76" href="./images/mtulogo-min.png">
    <link rel="icon" type="image/png" href="./images/mtulogo-min.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css?version=1.7" />
    <script src="./jquery3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <style>
    .container {
        display: flex;
        flex-direction: column;
        min-height: 0;
        width: 100%;
    }

    nav {
        display: flex;
        width: 100%;
        justify-content: space-around;
        align-items: center;
        margin-bottom: 1rem;
    }

    .nav-list {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-item {
        padding: 1rem 2rem;
        box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2);
    }

    .container .card {
        width: 100%;
        padding: 0rem 1rem;
    }

    .dropdown-btn {
        padding: 1rem 2rem;
        border: none;
        box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2);
    }

    #display-area {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #e0e0e0;
    }

    .table-area {
        overflow: auto;
        width: 100%;
        padding: 1rem .5rem;
    }


    @media screen and (max-width: 600px) {
        nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }


        .btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .dropdown-btn {
            font-size: small;
            padding: 1rem .5rem;
        }

        .dropdown .dropdown-content {
            width: 15rem;
        }

        .container .card {
            padding: 0;
        }

        .modal-content {
            width: 80%;
        }

        .responsive-list {
            position: relative;
        }

        .nav-list {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 0;
            right: 50px;
            z-index: 1;
            border-radius: 5px;
            box-shadow: 0px 1px 4px 2px rgba(0, 0, 0, 0.2);
            animation: slide-left 0.2s ease-out;
        }

        .nav-list::after {
            content: "";
            position: absolute;
            left: 100%;
            top: 0px;
            border-left: 7px solid rgb(175, 173, 173);
            ;
            border-top: 7px solid transparent;
            border-bottom: 7px solid transparent;
            z-index: 1;
        }

        .nav-list a div {
            background-color: rgb(175, 173, 173);
        }

        .nav-list a:hover div {
            background-color: #333;
            color: white;
        }

        .nav-list * {
            width: 100%;
        }

        .active {
            display: flex;
        }

        .menu {
            position: relative;
            padding-inline: .3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            height: 23px;
        }

        .bar {
            width: 30px;
            height: 4px;
            background-color: #333;
            border-radius: 5px;
        }

        .menu::before {
            content: "";
            position: absolute;
            inset: 0;
        }

    }
    </style>

</head>

<body>
    <div class="container">
        <nav>
            <div class="user">
                Welcome <?php echo $username; ?>
            </div>
            <div class="responsive-list">
                <div class="menu" id="menu" data-menu>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <div class="nav-list">
                    <a href="index.php">
                        <div class="nav-item">Student's Page</div>
                    </a>
                    <a href="logout.php">
                        <div class="nav-item">Logout</div>
                    </a>
                </div>
            </div>

        </nav>

        <?php 
            if(isset($_SESSION['msg'])){
                            ?>
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 style="background-color: transparent;">ALERT!</h2>
                </div>
                <div class="modal-body">
                    <?php
                                                    echo $_SESSION['msg'];
                                                    session_destroy();
                                                    ?>

                </div>
                <div class="modal-footer">
                    <button id="close-btn" class="btn danger">Close</button>
                </div>
            </div>

        </div>
        <?php
        }
        ?>
        <!-- The Modal -->
        <div class="card">
            <div class="card-body">

                <div class="btn-group">
                    <div class="dropdown" dropdown id="get-dropdown">
                        <button class="dropdown-btn" id="get-drop-btn" data-toggle-btn>Assign Today's
                            Attendance</button>
                        <div class="dropdown-content">
                            <div class="close-btn" data-close-btn>&times;</div>
                            <form action="getAttendance.php" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="sem">Semester</label>
                                        <select name="sem" id="sem" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="sub-name">Subject Code</label>
                                        <select name="sub-name" id="sub-name" required>
                                            <option value="">Please select...</option>
                                        </select>
                                    </div>
                                    <button name="cbtn" class="submit-btn" type="submit"
                                        value="get-dropdown">Assign</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown" dropdown id="create-dropdown">
                        <button class="dropdown-btn" data-toggle-btn>Create New Attendance</button>
                        <div class="dropdown-content">
                            <div class="close-btn" data-close-btn>&times;</div>
                            <form action="teachers_data.php" method="post">
                                <div class="form-group">
                                    <span style="color: red;">
                                        <?php
                                        if(isset($_GET['msg'])){
                                            echo $_GET['msg'];
                                        }
                                     ?>
                                    </span>
                                    <div class="input-group">
                                        <label for="sub-name">Subject Codes <span style="color:red">*</span></label>
                                        <input type="text" name="sub-name" id="sub-name-field"
                                            placeholder="Any subject name" required>
                                    </div>
                                    <div class="input-group">
                                        <label for="sem">Semester <span style="color:red">*</span></label>
                                        <select name="sem" id="semester" required>
                                            <option value="" selected disabled>Please select...</option>
                                            <option value="1st">1st Semester</option>
                                            <option value="2nd">2nd Semester</option>
                                            <option value="3rd">3rd Semester</option>
                                            <option value="4th">4th Semester</option>
                                            <option value="5th">5th Semester</option>
                                            <option value="6th">6th Semester</option>
                                            <option value="7th">7th Semester</option>
                                            <option value="8th">8th Semester</option>
                                        </select>
                                    </div>

                                    <button name="create-btn" class="submit-btn" type="submit" value="create-dropdown">
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown" dropdown id="display-dropdown">
                        <button class="dropdown-btn" id="display-drop-btn" data-toggle-btn>Display
                            Attendance</button>
                        <div class="dropdown-content">
                            <div class="close-btn" data-close-btn>&times;</div>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="sem">Semester</label>
                                        <select name="sem2" id="sem2">
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="sub-name">Subject Code</label>
                                        <select name="sub-name2" id="sub-name2">
                                            <option value="">Please select...</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="display-area" class=".table-striped"></div>

    <script src="script.js"></script>
    <script>
    $("#get-drop-btn").click(function() {
        $.ajax({
            url: "getSem.php",
            success: function(data) {
                $("#sem").html(data);
            }
        });
        $.ajax({
            url: 'getSub.php',
            type: 'POST',
            data: {
                sem: $("#sem").val(),
            },
            success: function(data) {
                $("#sub-name").html(data);
            }

        });
    });
    $("#display-drop-btn").click(function() {
        $.ajax({
            url: "getSem.php",
            success: function(data) {
                $("#sem2").html(data);
            }
        });
        $.ajax({
            url: 'getSub.php',
            type: 'POST',
            data: {
                sem: $("#sem2").val(),
            },
            success: function(data) {
                $("#sub-name2").html(data);
            }

        });
    });
    $("#sem").change(function() {
        $.ajax({
            url: 'getSub.php',
            type: 'POST',
            data: {
                sem: $("#sem").val(),
            },
            success: function(data) {
                $("#sub-name").html(data);
            }

        });
    });
    $("#sem2").change(function() {
        $.ajax({
            url: 'getSub.php',
            type: 'POST',
            data: {
                sem: $("#sem2").val(),
            },
            success: function(data) {
                $("#sub-name2").html(data);
            }

        });
    });
    $("#sub-name2").change(function() {
        $.ajax({
            url: 'display.php',
            type: 'POST',
            data: {
                sem: $("#sem2").val(),
                subName2: $("#sub-name2").val(),
            },
            success: function(data) {
                $("#display-area").html(data);
            }
        });
    });
    </script>
    <script>
    setInterval(() => {
        if (document.querySelector("#sem").value == "") {
            document.querySelector("#sub-name").setAttribute("disabled", "disabled");
        } else {
            document.querySelector("#sub-name").removeAttribute("disabled");

        }
        if (document.querySelector("#sem2").value == "") {
            document.querySelector("#sub-name2").setAttribute("disabled", "disabled");
        } else {
            document.querySelector("#sub-name2").removeAttribute("disabled");

        }
    }, 0);
    </script>
    <script>
    AOS.init();
    </script>
    <script src="script.js"></script>
    <script>
    document.addEventListener("click", (e) => {
        if (!e.target.matches("[data-menu]")) {
            document.querySelector(".nav-list").classList.remove("active");
        }
        if (e.target.matches("[data-menu]") || e.target.closest("data-menu")) {
            document.querySelector(".nav-list").classList.toggle("active");
        }

        if (e.target.matches("[data-close-btn]")) {
            e.target.closest("[dropdown]").classList.remove("active");
        }
    })
    // Get the modal
    var modal = document.getElementById("myModal");

    // When the user clicks on <span> (x), close the modal

    document.querySelector("#close-btn").onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
    </script>
</body>


</html>
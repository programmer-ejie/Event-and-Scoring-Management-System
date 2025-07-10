<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../includes_style/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background-color: #18191a;
            color: #ccc;
        }
        .sidebar {
            background: #242526;
            
            width: 250px;
        }
        .menu-links a {
            color: #ccc;
        }
        .toggle {
            cursor: pointer;
        }
        .close .text {
            /* Display the text when the sidebar is closed */
            display: inline;
        }
        .close .icon {
            /* Move the icon to the left when the sidebar is closed */
            margin-right: 10px;
        }

        i{
            margin-left: 30px;
        }

        #logout{
            margin-left: 0px;
        }

      
        
    </style>
</head>
<body>
    <nav class="sidebar close"> <!-- Add the "close" class initially -->
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="
                    <?php 

                        include("../conn/connection.php");

            
                                      $id = $_SESSION['id'];
                                    $sql = "SELECT profile FROM users WHERE id = $id";
                                    $result = mysqli_query($conn,$sql);


                                    while($check = mysqli_fetch_assoc($result)){
                                    
                                        echo $check['profile'];
                                    }
                                


                                
                                
                            ?>
                    ">
                </span>

                <div class="text logo-text">
                    <span class="admin">User</span>
                    <span class="team_name"><?php  
                        $username = $_SESSION['username'];

                        echo"
                            <span>$username</span>
                        ";
                    ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link" id = "dashboard">
                        <a href="../user/User_Dashboard.php">
                        <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link" id = "profile">
                        <a href="../user/User_profile.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                    <li class="nav-link" id = "eList">
                        <a href="../user/User_Eventlist.php">
                            <i class='bx bx-calendar icon'></i>
                            <span class="text nav-text">Event List</span>
                        </a>
                    </li>

                  

                    <li class="nav-link" id = "tScore">
                        <a href="../user/User_teamScore.php">
                            <i class='bx bx-trophy icon'></i>
                            <span class="text nav-text">All Team Score</span>
                        </a>
                    </li>

                    <li class="nav-link" id = "management">
                        <a href="../user/User_Management_Event_Scheduling.php">
                            <i class='bx bx-briefcase icon'></i>
                            <span class="text nav-text">Manage Event</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../index.php">
                        <i class='bx bx-log-out icon' id = "logout"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>

    <script>
        const body = document.querySelector('body');
        const sidebar = body.querySelector('nav');
        const toggle = body.querySelector(".toggle");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>
</html>

<?php
include("../includes/user_sidebar.php");
include("../includes/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel = "stylesheet" href = "../user_style/User_Dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class = "section1">
<div class = "con1">
    <div class = "box">
        <a href = "User_profile.php">
            <div class = "title">
                Profile
            </div>
            <div class = "icon">
                <i class='bx bx-user icon'></i>
            </div>
            <div class = "description">
                Click here! to proceed into Profile
            </div>
        </a>
    </div>
    
    <div class = "box">
        <a href = "User_Eventlist.php">
            <div class = "title">
                Event List
            </div>
            <div class = "icon">
                <i class='bx bx-calendar icon'></i>
            </div>
            <div class = "description">
                Click here! to proceed into Event List
            </div>
        </a>
    </div>
    
    
   
</div>


<div class = "con2">

    <div class = "box">
        <a href = "User_Management_Event_Scheduling.php">
            <div class = "title">
                Event Management
            </div>
            <div class = "icon">
                <i class='bx bx-cog icon'></i>
            </div>
            <div class = "description">
                Click here! to proceed into Event Management
            </div>
        </a>
    </div>
    
    <div class = "box">
        <a href = "User_teamScore.php">
            <div class = "title">
                All Team Score
            </div>
            <div class = "icon">
                <i class='bx bx-trophy icon'></i>
            </div>
            <div class = "description">
                Click here! to proceed into All Team Score
            </div>
        </a>
    </div>
</div>
</div>


    

</body>
</html>
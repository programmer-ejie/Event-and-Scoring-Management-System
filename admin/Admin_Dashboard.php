<?php
include("../includes/admin_sidebar.php");
include("../includes/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel = "stylesheet" href = "../admin_style/admin_dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class = "con1">
    <div class = "box">
        <a href = "Admin_Profile.php">
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
        <a href = "admin_eventlist.php">
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
        <a href = "Management_Event_Scheduling.php">
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
        <a href ="admin_teamScore.php">
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
    

</body>
</html>
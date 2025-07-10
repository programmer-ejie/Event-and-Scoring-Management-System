<?php
include("../includes/user_sidebar.php");
include("../conn/connection.php");
include("../includes/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../user_style/user_profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>


    <div class = "containerB">
           <div class = "profile">
            <img src = "<?php 

          
            $id = $_SESSION['id'];
                $sql = "SELECT profile FROM users WHERE id = $id";
                $result = mysqli_query($conn,$sql);


                while($check = mysqli_fetch_assoc($result)){
                   
                    echo $check['profile'];
                }


             
                //example ne para sa tuturial video about github!

                
                
            ?>" id="profilePreview">

            <div class = "changeProfileButton">
                    <label for="changeProfile">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="green" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                    </label>


                    <input type = "file" id = "changeProfile" name = "changePicValue" value = "profilePic" onchange="previewProfile()">

            </div>

            </div>

            <div class = "input1">
                    <label for = "fname">Fullname</label>
                    <input type = "text" name = "fname" id = "fname" class = "form-control">                   
            </div>
            <div class = "input2">
                    <label for = "age">Age</label>
                    <input type = "text" name = "age" id = "age" class = "form-control">                   
            </div>
            <div class = "input3">
                    <label for = "gmail">Gmail</label>
                    <input type = "text" name = "gmail" id = "gmail" class = "form-control">                   
            </div>

            <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id = "userId">


            <button class = "btn btn-success" id = "editBtn" value = "click" onclick = "editprofile()">CONFIRM EDIT</button>
    </div>


    <div class = "containerC">
                
                    <div class = "countBox">

                        <div class = "title">
                            USERS
                        </div>
                        
                        <div class = "icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            </svg>
                        </div>

                        <div class = "count">
                            <?php

                                    $sql = "SELECT * FROM users";

                                $result = mysqli_query($conn,$sql);

                                $count = 0;

                                while($test = mysqli_fetch_assoc($result)){
                                    $count++;
                                }

                                echo "

                                    <h2>$count</h2>

                                    <script>

                                          refreshIfClose();

                                    </script>
                                
                                ";

                            
                            ?>
                        </div>

                    </div>


                  

    </div>

    <div class = "containerD">

                        <div class = "title">
                            INFORMATION
                        </div>
                        
                        <div class = "icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        </div>

                        <div class = "info">
                        The code also hints at placeholders for profile count and an about section. Recommendations include enhancing security measures, validating user inputs, ensuring responsive design, and thoroughly testing the functionality. Further attention is advised for handling file uploads securely and implementing robust error handling throughout the application.
                        </div>

                    </div>

                
    </div>


    


    <!-- modal for notif for succesful editing profile information -->
<div class="modal" tabindex="-1" id = "successModal" style = "margin-top: 100px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notice!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You have Successfully Edited an Information Datasets</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = " refreshIfClose()">Close</button>
        
      </div>
    </div>
  </div>
</div>
    
    
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>

// if ready automatic mo suwat ang data sa database
$(document).ready(function () {

    var id = $('#userId').val();

        $.post("../ajax/user_ajax.php", { userProfileId: id }, function(data, status) {
                        console.log(data); // Log the raw response to the console

                        var userID = JSON.parse(data);

                        $('#fname').val(userID.fullname);
                        $('#age').val(userID.age);
                        $('#gmail').val(userID.gmail);
                      
                    });
            });






        function editprofile(){

                var fullname = $('#fname').val();
                var age = $('#age').val();
                var gmail = $('#gmail').val();
                
          
                 // Get the file input value
                    var profilePath = $('#changeProfile').val();

                // Replace "C:\\fakepath\\" with an empty string
                var profilePic = profilePath.replace(/C:\\fakepath\\/i, '');


                
                console.log(profilePic); //check rani if me replace ba
                            

            $.ajax({

                    url: "../ajax/user_ajax.php",
                    type: 'post',
                    data: {
                        fullname:fullname,
                        age:age,
                        gmail:gmail,
                        profilePic:profilePic
                       
                    },
                    success: function (data, status) {

                        $('#successModal').modal('show');
                    }

                    });

        }




 // para ma reload ang file if click
        function refreshIfClose(){
                        location.reload();
                    }






// for prevwieing profile
        function previewProfile() {
            var input = document.getElementById('changeProfile');
            var preview = document.getElementById('profilePreview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>





           
             <script>
                 
             </script>
   
</body>
</html>
<?php
    include("../conn/connection.php");
    include("../includes/admin_sidebar.php");
    include("../includes/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=d  evice-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel = "stylesheet" href = "../admin_style/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
</head>
<body>


<div class="container menus">
        <div class="search">
            <input class="form-control me-2" type="search" placeholder="Search Fullname" aria-label="Search" id="searchName" style = "position: relative; top: 35px;">
           
        </div>
    </div>

    <div class="container">
        <div class="slot"  id="add_button" data-bs-toggle="modal" data-bs-target="#add_event_modal">
            <svg xmlns="http://www.w3.org/2000/svg" style = "position: relative; top: 5px; left: 15px;" width="30" height="30" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
            </svg>
            <h6>

                <?php
                    $sql = "SELECT * FROM users";

                    $result = mysqli_query($conn,$sql);

                    $count = 0;

                    while($test = mysqli_fetch_assoc($result)){

                        $count++;

                    }

                    echo "
                                <h4 style = ' margin-top: 7px; position:relative; left: 27px;'>$count</h4> 
                                <h4 style = ' margin-top: 13px; margin-left: 40px; font-size: 14px;'> Available Profile</h4>
                        ";
                ?>
            </h6>
            
        </div>
      
        <div class="displayDataTable" id="tableForProfile">
            <!-- generated table -->
        </div>


        <!-- Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "position: relative; top: -300px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Notice!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    Are you sure to delete this profile?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onclick = "toDelete()">Confirm Delete</button>
        <input type = "hidden" id = "deleteValue">
      </div>
    </div>
  </div>
</div>

        
    </div>

  

<!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- Include Bootstrap JS after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script>

    
            $(document).ready(function () {
                DisplayLog(null);
                $("#searchName").on('input', function () {
                    var value = $(this).val();

                    DisplayLog(value);
               
                    
                    
                });         
            });



            function DisplayLog(searchValue) { //for ASC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            profileASC: true,
                            searchValueforProfile: searchValue
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#tableForProfile').html(data);                       
                        }
                    });
                }

              
                function DisplayLogR(searchValue) { //for DESC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            profileDESC: true, 
                            searchValue: searchValue                         
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#tableForProfile').html(data);                       
                        }
                    });
                }


                  //para ma reverse and order ASC / DESC
            function DESC(){
                DisplayLogR();                
            }
            function ASC(){
                DisplayLog();                
            }


            //function for deleting an user in profile!
        function DeleteUserInProfile(id){

          $('#deleteValue').val(id);
          $('#confirmDelete').modal('show');
          
        }

        function toDelete(){

            var id = $('#deleteValue').val();

            $.ajax({
                    url: "../ajax/admin_ajax.php",
                    type: 'post',
                    data:{
                        deleteIDfromProfile:id

                    },
                    success:function(data,status){

                        DisplayLog();
                        refreshIfClose();
                    }
                });
        }






        function refreshIfClose(){
                        location.reload();
                    }



    </script>
    
</body>
</html>
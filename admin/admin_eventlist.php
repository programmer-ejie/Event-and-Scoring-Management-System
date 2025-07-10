<?php
    include("../includes/admin_sidebar.php");
    include("../includes/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link rel = "stylesheet" href = "../admin_style/admin_eventlist.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
</head>
<body>
 
<div class="container menus">
        <div class="search">
            <input class="form-control me-2" type="search" placeholder="Search Date" aria-label="Search" id="searchDate">
           
        </div>
    </div>

    <div class="eventlist" id="eventlist">
            <!-- generated table -->
        </div>




<!-- Modal for Edit Details -->
<div class="modal fade" id="editDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <label for="EditoneName">Team A</label>
                    <input type="text" class="form-control" id="EditoneName">

                    <label for="EdittwoName">Team B</label>
                    <input type="text" class="form-control" id="EdittwoName">

                    <label for="Editdate">Date</label>
                    <input type="text" class="form-control" id="Editdate">

                    <label for="Edittime">Time</label>
                    <input type="text" class="form-control" id="Edittime">

                    <label for="Editlocation">Location</label>
                    <input type="text" class="form-control" id="Editlocation">

                    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
        <button onclick = "proceedToEditDetails()" class = "btn btn-success">CONFIRM EDIT</button>
        <input type = "hidden" id = "hiddenID">
      </div>
    </div>
  </div>
</div>




<!-- Modal for ViewDetails -->
<div class="modal fade" id="viewDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Event Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    <label for="oneName">Team A</label>
                    <input type="text" class="form-control" disabled id="oneName">

                    <label for="twoName">Team B</label>
                    <input type="text" class="form-control" disabled id="twoName">

                    <label for="date">Date</label>
                    <input type="text" class="form-control" disabled id="date">

                    <label for="time">Time</label>
                    <input type="text" class="form-control" disabled id="time">

                    <label for="location">Location</label>
                    <input type="text" class="form-control" disabled id="location">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
      
      </div>
    </div>
  </div>
</div>





<!-- modal for notif for succesful edit -->
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


        


   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



    <script>
               $(document).ready(function () {
                displayEventListDESC(null);
                $("#searchDate").on('input', function () {
                    var value = $(this).val();

                    displayEventListDESC(value);
               
                    
                    
                });         
            });



            function displayEventListASC(searchValue) { //for ASC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            displayEventListASC: true,
                            searchValue: searchValue
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#eventlist').html(data);                       
                        }
                    });
                }

              
                function displayEventListDESC(searchValue) { //for DESC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            displayEventListDESC: true, 
                            searchValue: searchValue                         
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#eventlist').html(data);                       
                        }
                    });
                }

                //funtion to sort by date
                    function DESC() {
                      
                        
                        displayEventListDESC();
                    }

                    function ASC() {
                      
                        displayEventListASC();
                    }







                    //a function to view details play
                    function ViewDetails(id){
                      

                                $.post("../ajax/admin_ajax.php", { details_id: id }, function(data, status) {
                                console.log(data); // Log the raw response to the console

                                var details = JSON.parse(data);

                                $('#oneName').val(details.TEAMONE);
                                $('#twoName').val(details.TEAMTWO);                              
                                $('#date').val(details.DATE);
                                $('#time').val(details.TIME);
                                $('#location').val(details.LOCATION);
                               
                                
                            });

                            $('#viewDetails').modal('show');
                    }





                    //funtion para ma handle natu and edit sa mga details
                    function viewEditDatails(id){

                         $('#hiddenID').val(id);

                        
                        $.post("../ajax/admin_ajax.php", { details_id: id }, function(data, status) {
                                console.log(data); // Log the raw response to the console

                                var details = JSON.parse(data);

                                $('#EditoneName').val(details.TEAMONE);
                                $('#EdittwoName').val(details.TEAMTWO);                              
                                $('#Editdate').val(details.DATE);
                                $('#Edittime').val(details.TIME);
                                $('#Editlocation').val(details.LOCATION);
                               
                                
                            });


                            $('#editDetails').modal('show');

                    }

                    //mao ne ang function para ma edit najud natu
                    function proceedToEditDetails(){

                        var id = $('#hiddenID').val();

                        var teamOne = $('#EditoneName').val();
                        var teamTwo = $('#EdittwoName').val();
                        var date = $('#Editdate').val();
                        var time = $('#Edittime').val();
                        var location = $('#Editlocation').val();

                        $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                                eventListid:id,
                                teamOne:teamOne,
                                teamTwo:teamTwo,
                                date:date,
                                time:time,
                                location:location                        
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#editDetails').modal('hide');
                            $('#successModal').modal('show');
                           

                                                  
                        }
                    });

                    }
                    

        
        
        




            function refreshIfClose(){
                location.reload();
            }
    </script>

 
</body>
</html>
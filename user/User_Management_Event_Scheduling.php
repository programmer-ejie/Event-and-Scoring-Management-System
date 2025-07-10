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
    <title>Document</title>
    <link rel="stylesheet" href="../user_style/User_Management_Event_Scheduling.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container menus">
        <div class="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchDate">
          
        </div>
    </div>

    <div class="container">      
        <div class="displayDataTable" id="displayDataTable">
            <!-- generated table -->
        </div>
    </div>

     <!-- modal for the report button-->
     <div class="modal fade" id="report_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">User Request Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "refreshIfClose()"></button>
                </div>
                <div class="modal-body">
                    
                    <label for="reportTeamOne">Team A</label>
                    <input type="text" class="form-control" id="reportTeamOne">

                    <label for="reportTeamTwo">Team B</label>
                    <input type="text" class="form-control" id="reportTeamTwo">

                    <label for="reportDate">Date</label>
                    <input type="text" class="form-control" id="reportDate">

                    <label for="reportTime">Schedule time</label>
                    <input type="text" class="form-control" id="reportTime">

                    <label for="reportLocation">Location</label>
                    <input type="text" class="form-control" id="reportLocation">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()"id = "reload">Close</button>
                    <button type="button" class="btn btn-success" onclick="ReportSend()" >Send Request</button>
                    <input type = "hidden" id = "dataforreport">
                    
                </div>
            </div>
        </div>
    </div>





    <!-- modal for search bar -->
    <div class="modal fade" id="search_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">INFORMATION</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "refreshIfClose()"></button>
                </div>
                <div class="modal-body">
                            <div class = "searchTable" id = "searchTable"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- modal for successful request -->
    <div class="modal" tabindex="-1" id = "reportSuccess" style = "position: relative; top: -200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notice!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Your request has been successfully sent for approval.</p>
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


        $(document).ready(function () {
                DisplayLog(null);
                $("#searchDate").on('input', function () {
                    var value = $(this).val();

                    DisplayLog(value);
               
                    
                    
                });         
            });



            function DisplayLog(searchValue) { //for ASC
                    $.ajax({
                        url: "../ajax/user_ajax.php",
                        type: 'post',
                        data: {
                            log_info: true,
                            searchValue: searchValue
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#displayDataTable').html(data);                       
                        }
                    });
                }

              
                function DisplayLogR(searchValue) { //for DESC
                    $.ajax({
                        url: "../ajax/user_ajax.php",
                        type: 'post',
                        data: {
                            log_info_R: true, 
                            searchValue: searchValue                         
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#displayDataTable    ').html(data);                       
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
      


            





            //ajax funtion for view button
            function ReportEvent(id){
                       
                       
                        $('#dataforreport').val(id);
                      

                        $.post("../ajax/user_ajax.php", { idRequest: id }, function(data, status) {
                                console.log(data); // Log the raw response to the console

                                var details = JSON.parse(data);

                                $('#reportTeamOne').val(details.TEAMONE);
                                $('#reportTeamTwo').val(details.TEAMTWO);                              
                                $('#reportDate').val(details.DATE);
                                $('#reportTime').val(details.TIME);
                                $('#reportLocation').val(details.LOCATION);
                               
                                
                            });
                        
                            $('#report_modal').modal('show'); 
                      
            }

                //mao ne para ma send na ang report
                function ReportSend(){

                    var reportTeamOne = $('#reportTeamOne').val();
                    var reportTeamTwo = $('#reportTeamTwo').val();
                    var reportDate = $('#reportDate').val();
                var reportTime = $('#reportTime').val();
                var reportLocation = $('#reportLocation').val();

                var user_id = $('#dataforreport').val();
                    
                    $.ajax({

                        url: "../ajax/user_ajax.php",
                        type: 'post',
                        data: {
                            reportTeamOne: reportTeamOne,
                            reportTeamTwo: reportTeamTwo,
                            reportDate: reportDate,
                            reportTime: reportTime,
                            reportLocation:reportLocation,
                            user_id:user_id
                        },
                        success: function (data, status) {
                            $('#report_modal').modal('hide');
                           
                            $('#reportSuccess').modal('show');
                            
                        }

                    });

            }



       

       

       
    </script>





        <!-- function pra inig click sa close mo reload sija -->
                    <script>
                    function refreshIfClose(){
                        location.reload();
                    }
                    </script>
   




</body>
</html>

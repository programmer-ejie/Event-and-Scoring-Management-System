<?php
include("../includes/admin_sidebar.php");
include("../conn/connection.php");
include("../includes/footer.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../admin_style/Management_Event_Scheduling.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
  

</head>
<body>
    <div class="container menus">
        <div class="search">
            <input class="form-control me-2" type="search" placeholder="Search Date" aria-label="Search" id="searchDate">
           
        </div>
    </div>

    <div class="container">
        <div class="btn btn-primary" id="add_button" data-bs-toggle="modal" data-bs-target="#add_event_modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
                <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z"/>
            </svg>
            <h6>ADD EVENT</h6>
            
        </div>
        <button class="btn btn-success" id="reportLog" data-bs-toggle="modal" onclick = " DisplayTableForReport() ">
             <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
            <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z"/>
            </svg>
            <h6>Request Log</h6>
        </button>
        <div class = "request-count">
                <?php

                // this is the method of checking how many pending request 

                $sql = "SELECT * FROM report";
                $result = mysqli_query($conn,$sql);

                $count = 0;

                while($test = mysqli_fetch_assoc($result)){

                    $count++;

                }

                    echo "
                        <h6 style = ' 
                        color: white;
                        position: absolute;
                        left: 480px;
                        top: 79px;
                        background-color: black;
                        width:20px;
                        border-radius: 5px;
                        display:flex;
                        justify-content: center;
                        
                        '>$count</h6>
                    ";

                   

                ?>
            </div><br>
        <div class="displayDataTable" id="displayDataTable">
            <!-- generated table -->
        </div>

        
    </div>

    <!-- modal for add event button -->
    <div class="modal fade" id="add_event_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Event to List:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "refreshIfClose()"></button>
                </div>
                <div class="modal-body">
                    <label for="team1">Team A</label>
                    <input type="text" class="form-control" id="team1">

                    <label for="team2">Team B</label>
                    <input type="text" class="form-control" id="team2">

                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="date">

                    <label for="time">Schedule time</label>
                    <input type="text" class="form-control" id="time">

                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
                    <button type="button" class="btn btn-success" onclick="addEvent()">Save</button>
                </div>
            </div>
        </div>
    </div>



    <!-- modal for report log -->
    <div class="modal fade" id="reportLog_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Report Log</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "refreshIfClose()"></button>
                </div>
                <div class="modal-body">

                <div class = "reportTable" id = "reportTable"></div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
                  
                    <input type = "hidden" id = "HiddenReportId">
                    <input type = "hidden" id = "HiddenReportIdforLogInfo">
                </div>
            </div>
        </div>
    </div>


    <!-- modaal for viewing the report log -->
    <div class="modal fade" id="ViewReportLog_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Details of report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "refreshIfClose()"></button>
                </div>
                <div class="modal-body">

                <label for="team1">Team A</label>
                    <input type="text" disabled class="form-control" id="ChangeTeamOne">

                    <label for="team2">Team B</label>
                    <input type="text" disabled class="form-control" id="ChangeTeamTwo">

                    <label for="date">Date</label>
                    <input type="text" disabled class="form-control" id="ChangeDate">

                    <label for="time">Schedule time</label>
                    <input type="text" disabled class="form-control" id="ChangeTime">


                    <label for="ChangeLocation">Location</label>
                    <input type="text" disabled class="form-control" id="ChangeLocation">
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="DeleteReport()">DELETE</button>
                    <button type="button" class="btn btn-success" onclick="ConfirmReport()">CONFIRM</button>
                </div>
            </div>
        </div>
    </div>





     <!-- modal for the edit button-->
     <div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "refreshIfClose()"></button>
                </div>
                <div class="modal-body">
                    
                    <label for="team1">Team A</label>
                    <input type="text" class="form-control" id="EditteamOne">

                    <label for="team2">Team B</label>
                    <input type="text" class="form-control" id="EditteamTwo">

                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="Editdate">

                    <label for="time">Schedule time</label>
                    <input type="text" class="form-control" id="Edittime">

                    <label for="Editlocation">Location</label>
                    <input type="text" class="form-control" id="Editlocation">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
                    <button type="button" class="btn btn-success" onclick="EditInformation()">Save</button>
                    <input type="hidden" id = "hiddendata">
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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



     <!-- Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "position: relative; top: -400px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Notice!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    Are you sure to delete this Event?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onclick = "toDelete()">Confirm Delete</button>
        <input type = "hidden" id = "deleteValue">
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



        <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Include Bootstrap JS after jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


   <script>

        $(document).ready(function () {
            DisplayLogR(null);
                $("#searchDate").on('input', function () {
                    var value = $(this).val();

                    DisplayLogR(value);
               
                    
                    
                });         
            });



            function DisplayLog(searchValue) { //for ASC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
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
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            log_info_R: true, 
                            searchValue: searchValue                         
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#displayDataTable').html(data);                       
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

        

        
        
        //function for adding an event
        function addEvent() {
            var teamA = $('#team1').val();
            var teamB = $('#team2').val();
            var date = $('#date').val();
            var time = $('#time').val();
            var location = $('#location').val();

            var value = "add";

            $.ajax({
                url: "../ajax/admin_ajax.php",
                type: 'post',
                data: {
                    teamA: teamA,
                    teamB: teamB,
                    date: date,
                    time,time,
                    location:location,
                    value: value
                },
                success: function (data, status) {
                    $('#add_event_modal').modal("hide");
                    DisplayLog();
                    alert('Added Successfully!');
                    refreshIfClose();
                }
            });
        }




        //function for deleting an event!
        function DeleteEvent(id){
            
            $('#deleteValue').val(id);
          $('#confirmDelete').modal('show');
            
        }


        function toDelete(){

            var id = $('#deleteValue').val();

            $.ajax({
                    url: "../ajax/admin_ajax.php",
                    type: 'post',
                    data:{
                        deleteID:id

                    },
                    success:function(data,status){

                        DisplayLog();
                        refreshIfClose();
                    }
                });
        }



        // function para ma show and current details sa database in the editing section!
        function ShowDetailsForEditBtn(id) {

            $('#hiddendata').val(id);
         

                $.post("../ajax/admin_ajax.php", { id: id }, function(data, status) {
                    console.log(data); // Log the raw response to the console

                    var userID = JSON.parse(data);

                    $('#EditteamOne').val(userID.TEAMONE);
                    $('#EditteamTwo').val(userID.TEAMTWO);
                    $('#Editdate').val(userID.DATE);
                    $('#Edittime').val(userID.TIME);
                    $('#Editlocation').val(userID.LOCATION);
                });


            $('#edit_modal').modal('show');

   
        }



        //funtion para ma edit najud sija sa database
        function EditInformation(){
                var updateTeamOne = $('#EditteamOne').val();
                var updateTeamTwo = $('#EditteamTwo').val();
                var updateDate = $('#Editdate').val();
                var updateTime = $('#Edittime').val();
                var updateLocation = $('#Editlocation').val();
                var hiddendata = $('#hiddendata').val();

                $.post("../ajax/admin_ajax.php",{
                    updateTeamOne:updateTeamOne,
                    updateTeamTwo:updateTeamTwo,
                    updateDate:updateDate,
                    updateTime:updateTime,
                    updateLocation:updateLocation,
                    hiddendata:hiddendata
                },function(data,status){
                    
                    $('#edit_modal').modal('hide');
                    $('#successModal').modal('show');
                    DisplayLog();
                    
                });

            }





            //function para ma display as table and kuan ana na date sa search nutton
            function displayData(){
                $('#search_modal').modal('show');
                showAvailDataSearchButton();

            }

            //para ma display unsay avail na duwa ana na date sa Search Button
            function showAvailDataSearchButton(){
                var searchValue = $('#searchDate').val();
                var avail = "true";
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            availData: avail,
                            searchValue:searchValue
                        },
                        success: function (data, status) {
                            $('#searchTable').html(data);
                            
                        }
                    });
            }



            
            
            
            
            //table para sa pending reports
         function DisplayTableForReport() {
             $('#reportLog_modal').modal('show');
                    var displayData = "true";
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            TableReportLog: displayData
                        },
                        success: function (data, status) {
                            $('#reportTable').html(data);
                        }
                    });
        }

        //another view button for report funtion para ma pindot and view
        function showReportData(report_id,log_id){           
            $('#reportLog_modal').modal('hide');
            $('#ViewReportLog_modal').modal('show');
            $('#HiddenReportId').val(report_id);
            $('#HiddenReportIdforLogInfo').val(log_id);

            showDetailsinTheReportLog();
        }

        //to show the details in the report log
        function showDetailsinTheReportLog(){

            var report_id = $('#HiddenReportId').val();

            $.post("../ajax/admin_ajax.php", {report_id:report_id}, function(data, status) {
                    console.log(data); // Log the raw response to the console

                    var report = JSON.parse(data);

                    $('#ChangeTeamOne').val(report.TeamOne);
                    $('#ChangeTeamTwo').val(report.TeamTwo);
                    $('#ChangeDate').val(report.Date);
                    $('#ChangeTime').val(report.Time);
                    $('#ChangeLocation').val(report.Location);
                });
        }

        //Confirm para sa report
        function ConfirmReport() {
                var toConfirmReport = $('#HiddenReportId').val();
                var toConfirmLog = $('#HiddenReportIdforLogInfo').val();

                var TEAMEONE =  $('#ChangeTeamOne').val();
                var TEAMTWO =  $('#ChangeTeamTwo').val();
                var DATE =  $('#ChangeDate').val();
                var TIME =  $('#ChangeTime').val();
                var LOCATION =  $('#ChangeLocation').val();


                $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            toConfirmReport: toConfirmReport,
                            toConfirmLog:toConfirmLog,
                            TEAMEONE: TEAMEONE,
                            TEAMTWO: TEAMTWO,
                            DATE: DATE,
                            TIME: TIME,
                            LOCATION:LOCATION
                        },
                        success: function (data, status) {    

                            DisplayTableForReport();
                            $('#ViewReportLog_modal').modal('hide');
                            DisplayLog();
                            refreshIfClose();
                        }
                    });

               
               
            }



        //Delete para sa report
        function DeleteReport() {
                var todelete = $('#HiddenReportId').val();


                $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            todelete: todelete
                        },
                        success: function (data, status) {    

                            DisplayTableForReport();
                            $('#ViewReportLog_modal').modal('hide');
                            DisplayLog();
                            refreshIfClose();
                        }
                    });           
            }

      



          
        
    </script>



            <!-- page to reload function -->
            <script>
            function refreshIfClose(){
                location.reload();
            }
            </script>
            
</body>
</html>

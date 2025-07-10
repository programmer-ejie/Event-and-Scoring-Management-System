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
    <title>All Team Score</title>
    <link rel = "stylesheet" href = "../admin_style/teamScore.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
</head>
<body>

<div class="container menus">
        <div class="search">
            <input class="form-control me-2" type="search" placeholder="Search Date" aria-label="Search" id="searchDate">
           
        </div>
    </div>

    <div class="teamScore" id="teamScore">
            <!-- generated table -->
        </div>




<!-- Modal for View Score -->
<div class="modal fade" id="viewScore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Score Board</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <label for="team1">Team A</label>
                    <input type="text" class="form-control" disabled id="one">

                    <label for="oneScore">Score</label>
                    <input type="text" class="form-control" disabled id="oneScore">

                    

                        <br><br>

                    <label for="team2">Team B</label>
                    <input type="text" class="form-control" disabled id="two">

                    <label for="twoScore">Score</label>
                    <input type="text" class="form-control" disabled id="twoScore">

                    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
        
      </div>
    </div>
  </div>
</div>




<!-- Modal for Scoring -->
<div class="modal fade" id="scoring" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Score Board</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <label for="oneName">Team A</label>
                    <input type="text" class="form-control" disabled id="oneName">

                    <label for="oneScoring">Score</label>
                    <input type="text" class="form-control"  id="oneScoring">

                    

                        <br><br>

                    <label for="twoName">Team B</label>
                    <input type="text" class="form-control" disabled id="twoName">

                    <label for="twoScoring">Score</label>
                    <input type="text" class="form-control" id="twoScoring">

                    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick = "refreshIfClose()">Close</button>
        <button class = "btn btn-success" onclick = "ScoreNow()">Confirm Score</button>
        <input type = "hidden" id = "hiddenId">
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
                DisplayTeamScoreDESC(null);
                $("#searchDate").on('input', function () {
                    var value = $(this).val();

                    DisplayTeamScoreDESC(value);
               
                    
                    
                });         
            });



            function DisplayTeamScoreASC(searchValue) { //for ASC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            displayTeamScoreASC: true,
                            searchValue: searchValue
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#teamScore').html(data);                       
                        }
                    });
                }

              
                function DisplayTeamScoreDESC(searchValue) { //for DESC
                    $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            displayTeamScoreDESC: true, 
                            searchValue: searchValue                         
                        },
                        success: function (data, status) {
                            console.log(data); // Check the data in the console
                            $('#teamScore').html(data);                       
                        }
                    });
                }

                //funtion to sort by date
                    function DESC() {
                      
                        
                        DisplayTeamScoreDESC();
                    }

                    function ASC() {
                      
                        DisplayTeamScoreASC();
                    }







                    //a function to view score display
                    function viewScore(id){
                      

                                $.post("../ajax/admin_ajax.php", { view_score_id: id }, function(data, status) {
                                console.log(data); // Log the raw response to the console

                                var score = JSON.parse(data);

                                $('#one').val(score.TEAMONE);
                                $('#oneScore').val(score.TeamOneScore);
                                
                                $('#two').val(score.TEAMTWO);
                                $('#twoScore').val(score.TeamTwoScore);
                                
                            });

                            $('#viewScore').modal('show');
                    }
                    

        
        
            //a function to scoring display
              function ScoringView(id){

                    $('#hiddenId').val(id);
                                

                    $.post("../ajax/admin_ajax.php", { score_id: id }, function(data, status) {
                       console.log(data); // Log the raw response to the console

                            var score = JSON.parse(data);

                            $('#oneName').val(score.TEAMONE);
                            $('#oneScoring').val(score.TeamOneScore);
                            
                            $('#twoName').val(score.TEAMTWO);
                            $('#twoScoring').val(score.TeamTwoScore);
                            
                        });

                        $('#scoring').modal('show');
                }



                //a function to score an event

                function ScoreNow(){

                  var id = $('#hiddenId').val();
                  var teamOneScore = $('#oneScoring').val();
                  var teamTwoScore = $('#twoScoring').val();


               



                  $.ajax({
                        url: "../ajax/admin_ajax.php",
                        type: 'post',
                        data: {
                            toScore:id,
                            teamOneScore:teamOneScore,
                            teamTwoScore:teamTwoScore
                        },
                        success: function (data, status) {    

                          
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
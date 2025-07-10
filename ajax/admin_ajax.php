 <?php
    include("../conn/connection.php");

    // management line 13 - 317
    // eventlist 747 - 926
    //profile line 326 - 502
    //teamscore 518 - 736
    




    // query connected to ajax for inserting data into the database for the "add_event" action
    if (isset($_POST['value']) && $_POST['value'] == "add") {

        $teamA = $_POST['teamA'];
        $teamB = $_POST['teamB'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];

        $sql = "INSERT INTO log_info (TEAMONE, TEAMTWO, DATE, TIME,LOCATION) VALUES ('$teamA', '$teamB', '$date', '$time','$location')";
        mysqli_query($conn, $sql);
    }

    //ajax for showing the details from sa databse para ma hibaw an natu unsay atu editon just for displaying
    if(isset($_POST['id'])){
        $user_id = $_POST['id'];

        $sql = "SELECT * FROM log_info WHERE id = $user_id";
        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }

    // query connected to ajax para ma fuction nanatu and if atu clickon ma edit najud sija ija najud e handle and edition 
    if(isset($_POST['hiddendata'])){
        $uniqueid = $_POST['hiddendata'];

        $teamOne = $_POST['updateTeamOne'];
        $teamTwo = $_POST['updateTeamTwo'];
        $date = $_POST['updateDate'];
        $time = $_POST['updateTime'];
        $location = $_POST['updateLocation'];

        if(empty($teamOne) || empty($teamTwo) || empty($date) || empty($time) || empty($location)){
            echo "
            alert('Please Provide all The Information!');
            ";
        }else{
            $sql = "UPDATE log_info SET TEAMONE = '$teamOne', TEAMTWO = '$teamTwo', DATE = '$date', TIME = '$time', LOCATION = '$location' WHERE id = $uniqueid";
            mysqli_query($conn,$sql);
        }
        
    }





 // query connected to ajax for displaying the management table and search ASC
if (isset($_POST['log_info']) && $_POST['log_info'] == true) {
    // Check if searchValue is set and not empty
    $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;

    echo '<div style="max-height: 400px; max-width: 1200px; font-size: 11px; position: relative; left: 40px; top: -14px; overflow-y: auto; " class="table">';
    $table = '<table class="table table-bordered table-hover">
            <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
            <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle">Team A</th>
                <th scope="col" class="text-center align-middle">Team B</th>
                <th scope="col" class="text-center align-middle" onclick = "DESC()">Date</th>
                <th scope="col" class="text-center align-middle">Time</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Action</th>
            </tr>
            </thead>
            <tbody>';

    if (!empty($value)) {        
        $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE ASC";
    } else {
        $sql = "SELECT * FROM log_info ORDER BY DATE ASC";
    }

    $result = mysqli_query($conn, $sql);
    $number = 1;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $time =  $row['TIME'];
            $location = $row['LOCATION'];

            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . '</td>
                <td class="text-center align-middle">' . $teamTwo . '</td>
                <td class="text-center align-middle">' . $date . '</td>
                <td class="text-center align-middle">' . $time . '</td>
                <td class="text-center align-middle">' . $location . '</td>
                <td class="text-center align-middle">
                        <button class="btn btn-success" onclick="ShowDetailsForEditBtn(' . $id . ')">EDIT</button>
                        <button onclick="DeleteEvent(' . $id . ')" class="btn btn-danger">DELETE</button>
                </td>
            </tr>';

            $number++;
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="7" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }

    $table .= '</tbody></table>';
    echo $table;
    echo '</div>';
}


// query connected to Ajax for displaying the management table and search DESC
if (isset($_POST['log_info_R']) && $_POST['log_info_R'] == true) {
    // Check if searchValue is set and not empty
    $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;

  

    echo '<div style="max-height: 400px; max-width: 1200px; font-size: 11px; position: relative; left: 40px; top: -14px; overflow-y: auto; " class="table">';
    $table = '<table class="table table-bordered table-hover">
            <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
            <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle">Team A</th>
                <th scope="col" class="text-center align-middle">Team B</th>
                <th scope="col" class="text-center align-middle" onclick = "ASC()">Date</th>
                <th scope="col" class="text-center align-middle">Time</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Action</th>
            </tr>
            </thead>
            <tbody>';

    if (!empty($value)) {        
        $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE DESC";
    } else {
        $sql = "SELECT * FROM log_info ORDER BY DATE DESC";
    }

    $result = mysqli_query($conn, $sql);
    $number = 1;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $time =  $row['TIME'];
            $location = $row['LOCATION'];

            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . '</td>
                <td class="text-center align-middle">' . $teamTwo . '</td>
                <td class="text-center align-middle">' . $date . '</td>
                <td class="text-center align-middle">' . $time . '</td>
                <td class="text-center align-middle">' . $location . '</td>
                <td class="text-center align-middle">
                        <button class="btn btn-success" onclick="ShowDetailsForEditBtn(' . $id . ')">EDIT</button>
                        <button onclick="DeleteEvent(' . $id . ')" class="btn btn-danger">DELETE</button>
                </td>
            </tr>';

            $number++;
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="7" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }

    $table .= '</tbody></table>';
    echo $table;
    echo '</div>';
}

 





    //query connected to ajax for deleting an event
    if(isset($_POST['deleteID'])){
        $id = $_POST['deleteID'];

        $sql = "DELETE FROM log_info WHERE id = $id";

        mysqli_query($conn,$sql);
    }



    
    // query connected to ajax para maka create ug table para sa request log
     if (isset($_POST['TableReportLog']) && $_POST['TableReportLog'] == true) {
        echo '<div class="table scrollable-table">';
        $table = '<table class="table table-bordered table-hover">
            <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
            <tr> 
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Action</th>
            </tr>
            </thead>
            <tbody>';
    
        
    
        $sql = "SELECT * FROM report ";
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $reportId = $row['id'];
            $id = $row['user_id'];
            $teamA = $row['TeamOne'];
            $teamB = $row['TeamTwo'];
          
    
            
            $table .= '<tr>
               
                <td class="text-center align-middle">' . $teamA . ' VS '. $teamB .'</td>
                <td class="text-center align-middle">
                     <button class = "btn btn-info" onclick="showReportData('. $reportId .','.$id.')">View</button>
                </td>
              
            </tr>';
    
            $number++;
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="7" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }

    //handling the function to display the information para sa request log if atu clickon and view button it will display all the value on the selected request
    if(isset($_POST['report_id'])){

        $r = $_POST['report_id'];

        $sql = "SELECT * FROM report WHERE id = $r";

        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);      
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }


    //delete funtion para sa request log
    if(isset($_POST['todelete'])){
        $id = $_POST['todelete'];

        $sql = "DELETE FROM report WHERE id = $id";
        mysqli_query($conn,$sql);
    }

    // para confirm sa request log

    if(isset($_POST['toConfirmLog'])){
        
        $idforLoginfo = $_POST['toConfirmLog'];
        $idforReport = $_POST['toConfirmReport'];
        $one = $_POST['TEAMEONE'];
        $two = $_POST['TEAMTWO'];
        $date = $_POST['DATE'];
        $time = $_POST['TIME'];
        $location = $_POST['LOCATION'];


        $sql = "UPDATE log_info SET TEAMONE = '$one', TEAMTWO = '$two', DATE = '$date', TIME = '$time',Location = '$location' WHERE id = $idforLoginfo";
        mysqli_query($conn,$sql);


        $sql = "DELETE FROM report WHERE id = $idforReport";
        mysqli_query($conn,$sql);


        
    }








     // Ajax for displaying the profile table and search ASC
     if (isset($_POST['profileASC']) && $_POST['profileASC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValueforProfile']) ? $_POST['searchValueforProfile'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1200px; font-size: 11px; position: relative; left: 40px; top: 15px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                    <th scope="col" class="text-center align-middle">Profile No.</th>
                    <th scope="col" class="text-center align-middle">Profile Picture</th>
                    <th scope="col" class="text-center align-middle"  onclick = "DESC()">Fullname</th>
                    <th scope="col" class="text-center align-middle">Username</th>
                    <th scope="col" class="text-center align-middle">Password</th>
                    <th scope="col" class="text-center align-middle">Age</th>
                    <th scope="col" class="text-center align-middle">Gmail</th>
                    <th scope="col" class="text-center align-middle">Action</th>

                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM users WHERE fullname = '$value' ORDER BY fullname ASC";
        } else {
            $sql = "SELECT * FROM users ORDER BY fullname ASC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $profilePic = $row['profile'];
            $fullname = $row['fullname'];
            $username = $row['username'];
            $password =  $row['password'];
            $age = $row['age'];
            $gmail = $row['gmail'];

            if($fullname == null){
                $fullname = "no information provided";
            }

            if($age ==  0){
                $age = "no information provided";
            }

            if($gmail == null){
                $gmail= "no information provided";
            }
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">
                        <img src = "'.$profilePic.'" style = " width: 40px; height: 40px; border-radius: 50%;">
                </td>
                <td class="text-center align-middle">' . $fullname . '</td>
                <td class="text-center align-middle">' . $username . '</td>
                <td class="text-center align-middle">' . $password . '</td>
                <td class="text-center align-middle">' . $age . '</td>
                <td class="text-center align-middle">' . $gmail . '</td>
                <td class="text-center align-middle">
                       
                        <button onclick = "DeleteUserInProfile('. $id .')" class = "btn  btn-danger">DELETE</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="8" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    // query connected to Ajax for displaying the profile table and search DESC
    if (isset($_POST['profileDESC']) && $_POST['profileDESC'] == true) {
         // Check if searchValue is set and not empty
         $value = isset($_POST['searchValueforProfile']) ? $_POST['searchValueforProfile'] : NULL;
    
         echo '<div style="max-height: 400px; max-width: 1200px; font-size: 11px; position: relative; left: 40px; top: 15px; overflow-y: auto; " class="table">';
         $table = '<table class="table table-bordered table-hover">
                 <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                 <tr> 
                     <th scope="col" class="text-center align-middle">Profile No.</th>
                     <th scope="col" class="text-center align-middle">Profile Picture</th>
                     <th scope="col" class="text-center align-middle"  onclick = "ASC()">Fullname</th>
                     <th scope="col" class="text-center align-middle">Username</th>
                     <th scope="col" class="text-center align-middle">Password</th>
                     <th scope="col" class="text-center align-middle">Age</th>
                     <th scope="col" class="text-center align-middle">Gmail</th>
                     <th scope="col" class="text-center align-middle">Action</th>
 
                 </tr>
                 </thead>
                 <tbody>';
     
         if (!empty($value)) {        
             $sql = "SELECT * FROM users WHERE fullname = '$value' ORDER BY fullname DESC";
         } else {
             $sql = "SELECT * FROM users ORDER BY fullname DESC";
         }
     
         $result = mysqli_query($conn, $sql);
         $number = 1;
     
         if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
             $id = $row['id'];
             $profilePic = $row['profile'];
             $fullname = $row['fullname'];
             $username = $row['username'];
             $password =  $row['password'];
             $age = $row['age'];
             $gmail = $row['gmail'];
 
             if($fullname == null){
                 $fullname = "no information provided";
             }
 
             if($age ==  0){
                 $age = "no information provided";
             }
 
             if($gmail == null){
                 $gmail= "no information provided";
             }
           
     
             $table .= '<tr>
                 <td scope="row" class="text-center align-middle">' . $number . '</td>
                 <td scope="row" class="text-center align-middle">
                         <img src = "'.$profilePic.'" style = " width: 40px; height: 40px; border-radius: 50%;">
                 </td>
                 <td class="text-center align-middle">' . $fullname . '</td>
                 <td class="text-center align-middle">' . $username . '</td>
                 <td class="text-center align-middle">' . $password . '</td>
                 <td class="text-center align-middle">' . $age . '</td>
                 <td class="text-center align-middle">' . $gmail . '</td>
                 <td class="text-center align-middle">
                       
                         <button onclick = "DeleteUserInProfile('. $id .')" class = "btn  btn-danger">DELETE</button>
                 </td>
             </tr>';
     
             $number++;
     
     
         }
        } else {
            // If no data, display a row with "No Data Information"
            $table .= '<tr><td colspan="8" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
        }
     
         $table .= '</tbody></table>';
         echo $table;
         echo '</div>';
    }


    // query connected to ajax for deleting a profile in the profile section
    if(isset($_POST['deleteIDfromProfile'])){
        $id = $_POST['deleteIDfromProfile'];

        $sql = "DELETE FROM users WHERE id = $id";

        mysqli_query($conn,$sql);
    }





    
    
    
    





    
     //query connected to Ajax for displaying the teamScore table and search ASC
     if (isset($_POST['displayTeamScoreASC']) && $_POST['displayTeamScoreASC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "DESC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Winner</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE ASC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE ASC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
          
            $winner = "";

            if($teamOneScore == 0 && $teamTwoScore == 0){
                $winner = "Not Scored Yet";
            }else{
                if($teamOneScore >  $teamTwoScore){
                    $winner = $teamOne;
                }else if($teamOneScore < $teamTwoScore){
                    $winner = $teamTwo;
                }else if($teamOneScore == $teamTwoScore){
                    $winner = "Tied";
                }else{
                    $winner = "Error";
                }
            }
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle"> '.$winner.' </td>
                <td class="text-center align-middle">
                        <button class = "btn btn-primary" onclick = "viewScore('.$id.')">VIEW</button>
                        <button class = "btn  btn-success" onclick = "ScoringView('.$id.')">SCORE</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="8" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    //query connected to Ajax for displaying the teamScore table and search DESC
    if (isset($_POST['displayTeamScoreDESC']) && $_POST['displayTeamScoreDESC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "ASC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Winner</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE DESC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE DESC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
          
            $winner = "";

            if($teamOneScore == 0 && $teamTwoScore == 0){
                $winner = "Not Scored Yet";
            }else{
                if($teamOneScore >  $teamTwoScore){
                    $winner = $teamOne;
                }else if($teamOneScore < $teamTwoScore){
                    $winner = $teamTwo;
                }else if($teamOneScore == $teamTwoScore){
                    $winner = "Tied";
                }else{
                    $winner = "Error";
                }
            }
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle"> '.$winner.' </td>
                <td class="text-center align-middle">
                        <button class = "btn btn-primary" onclick = "viewScore('.$id.')" >VIEW</button>
                        <button class = "btn  btn-success" onclick = "ScoringView('.$id.')">SCORE</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="8" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }







     //query connected to ajax for showing the details if atu pindoton and View na button
     if(isset($_POST['view_score_id'])){
        $user_id = $_POST['view_score_id'];

        $sql = "SELECT * FROM log_info WHERE id = $user_id";
        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }

    
  
    // query connected to ajax for showing the details if atu clickon ang Score na button but wla na naka disabled and score para ma edit
     if(isset($_POST['score_id'])){
        $user_id = $_POST['score_id'];

        $sql = "SELECT * FROM log_info WHERE id = $user_id";
        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }







    //query connected to ajax for scoring it or score an event . para maka score nata and update to DB
    if(isset($_POST['toScore'])){

        $id = $_POST['toScore'];
        $teamONE = $_POST['teamOneScore'];
        $teamTWO = $_POST['teamTwoScore'];



        $sql = "UPDATE log_info SET TeamOneScore = '$teamONE', TeamTwoScore = '$teamTWO' WHERE id = $id";

        mysqli_query($conn,$sql);
    }










     // query connected to Ajax for displaying the Event List table and search ASC
     if (isset($_POST['displayEventListASC']) && $_POST['displayEventListASC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo 
            '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "DESC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE ASC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE ASC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
          
            $location = $row['LOCATION'];
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle"> '.$location.' </td>
                <td class="text-center align-middle">
                        <button class = "btn btn-success" onclick = "viewEditDatails('.$id.')">EDIT</button>
                        <button class = "btn  btn-primary" onclick = "ViewDetails('.$id.')">VIEW DETAILS</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="8" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    // query connected to Ajax for displaying the EventList table and search DESC
    if (isset($_POST['displayEventListDESC']) && $_POST['displayEventListDESC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo  
            '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "ASC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE DESC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE DESC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
          
            $location = $row['LOCATION'];
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle"> '.$location.' </td>
                <td class="text-center align-middle">
                        <button class = "btn btn-success" onclick = "viewEditDatails('.$id.')">EDIT</button>
                        <button class = "btn  btn-primary" onclick = "ViewDetails('.$id.')">VIEW DETAILS</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    } else {
        // If no data, display a row with "No Data Information"
        $table .= '<tr><td colspan="8" class="text-center" style = "font-size: 20px; letter-spacing: 4px; background-color: #d95f57;">No Data Information</td></tr>';
    }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }








     // query connected to ajax for showing the details from sa databse para ma hibaw and mga details  and sa show details sa event list AND if i click the View Details Button
     if(isset($_POST['details_id'])){
        $user_id = $_POST['details_id'];

        $sql = "SELECT * FROM log_info WHERE id = $user_id";
        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }

    
  







    //query connected to ajax for Editing Information of an event IF i click the Edit button
    if(isset($_POST['eventListid'])){
        $id = $_POST['eventListid'];

        $teamONE = $_POST['teamOne'];
        $teamTWO = $_POST['teamTwo'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];



        $sql = "UPDATE log_info SET TEAMONE = '$teamONE', TEAMTWO = '$teamTWO', DATE = '$date', TIME = '$time', LOCATION = '$location' WHERE id = $id";

        mysqli_query($conn,$sql);
    }

        

    ?>

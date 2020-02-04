<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

require "config.php";

$output = '';

// Attempt select query execution
$sql = "SELECT * FROM guest";
if(isset($_POST["search"])){
    $sql .= ' WHERE firstname LIKE "%'.$_POST["search"].'%" ';
}
    $result = mysqli_query($db, $sql);

   if(mysqli_num_rows($result) > 0){

       $output .= '
            <div id="guestTable">
            <table>
                <table class="table table-bordered table-striped"
                       <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Identification No</th>
                    <th>New Reservation</th>
                </tr>
                </thead>
            <tbody>';
       while($row = mysqli_fetch_array($result)){
           $output .= '
            <tr>
            <td>' . $row['firstname'] . '</td>
            <td>' . $row['lastname'] . '</td>
            <td>' . $row['birthDate'] . '</td>
            <td>' . $row['address'] . '</td>
            <td>' . $row['idNo'] . '</td>
            <td><button class="btn actionButton"><a href="#newReservation" data-toggle="modal"><span>Reserve</span></a></button></td>
        </tr>';
       }
       $output .= '
        </tbody>                            
        </table>
        </table>
        </div>
        </div>
        </div>
        ';
       
       echo $output;

   } else{
       echo "<p class='lead'><em>No records were found.</em></p>";
   }

?>
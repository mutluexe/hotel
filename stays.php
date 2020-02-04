<?php include('server.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hotel Dashboard</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="css/navbar.css" rel="stylesheet" type="text/css" />

        <script src="js/main.js"></script>
    </head>

    <body>
        <?php include "navbar.php"; ?>

        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Stays</b></h2>
                        </div>
                    </div>
                </div>
                <table>
                    <?php
                    // Include config file
                    require_once "config.php";                                                                                                                     

                    // Attempt select query execution
                    $sql = "SELECT guest.firstname, guest.lastname, guest.idNo, stay.checkinDate, stay.checkoutDate, stay.reservDate, room.roomNo
                                FROM guest
                                INNER JOIN stay ON guest.guestPK=stay.guestFK   
                                INNER JOIN room ON stay.roomFK=room.roomPK";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>Check in</th>";
                            echo "<th>Check out</th>";
                            echo "<th>Reservation Date</th>";
                            echo "<th>Identification No</th>";
                            echo "<th>Room No</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . $row['firstname'] . "</td>";
                                echo "<td>" . $row['lastname'] . "</td>";
                                echo "<td>" . $row['checkinDate'] . "</td>";
                                echo "<td>" . $row['checkoutDate'] . "</td>";
                                echo "<td>" . $row['reservDate'] . "</td>";
                                echo "<td>" . $row['idNo'] . "</td>";
                                echo "<td>" . $row['roomNo'] . "</td>";
                            }
                            echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>

</html>

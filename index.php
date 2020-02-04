<?php include('server.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
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

        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>

        <script src="js/main.js"></script>
    </head>

    <body>
        <?php include "navbar.php";?>
        <div class="container">
            <div class="table-wrapper"> 
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Guests</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="search_text" id="search_text" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="col-md-2">
                            <a href="#addGuest" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Guest</span></a>
                        </div>
                    </div>
                </div>
           
            
        <?php
        include "fetch_guest.php";
        ?>

        <!-- Add Guest Modal HTML -->
        <div id="addGuest" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="index.php" method="post">
                        <?php include('errors.php'); ?><br><br>
                        <div class="modal-header">
                            <h4 class="modal-title">Add Guests</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" required name="firstname">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" required name="lastname">
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" required name="birthDate">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" required name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Identification No</label>
                                <input type="number" class="form-control" required name="idNo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add" name="add_guest">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- New Reservation Modal HTML -->
        <div id="newReservation" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="index.php" method="post">
                        <?php include('errors.php'); ?><br><br>    
                        <div class="modal-header">
                            <h4 class="modal-title">New Reservation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" id='firstname' value='' name='firstname' required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" id=lastname name='lastname' value='' name='lastname' required>
                            </div>
                            <div class="form-group">
                                <label>Checkin Date</label>
                                <input type="date" class="form-control" name='checkinDate' required>
                            </div>
                            <div class="form-group">
                                <label>Checkout Date</label>
                                <input type="date" class="form-control" name='checkoutDate' required>
                            </div>
                            <div class="form-group">
                                <label>Reservation Date</label>
                                <input type="date" class="form-control" name='reservDate' required>
                            </div>
                            <div class="form-group">
                                <label>Identification No</label>
                                <input type="text" class="form-control" id='idNo' name='idNo' value='' required>
                            </div>
                            <div class="form-group">
                                <label>Room No</label>

                                <?php 
                                require "config.php";

                                $query = "SELECT roomNo FROM room";

                                if($result = mysqli_query($db, $query)){
                                    if(mysqli_num_rows($result) > 0){
                                        echo "<select name='roomNo'>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<option>" . $row['roomNo'] . "</option>";
                                        }

                                        // Free result set
                                        mysqli_free_result($result);
                                    } else {
                                        echo "<p class='lead'><em>No records were found.</em></p>";
                                    }
                                } else {
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                                }

                                echo "</select>";


                                // Close connection
                                mysqli_close($db);

                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add" name="new_reserv">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>

</html>

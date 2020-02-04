<?php
include('config.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// initializing variables
$username = "";
$email    = "";
$errors = array();

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

// LOGIN USER

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            header("location: index.php");
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
// ADD GUEST
if (isset($_POST['add_guest'])) {
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $birthDate =  date("Y-m-d", strtotime($_POST['birthDate']));
    $address = mysqli_real_escape_string($db, $_POST['address']);

    if (preg_match('/[0-9]{11}/', $_POST['idNo'])){ $idNo = $_POST['idNo'];}
    if (empty($firstname)) {array_push($errors, "First Name is required");}
    if (empty($lastname)) {array_push($errors, "Last Name is required");}
    if (empty($birthDate)) {array_push($errors, "Birth Date is required");}
    if (empty($address)) {array_push($errors, "Address is required");}
    if (empty($idNo)) {array_push($errors, "Identification Number is required");}

    // Check if id exists
    $id_check_query = "SELECT * FROM guest WHERE idNo='$idNo' LIMIT 1";
    $result = mysqli_query($db, $id_check_query);
    $id = mysqli_fetch_assoc($result);

    if ($id) {
        if($id['idNo'] === $idNo){
            array_push($errors, "Identification Number already exists");
        }
    }
    print_r($errors);
    if (count($errors) == 0) {
        $query = "INSERT INTO guest (firstname, lastname, birthDate, address, idNo) VALUES ('$firstname', '$lastname', '$birthDate', '$address', '$idNo')";
        mysqli_query($db, $query);
        header('location: index.php');
    }

}
// New Reservation
if (isset($_POST['new_reserv'])) {

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $checkinDate =  date("Y-m-d", strtotime($_POST['checkinDate']));
    $checkoutDate =  date("Y-m-d", strtotime($_POST['checkoutDate']));
    $reservDate =  date("Y-m-d", strtotime($_POST['reservDate']));
    if (preg_match('/[0-9]{11}/', $_POST['idNo'])){ $idNo = $_POST['idNo'];}
    $roomNo = $_POST['roomNo'];

    if (empty($firstname)) {array_push($errors, "First Name is required");}
    if (empty($lastname)) {array_push($errors, "Last Name is required");}
    if (empty($checkinDate)) {array_push($errors, "Check-in Date is required");}
    if (empty($checkoutDate)) {array_push($errors, "Check-out Date is required");}
    if (empty($reservDate)) {array_push($errors, "Reservation Date is required");}
    if (empty($idNo)) {array_push($errors, "Identification Number is required");}

    // Check if id not exists
    $id_check_query = "SELECT * FROM guest WHERE idNo='$idNo' LIMIT 1";
    $result = mysqli_query($db, $id_check_query);
    $id = mysqli_fetch_assoc($result);

    if ($id) {
        if($id['idNo'] !== $idNo){
            array_push($errors, "Identification Number not exists");
        }
    }


    if (count($errors) == 0) {
        // We need guestPK with the idNo that we post 
        $guestPK_query = "SELECT guestPK FROM guest WHERE idNo='$idNo'";
        $resultGuestPK = mysqli_query($db, $guestPK_query);
        $fetchGuestPK = mysqli_fetch_assoc($resultGuestPK);
        $guestPK = $fetchGuestPK['guestPK'];

        // We need this to learn which user made the reservation
        $username = $_SESSION['username'];
        $userPK_query = "SELECT user_id FROM users WHERE username='$username'";
        $resultUserPK = mysqli_query($db, $userPK_query);
        $fetchUserPK = mysqli_fetch_assoc($resultUserPK);
        $userPK = $fetchUserPK['user_id'];

        // We need roomPK with the roomNo that we post
        $roomPK_query = "SELECT roomPK FROM room WHERE roomNo='$roomNo'";
        $resultRoomPK = mysqli_query($db, $roomPK_query);
        $fetchRoomPK = mysqli_fetch_assoc($resultRoomPK);
        $roomPK = $fetchRoomPK['roomPK'];

        // We need price value of the room
        $price_query = "SELECT price FROM room WHERE roomNo='$roomNo'";
        $resultPrice = mysqli_query($db, $price_query);
        $fetchPrice = mysqli_fetch_assoc($resultPrice);
        $price = $fetchPrice['price'];

        // Insertion to stay table
        $query = "INSERT INTO stay (checkinDate, checkoutDate, reservDate, payment, roomFK, userFK, guestFK) 
                            VALUES ('$checkinDate', '$checkoutDate', '$reservDate', '$price', '$roomPK', '$userPK', '$guestPK')";
       
        mysqli_query($db, $query);
        
        // We need stayPK for the sghelper table 
        $stayPK_query = "SELECT stayPK FROM stay WHERE guestFK='$guestPK'";
        $resultStayPK = mysqli_query($db, $stayPK_query);
        $fetchStayPK = mysqli_fetch_assoc($resultStayPK);
        $stayPK = $fetchStayPK['stayPK'];
        
        // Insertion to sghelper table
        $sghelper_query = "INSERT INTO sghelper (guestFK, stayFK) VALUES ('$guestPK', '$stayPK')";
        mysqli_query($db, $sghelper_query);
        
    
    } 
}

?>

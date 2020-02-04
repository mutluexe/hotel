<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>SignUp Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- //Custom Theme files -->
        <!-- web font -->
        <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
        <!-- //web font -->
    </head>
    <body>
        <!-- main -->
        <div class="main-w3layouts wrapper">
            <h1>SignUp Form</h1>
            <div class="main-agileinfo">
                <div class="agileits-top">
                    <form action="#" method="post">
                        <?php include('errors.php'); ?><br><br>
                        <input class="text" type="text" name="username" placeholder="Username" required="">
                        <input class="text email" type="email" name="email" placeholder="Email" required="">
                        <input class="text" type="password" name="password_1" placeholder="Password" required="">
                        <input class="text w3lpass" type="password" name="password_2" placeholder="Confirm Password" required="">
                        <div class="wthree-text">
                            <label class="anim">
                                <input type="checkbox" class="checkbox" required="">
                                <span>I Agree To The Terms & Conditions</span>
                            </label>
                            <div class="clear"> </div>
                        </div>
                        <input type="submit" value="SIGNUP" name="reg_user">
                    </form>
                    <p>Already a member? <a href="login.php"> Login Now!</a></p>
                </div>
            </div>
            <!-- copyright -->
            <div class="colorlibcopy-agile">
                <p>© 2019 Signup Form. All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
            </div>
            <!-- //copyright -->
            <ul class="colorlib-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <!-- //main -->
    </body>
</html>
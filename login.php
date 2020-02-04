<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <link href="css/login.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
    <div class="login-page wrapper">
        <div class="form">
            <form class="login-form" method="post">
               <?php include('errors.php'); ?>
                <input type="text" placeholder="username" name="username" required/>
                <input type="password" placeholder="password" name="password" required/>
                <button name='login_user'>login</button>
                <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            </form>
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
		</ul>
    </div>
</body>

</html>

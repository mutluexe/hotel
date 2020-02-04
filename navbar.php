<?php
   if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}?>
   <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            </button>
            <a class="navbar-brand" href="#"><?php if(isset($_SESSION['username'])) : echo $_SESSION['username']; endif ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="stays.php">Stays</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="index.php?logout='1'">Logout</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

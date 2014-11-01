<?php
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    ?>
    <style>
        #adminpanel{
            color: black;
            padding: 10px;
            background-color: greenyellow;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
    <div id="adminpanel">
        Logged in as:
        <?php echo $_SESSION['username']?>
        <br>
        <span class="logout"><a href="PHP/logout.php">Logout</a></span>
    </div>
    <?php
}
?>
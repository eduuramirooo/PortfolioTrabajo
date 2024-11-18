<?php
    $username = $_SESSION['username'];
    echo "<div class='infoLog'>";
    echo "Welcome home $username
    </div>";
    
    include_once("form.html");
?>
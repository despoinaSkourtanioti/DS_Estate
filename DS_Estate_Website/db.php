<?php
    
    // Connection to the database
    $conn= new mysqli("localhost","root","","ds_estate");
    if ($conn->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>
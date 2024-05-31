<?php
    $mysql = new mysqli (
        'localhost', 
        'root',       
        '',    
        'cupo_db'  
        );

    if (mysqli_connect_errno()) {
        die ('Failed to connect to MySql database...');
    }else {
        echo "M-am conectat";
    }

    return $mysql;


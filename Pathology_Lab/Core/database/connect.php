<?php
    $connect_error = "Sorrey, we are having connection problem.";
    mysql_connect('localhost','root' ,'') or die($connect_error);
    mysql_select_db('pathology_lab') or die ($connect_error);
    
?>

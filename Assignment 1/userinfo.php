<?php

    $q = $_GET['q'];
    
    $filename = "log.txt";
    $content = $q;
    $test = 10;
    file_put_contents($filename, $content, FILE_APPEND);
    echo "success";
    exit;

    
?>
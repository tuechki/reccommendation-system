<?php
    $file = APPROOT . "/JSONS/file" . $data['discipline']->id . ".json";

    if(!file_exists($file)) { 
        echo "ok ";
    }else{
        die("I'm sorry, the file doesn't seem to exist.")
    };

    $type = filetype(json_encode($file));
    // Get a date and timestamp
    $today = date("F j, Y, g:i a");
    $time = time();
    // Send file headers
    header("Content-type: $type");

    //** If you think header("Content-type: $type"); is giving you some problems,
    //** try header('Content-Type: application/octet-stream');

    //** Note filename= --- if using $_GET to get the $file, it needs to be "sanitized".

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename=' . $file);
    header('Expires: 0'); //No caching allowed
    header('Cache-Control: must-revalidate');
    header('Content-Length: ' . strlen($data));
    // Send the file contents.
    set_time_limit(0);
    ob_clean();
    flush();
    readfile($file);

?>
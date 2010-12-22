<?
// this file, run by a cron job, will scan folders for .ps and .pcl files and ftp them to the internal printer's ip

error_log("[".date('h:iA n/j/y')."]  [scanning folders] \n", 3, '/printDirect/logs/cron.log');



function processIP($directory){
   // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);
    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {
        // if $file isn't this directory or its parent,
        // add it to the results array
        if ($file != '.' && $file != '..' && $file != 'CVS')
           
error_log("[".date('h:iA n/j/y')."]  [processing] [$directory] [$file] \n", 3, '/printDirect/logs/cron.log');

    }
    // tidy up: close the handler
    closedir($handler);
    // done!
}


processIP('/printDirect/192.168.100.190');
processIP('/printDirect/192.168.100.153');


error_log("[".date('h:iA n/j/y')."]  [scan complete] \n", 3, '/printDirect/logs/cron.log');


?>
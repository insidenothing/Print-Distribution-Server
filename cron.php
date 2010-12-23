<?
// this file, run by a cron job, will scan folders for .ps and .pcl files and ftp them to the internal printer's ip

error_log("[".date('h:iA n/j/y')."]  [scanning folders] \n", 3, '/printDirect/logs/cron.log');

function pushProcess($file,$remote_file,$ip){
$conn_id = ftp_connect($ip);
$login_result = ftp_login($conn_id, 'alpha', 'beta');
$remDir = "PORT1";
if (ftp_chdir($conn_id, $remDir)) {
} else {
error_log(date('r')." WARNING: ($ip) Couldn't change ftp directory ($remDir) for ($file). \n", 3, '/printDirect/logs/printer.log');
}
if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
//$last_line = system('rm -f '.$file, $retval);
error_log("[".date('h:iA n/j/y')."]  [printed] [$ip] [$file] \n", 3, '/printDirect/logs/cron.log');
//error_log(date('r')." NOTICE: $log printed successfully. \n", 3, '/logs/printer.log');
} else {
error_log(date('r')." ERROR: There was a problem while uploading $ip $file. \n", 3, '/printDirect/logs/printer.log');
}
ftp_close($conn_id);
}

function processIP($directory,$ip){
   // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);
    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {
        // if $file isn't this directory or its parent,
        // add it to the results array
        if ($file != '.' && $file != '..' && $file != 'CVS')
          //pushProcess($directory.'/'.$file,$file,$ip); 
          //MDWS Printers
          pushProcess($directory.'/'.$file,$file,'192.168.100.190'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.100.153'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.100.173'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.100.149'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.100.164'); 
          //HWA Printers
         // pushProcess($directory.'/'.$file,$file,'192.168.1.156'); 
       //   pushProcess($directory.'/'.$file,$file,'192.168.1.159'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.1.152'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.1.154'); 
      //    pushProcess($directory.'/'.$file,$file,'192.168.1.161'); 
         // pushProcess($directory.'/'.$file,$file,'192.168.1.163'); 
      //    pushProcess($directory.'/'.$file,$file,'192.168.1.190'); 

error_log("[".date('h:iA n/j/y')."]  [processing] [$directory] [$file] \n", 3, '/printDirect/logs/cron.log');

    }
    // tidy up: close the handler
    closedir($handler);
    // done!
}


processIP('/printDirect/192.168.100.190','192.168.100.190');
//processIP('/printDirect/192.168.100.153','192.168.100.153');


error_log("[".date('h:iA n/j/y')."]  [scan complete] \n", 3, '/printDirect/logs/cron.log');
$last_line = system('rm -f /printDirect/192.168.100.190/*.ps', $retval);
$last_line = system('rm -f /printDirect/192.168.100.190/*.pcl', $retval);
error_log("[".date('h:iA n/j/y')."]  [.ps / .pcl cleared] \n", 3, '/printDirect/logs/cron.log');

?>

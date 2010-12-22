<?
// this file, run by a cron job, will scan folders for .ps and .pcl files and ftp them to the internal printer's ip

error_log("[".date('h:iA n/j/y')."]  [scanning folders] \n", 3, '/printDirect/logs/cron.log');

?>
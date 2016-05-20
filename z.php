<?php

$fp = fopen("php://stdin", "r");
while (!feof($fp)) {
    $line = fgets($fp);

	
	
	error_log($line . "\n", 3, "D:/tmp/a_".date('Ymd').".txt");
}

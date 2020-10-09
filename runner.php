<?php 

include_once("AmazonDetect.php"); 

$a = new AmazonDetect(); 

print_R($a->isAmazonIp('54.245.193.29')); 


?>
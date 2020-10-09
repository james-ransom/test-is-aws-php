# test-is-aws-php
test-is-aws-php

Determine if an ip address is from amazon aws services.  This is great for detecting bots! 

https://docs.aws.amazon.com/general/latest/gr/aws-ip-ranges.html


Examples
```
<?php 

include_once("AmazonDetect.php"); 

$a = new AmazonDetect(); 

print_R($a->isAmazonIp('54.245.193.29')); 


?>

```

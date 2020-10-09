<?php

class AmazonDetect
{
    public function isAmazonIp($ip)
    {
        $ranges = $this->loadRanges();
        foreach ($ranges as $range) {
            if (self::ipInRange($ip, $range)) {
                return true;
            }
        }
        return false;
    }

    public static function ipInRange($ip, $range)
    {
        $range = $range['ip_prefix']; 
        if (strpos($range, '/') == false) {
            $range .= '/32';
        }
        // $range is in IP/CIDR format eg 127.0.0.1/24
        list ($range, $netmask) = explode('/', $range, 2);
        $range_decimal = ip2long($range);
        $ip_decimal = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal = ~ $wildcard_decimal;
        return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
    }

    public function loadRanges()
    {
        $ranges = array();
        $json = file_get_contents("https://ip-ranges.amazonaws.com/ip-ranges.json");
        $file = json_decode($json, true);
        $prefixes = array();
        foreach ($file['prefixes'] as $item) {
            $ranges[] = ($item);
        }
        return $ranges;
    }


}


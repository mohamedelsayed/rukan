<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.net
 * @copyright Copyright (c) 2016 Programming by "http://www.mohamedelsayed.net"
 */
$http_host = $_SERVER['HTTP_HOST'];
$db_host = 'localhost';
$database = 'rukan';
$username = 'root';
$password = 'root';
$http_string = "http://";
$base_url = $http_string . $http_host;
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	$database = 'elsayed_rukan';
	$username = 'elsayed_rukan';
    $password = '1p5PrxyABczu';
}
if (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
    $database = 'lifecoj0_lifecoa_chingwebsite';
	$username = 'lifecoj0_chidbus';
    $password = 'L0gmeuIn0W3';
}elseif (strpos($http_host, 'localhost') !== FALSE) {
	$base_url = $http_string . $http_host . '/myworkspace/rukan';
    if (PHP_OS == 'Linux') {
    } else {
        $password = '';
    }
}
define('DB_HOST', $db_host);
define('DB_NAME', $database);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);
define('BASE_URL', $base_url);
define('STMP_TIMEOUT', 30);
define('STMP_USERNAME', 'noreply@lifecoachingegypt.com');
define('STMP_PASSWORD', 'e9!pf_}i]ex~');
define('STMP_SERVER', 'mail.lifecoachingegypt.com');
define('STMP_PORT', 26);
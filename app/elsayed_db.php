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
if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
    $http_string = "https://";
}
$base_url = $http_string . $http_host;
if ($dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/')) {
	$base_path = $dir;
	$base_url .= $base_path;
}
$base_url = str_replace('/app/webroot', '', $base_url);
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	$database = 'elsayed_rukan';
	$username = 'elsayed_rukan';
    $password = 'xPBNZvrd8u8z';
}
if (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
    $database = 'lifecoj0_lifecoa_chingwebsite';
	$username = 'lifecoj0_chidbus';
    $password = 'L0gmeuIn0W3';	
}elseif (strpos($http_host, 'localhost') !== FALSE) {
    if (PHP_OS == 'Linux') {
    } else {
        $password = '';
    }
}
$default_image = $base_url.'/img/front/default_image.jpg';
define('DB_HOST', $db_host);
define('DB_NAME', $database);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);
define('BASE_URL', $base_url);
define('DEFAULT_IMAGE', $default_image);
define('STMP_TIMEOUT', 30);
define('STMP_USERNAME', 'noreply@lifecoachingegypt.com');
define('STMP_PASSWORD', 'e9!pf_}i]ex~');
define('STMP_SERVER', 'mail.lifecoachingegypt.com');
define('STMP_PORT', 26);
define('SMTPSECURE', FALSE);
define('SEND_STMP', FALSE);
define('AUTH_CONTROLLER_PATH', ROOT.DS.'app'.DS.'auth_controller.php');
<?php
header('Content-Type: image/gif');

if (!empty($_COOKIE['r'])) exit;
setcookie('r', 1, time()+1);

if (empty($_COOKIE['UUID'])) {
	$uuid = create_uuid();
	setcookie('UUID', $uuid, strtotime('+1 year'));
} else {
	$uuid = $_COOKIE['UUID'];
}

$time = date('Y-m-d H:i:s');
$ip = get_client_ip();
$ua = $_SERVER['HTTP_USER_AGENT'];

$allowed = array('domain','url','referrer','sw','sh');
$params = array_intersect_key($_REQUEST, array_flip($allowed));
array_unshift($params, $time, $uuid, $ip, $ua);

include __DIR__.'/1.gif';
error_log(implode("\t", $params) . "\n", 3, "D:/tmp/a_".date('Ymd').".txt");
		
function create_uuid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
    );
}
function get_client_ip() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
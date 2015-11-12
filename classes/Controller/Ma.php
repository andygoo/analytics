<?php

class Controller_Ma extends Controller {

    public function action_js() {
        header('Content-Type: text/javascript; charset=utf-8');
		include APPPATH.'media/ma.js';
		exit;
    }
    
    public function action_gif() {
        header('Content-Type: image/gif');
        header('P3P: CP=CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR');
        
        if (!empty($_COOKIE['r'])) exit;
        setcookie('r', 1, time()+1);
        
        if (empty($_COOKIE['UUID'])) {
            $uuid = create_uuid();
            setcookie('UUID', $uuid, time()+365*86400);
        } else {
            $uuid = $_COOKIE['UUID'];
        }
        
        $time = date('Y-m-d H:i:s');
        $ip = get_client_ip();
        $ua = $_SERVER['HTTP_USER_AGENT'];
        
        $allowed = array('domain','url','title','referrer','sw','sh','lang');
        $params = array_intersect_key($_REQUEST, array_flip($allowed));
        array_unshift($params, $time, $uuid, $ip, $ua);

        include APPPATH.'media/1.gif';
        
        error_log(implode("\t", $params) . "\n", 3, "D:/tmp/a_".date('Ymd').".txt");
        exit;
    }
}

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
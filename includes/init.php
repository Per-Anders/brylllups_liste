<?php

function nt($s){
	return $date = date("d.m.y H:i", strtotime($s));
}

function getAgent() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    return $agent;
}


function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}





ob_start();


require_once("classes/Models.php");













 ?>

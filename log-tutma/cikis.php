<?php
require_once 'baglan.php';

$log = $db->prepare("INSERT INTO loglar SET
    uyeid=:u,
    ip=:i,
    tarih=:t,
    aciklama=:a
");
$log->execute([
    ':u'=>$_SESSION['id'],
    ':i'=>ip(),
    ':t'=>date('Y-m-d H:i:s'),
    ':a'=>"Çıkış Yaptı"
]);
$metin = $_SESSION['id']. " ID li Kullanıcı ".ip()." Adresinden ".date('Y-m-d H:i:s')." Çıkış Yaptı\n\r";
$fp = fopen('log.txt', 'a');
fwrite($fp,$metin);
fclose($fp);
session_destroy();
header('location:giris.php');
?>
<?php
@session_start();
@ob_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=pdo-ders;charset=utf8;","root","");
    
} catch (PDOException $hata) {
    print_r($hata->getMessage());
}

$ayar = $db->prepare("SELECT *FROM ayarlar");
$ayar->execute();
$ayarrow = $ayar->fetch(PDO::FETCH_ASSOC);
$sitebaslik = $ayarrow['site_baslik'];
$sitekelime = $ayarrow['site_keyw'];
$siteaciklama = $ayarrow['site_desc'];

function tit(){
    global $db;
    global $sitebaslik;
    global $sitekelime;
    global $siteaciklama;
    $sef = @$_GET['url'];
    if($sef){
        $sorgu = $db->prepare("SELECT * FROM bloglar WHERE yazi_sef=:sef");
        $sorgu->execute([':sef'=>$sef]);
        $row =$sorgu->fetch(PDO::FETCH_ASSOC);

        $tit['baslik'] = $row['yazi_baslik']." - ".$sitebaslik;
        $tit['aciklama'] = mb_substr($row['yazi_icerik'],0,200,'utf8');
        $tit['kelimeler'] = $row['yazi_etiket'];
    }else{
        $tit['baslik'] = $sitebaslik;
        $tit['aciklama'] = $siteaciklama;
        $tit['kelimeler'] = $sitekelime;
    }
    return $tit;
}
$tit = tit();
?>
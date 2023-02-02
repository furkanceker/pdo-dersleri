<?php
require_once 'baglan.php';

if($_POST){
    $ad = $_POST['ad'];
    $konu = $_POST['konu'];
    $mesaj = $_POST['mesaj'];

    if(!$ad || !$konu || !$mesaj){
        echo "bos";
    }else{
        $gonder = $db->prepare("INSERT INTO iletisim SET ad=:a, konu=:k, mesaj=:m");
        $gonder->execute([':a'=>$ad,':k'=>$konu,':m'=>$mesaj]);
        if($gonder->rowCount()){
            echo "ok";
        }else{
            echo "hata";
        }
    }
}

?>
<?php 
require_once 'baglan.php';

if($_POST){
    $kadi = $_POST['kadi'];
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];
    $sifreli = sha1(md5($sifre));


    if(!$kadi OR !$eposta OR !$sifre){
        echo "bos";
    }else{
        if(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
            echo "eposta";
        }else{
            $varmi = $db->prepare("SELECT * FROM uyeler WHERE eposta=:e OR kadi=:k");
            $varmi->execute([':e'=>$eposta,':k'=>$kadi]);
            if($varmi->rowCount()){
                echo "var";
            }else{
                $kayit = $db->prepare("INSERT INTO uyeler SET kadi=:k,eposta=:e,sifre=:s");
                $kayit->execute([':k'=>$kadi,':e'=>$eposta,':s'=>$sifreli]);
                if($kayit){
                    echo "ok";
                }else{
                    echo "hata";
                }
            }
        }
    }
}

?>
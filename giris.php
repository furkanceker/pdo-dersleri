<?php
require_once 'baglan.php';
ob_start();
if($_POST){
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];
    $sifreli = sha1(md5($sifre));

    if(!$eposta || !$sifre){
        echo "bos";
    }else{
        if(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
            echo "eposta";
        }else{
            $giris = $db->prepare("SELECT * FROM uyeler WHERE eposta=:e AND sifre=:s");
            $giris->execute([':e'=>$eposta,':s'=>$sifreli]);
            if($giris->rowCount()){
                $row = $giris->fetch(PDO::FETCH_OBJ);

                $_SESSION['oturum'] = true;
                $_SESSION['id'] = $row->id;
                $_SESSION['adsoyad'] = $row->kadi;
                $_SESSION['eposta'] = $row->eposta;

                echo "ok";
            }else{
                echo "hata";
            }
        }
    }
}
?>
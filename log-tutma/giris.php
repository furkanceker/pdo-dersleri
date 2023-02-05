<?php
require_once 'baglan.php'; 
if(isset($_POST['giris'])){
    $kadi = strip_tags(trim($_POST['kadi']));
    $sifre = strip_tags(trim($_POST['sifre']));
    $sifreli = sha1(md5($sifre));

    if(!$kadi || !$sifre){
        echo "Boş Alan Bırakmayınız";
    }else{
        $giris = $db->prepare("SELECT * FROM uyeler WHERE kadi=:k AND sifre=:s");
        $giris->execute([':k'=>$kadi,':s'=>$sifreli]);
        if($giris->rowCount()){
            $row = $giris->fetch(PDO::FETCH_ASSOC);
            $_SESSION['oturum'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['kadi'] = $row['kadi'];

            $log = $db->prepare("INSERT INTO loglar SET
                uyeid=:u,
                ip=:i,
                tarih=:t,
                aciklama=:a
            ");
            $log->execute([
                ':u'=>$row['id'],
                ':i'=>ip(),
                ':t'=>date('Y-m-d H:i:s'),
                ':a'=>"Giriş Yaptı"
            ]);
            $metin = $row['id']. " ID li Kullanıcı ".ip()." Adresinden ".date('Y-m-d H:i:s')." Giriş Yaptı\n\r";
            $fp = fopen('log.txt', 'a');
            fwrite($fp,$metin);
            fclose($fp);
            echo "Giriş Başarılı";
            header('refresh:2;url=index.php');
        }else{
            echo "Kullanıcı Adı veya Şifre Yanlış";
        }
    }
}

?>

<form action="" method="post">
    <input type="text" name="kadi" placeholder="Kullanıcı Adı"><br>
    <input type="password" name="sifre" placeholder="Şifre"><br>
    <button type="submit" name="giris">Giriş Yap</button>
</form>
<?php
require_once 'baglan.php';

if(!isset($_SESSION['oturum'])){
    header('location:giris.php');
}
$paylasimlar = $db->prepare("SELECT * FROM paylasimlar INNER JOIN uyeler ON uyeler.id = paylasimlar.paylasan_id");
$paylasimlar->execute();
if($paylasimlar->rowCount()){
    foreach($paylasimlar as $pow){
        $begenisayisi = $db->prepare("SELECT count(*) as toplam_begeni FROM begeniler WHERE begenilen_paylasim_id=:id AND durum=:d");
        $begenisayisi->execute([':id'=>$pow['paylasim_id'],':d'=>1]);
        $begenisayirow = $begenisayisi->fetch(PDO::FETCH_ASSOC);

        $begenmemesayisi = $db->prepare("SELECT count(*) as toplam_begenmeme FROM begeniler WHERE begenilen_paylasim_id=:id AND durum=:d");
        $begenmemesayisi->execute([':id'=>$pow['paylasim_id'],':d'=>2]);
        $begenmemesayisirow = $begenmemesayisi->fetch(PDO::FETCH_ASSOC);

        echo '<b>Paylaşan Kişi :</b> '.$pow['kadi'].'<br>';
        echo '<b>Tarih :</b> '.$pow['tarih'].'<br>';
        echo '<b>İçerik :</b> '.$pow['icerik'].'<br>';
        echo 'Beğenme Sayısı ('.$begenisayirow['toplam_begeni'].") | Beğenmeme Sayısı (".$begenmemesayisirow['toplam_begenmeme'].") <br>";

        $varmi = $db->prepare("SELECT * FROM begeniler WHERE begenen_id=:id AND begenilen_paylasim_id=:pay");
        $varmi->execute([':id'=>$uid,':pay'=>$pow['paylasim_id']]);
        if($varmi->rowCount()){
            $varrow = $varmi->fetch(PDO::FETCH_ASSOC);
            if($varrow['durum'] == 1){
                echo '<a href="index.php?begenme&id='.$pow['paylasim_id'].'">Dislike</a> | <a href="index.php?oyumusil&id='.$pow['paylasim_id'].'">Oyumu Sil</a>';
            }else{
                echo '<a href="index.php?begen&id='.$pow['paylasim_id'].'">Like</a> | <a href="index.php?oyumusil&id='.$pow['paylasim_id'].'">Oyumu Sil</a>';
            }
        }else{
            echo '<a href="index.php?begen&id='.$pow['paylasim_id'].'">Like</a> | <a href="index.php?begenme&id='.$pow['paylasim_id'].'">Dislike</a>';
        }
        echo "<hr>";
    }
}else{
    echo "Paylaşım Yok";
}

if(isset($_GET['begen'])){
    $id = $_GET['id'];
    if(!$id){
        header('location:index.php');
    }else{
        $varmi = $db->prepare("SELECT * FROM begeniler WHERE begenen_id=:id AND begenilen_paylasim_id=:pay");
        $varmi->execute([':id'=>$uid,':pay'=>$id]);
        if($varmi->rowCount()){
            $begen = $db->prepare("UPDATE begeniler SET durum=:durum WHERE 
                begenen_id=:id AND begenilen_paylasim_id=:pay
                
            ");
            $begen->execute([':id'=>$uid,':pay'=>$id,':durum'=>1]);
            if($begen){
                header('location:index.php');
            }
        }else{
            $begen = $db->prepare("INSERT INTO begeniler SET
                begenen_id=:id,
                begenilen_paylasim_id=:pay,
                durum=:durum
            ");
            $begen->execute([':id'=>$uid,':pay'=>$id,':durum'=>1]);
            if($begen){
                header('location:index.php');
            }
        }
    }
}
if(isset($_GET['begenme'])){
    $id = $_GET['id'];
    if(!$id){
        header('location:index.php');
    }else{
        $varmi = $db->prepare("SELECT * FROM begeniler WHERE begenen_id=:id AND begenilen_paylasim_id=:pay");
        $varmi->execute([':id'=>$uid,':pay'=>$id]);
        if($varmi->rowCount()){
            $begen = $db->prepare("UPDATE begeniler SET durum=:durum WHERE 
                begenen_id=:id AND begenilen_paylasim_id=:pay
                
            ");
            $begen->execute([':id'=>$uid,':pay'=>$id,':durum'=>2]);
            if($begen){
                header('location:index.php');
            }
        }else{
            $begen = $db->prepare("INSERT INTO begeniler SET
                begenen_id=:id,
                begenilen_paylasim_id=:pay,
                durum=:durum
            ");
            $begen->execute([':id'=>$uid,':pay'=>$id,':durum'=>2]);
            if($begen){
                header('location:index.php');
            }
        }
    }
}

if(isset($_GET['oyumusil'])){
    $id = $_GET['id'];
    if(!$id){
        header('location:index.php');
    }else{
        $sil = $db->prepare("DELETE FROM begeniler WHERE begenilen_paylasim_id =:pay AND begenen_id=:id");
        $sil->execute([':pay'=>$id,':id'=>$uid]);
        if($sil){
            header('location:index.php');
        }
    }
}
?>
<?php 
require_once 'baglan.php';

if($_GET){
    $id = $_GET['id'];

    if(!$id){
        echo "Gelen ID Boş";
    }else{
        $sorgu = $db->prepare("SELECT * FROM dersler WHERE id=:id");
        $sorgu->execute(['id'=>$id]);
        if($sorgu->rowCount()){
            $row = $sorgu->fetch(PDO::FETCH_ASSOC);

            if($_POST){
                $baslik = strip_tags(trim($_POST['baslik']));
                if(!$baslik){
                    echo "Boş Bırakmayınız";
                }else{
                    $guncelle = $db->prepare("UPDATE dersler SET ders_adi=:baslik WHERE id=:id");
                    $guncelle->execute(['baslik'=>$baslik,'id'=>$id]);
                    if($guncelle){
                        echo "Veri Güncellendi";
                        header("refresh:1;url=listele.php");
                    }else{
                        echo "Hata Oluştu";
                    }
                }
            }
            ?>
                <form action="" method="post">
                    <input type="text" name="baslik" value="<?= $row['ders_adi']; ?>">
                    <button type="submit">Güncelle</button>
                </form>
            <?php
        }else{
            echo "Veri Bulunamadı";
        }
    }
}

?>
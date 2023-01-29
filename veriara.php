<?php
require_once 'baglan.php';
    if($_GET){
        $kelime = $_GET['kelime'];

        if(!$kelime){
            echo "Boş Arama Yapamazsınız";
        }else{
            $sorgu = $db->prepare("SELECT * FROM dersler WHERE ders_adi LIKE :baslik");
            $sorgu->execute([':baslik'=> '%'.$kelime.'%']);
            if($sorgu->rowCount()){
                echo $kelime." Kelimesine Ait ".$sorgu->rowCount()." Adet Kayıt <br>";
                foreach($sorgu as $row){
                    echo $row['ders_adi']."<br>";
                }
            }else{
                echo "Arama Sonucu Bulunamadı";
            }
        }
    }
?>

<form action="" method="get">
    <input type="text" name="kelime">
    <input type="submit" value="Ara">
</form>
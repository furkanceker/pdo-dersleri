<?php
require_once 'baglan.php';

if($_GET){

    $id = $_GET['id'];

    if(!$id){
        echo "Gelen ID Boş";
        header('refresh:1;url=listele.php');
    }else{
        $kontrol = $db->prepare("SELECT * from dersler where id=:id");
        $kontrol->execute(['id'=>$id]);
        if($kontrol->rowCount()){
            $sorgu = $db->prepare("DELETE from dersler where id=:id");
            $sorgu->execute(['id'=>$id]);
            if($sorgu){
                echo "Ders Silindi";
                header('refresh:1;url=listele.php');
            }else{
                echo "Hata Oluştu";
            }
        }else{
            echo "Ders Bulunamadı";
            header('refresh:1;url=listele.php');
        }
    }

}


?>
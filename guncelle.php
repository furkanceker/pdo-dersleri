<?php 
require_once 'baglan.php';

if($_POST){
    $id = $_POST['id'];
    $veri = $_POST['veri'];

    if(!$veri || !$id){
        echo "bos";
    }else{
        $guncelle = $db->prepare("UPDATE dersler SET ders_adi =:b WHERE id=:i");
        $guncelle->execute([':b'=>$veri,':i'=>$id]);
        if($guncelle){
            echo "ok";
        }else {
            echo "hata";
        }
    }
}

?>
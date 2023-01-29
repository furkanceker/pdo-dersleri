<?php 
require_once 'baglan.php';

if($_POST){
    $veri = $_POST['veri'];

    if(!$veri){
        echo "bos";
    }else{
        $ekle = $db->prepare("INSERT INTO dersler SET ders_adi=:b");
        $ekle->execute([':b'=>$veri]);
        if($ekle){
            echo "ok";
        }else {
            echo "hata";
        }
    }
}

?>
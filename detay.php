<?php
require_once 'baglan.php';

if($_GET){
    $id = $_GET['id'];
    $sorgu = $db->prepare("SELECT * FROM yazilar WHERE id=:i");
    $sorgu->execute([':i'=>$id]);
    if($sorgu->rowCount()){
        $row = $sorgu->fetch(PDO::FETCH_ASSOC);
        $goruntulenme = @$_COOKIE[$row['id']];
        if(!$goruntulenme){
            $update = $db->prepare("UPDATE yazilar SET goruntulenme=:g WHERE id=:i");
            $update->execute([':i'=>$id,':g'=>$row['goruntulenme']+1]);
            setcookie($row['id'],"1",time()+3600);
        }

        echo $row['baslik'];
        echo "<hr>";
        echo $row['icerik'];
        echo "<hr>";
        echo $row['goruntulenme']."<b> Görüntülenme</b>";
    }else{
        header('location:hit.php');
    }
}else{
    header('location:hit.php');
}

?>
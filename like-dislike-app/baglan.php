<?php
@session_start();
@ob_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=pdo-ders;charset=utf8;","root","");
    
} catch (PDOException $hata) {
    print_r($hata->getMessage());
}
if(isset($_SESSION['oturum'])){
    $girisyapanuye = $db->prepare('SELECT * FROM uyeler WHERE id=:i');
    $girisyapanuye->execute([':i'=>$_SESSION['id']]);
    if($girisyapanuye->rowCount()){
        $uyerow = $girisyapanuye->fetch(PDO::FETCH_ASSOC);
        $uid = $uyerow['id'];
        $ukadi = $uyerow['kadi'];
    }
}
?>
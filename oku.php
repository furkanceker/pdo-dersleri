<?php require_once 'baglan.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tit['baslik']; ?></title>
    <meta name="keywords" content="<?= $tit['kelimeler']; ?>">
    <meta name="description" content="<?= $tit['aciklama']; ?>">
</head>
<body>
    <?php
        if(isset($_GET['url'])){
            $url = $_GET['url'];

            $sorgu = $db->prepare("SELECT * FROM bloglar WHERE yazi_sef =:sef");
            $sorgu->execute(array(':sef'=>$url));
            if($sorgu->rowCount()){
                $row = $sorgu->fetch(PDO::FETCH_OBJ);
                echo $row->yazi_baslik;
                echo "<br><br>";
                echo $row->yazi_icerik;
                echo "<hr>";
                echo "<b>Etiketler</b> : ".$row->yazi_etiket;
            }else{
                header('location:yazi.php');
            }
        }

    ?>
</body>
</html>
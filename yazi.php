<?php require_once 'baglan.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tit['baslik']; ?></title>
    <meta name="keywords" content="<?= $tit['kelimeler']; ?>">
    <meta name="description" content="<?= $tit['aciklama'];; ?>">
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Başlık</th>
            <th>İşlemler</th>
        </tr>
        <?php
            $sorgu = $db->prepare("SELECT * FROM bloglar");
            $sorgu->execute();
            if($sorgu->rowCount()){
                foreach($sorgu as $row){
                    ?>
                        <tr>
                            <td><?= $row['yazi_id'] ?></td>
                            <td><?= $row['yazi_baslik'] ?></td>
                            <td><a href="oku.php?url=<?= $row['yazi_sef'] ?>">İçeriği Oku</a></td>
                        </tr>
                    <?php
                }
            }else{
                echo "Henüz Yazı Eklenmedi";
            }
        ?>
    </table>
</body>
</html>
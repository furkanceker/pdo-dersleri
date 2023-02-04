<?php require_once 'baglan.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplu Veri Silme</title>
</head>
<body>

    <?php
    if($_POST){
        $sil = $_POST['sil'];
        $birlestir = implode(',',$sil);
        $sil = $db->prepare("DELETE FROM dersler WHERE id IN(".$birlestir.")");
        $sil->execute();
        if($sil){
                header('location:toplusil.php');
        }else{
            echo "Hata Oluştu";
        }
        /* foreach($sil as $id){
            $sil = $db->prepare("DELETE FROM dersler WHERE id=:i");
            $sil->execute([':i'=>$id]);
            if($sil){
                header('location:index.php');
            }else{
                echo "Hata Oluştu";
            }
        } */
    }
    
    ?>
    <?php
        $sorgu = $db->prepare("SELECT * FROM dersler");
        $sorgu->execute();
        if($sorgu->rowCount()){
            ?>
            <form action="" method="post">
            <table>
                <tr>
                    <th>SEÇ</th>
                    <th>ID</th>
                    <th>DERS ADI</th>
                </tr>
                <?php
                    foreach($sorgu as $row){
                        ?>
                            <tr>
                                <td><input type="checkbox" name="sil[]" value="<?= $row['id'] ?>"></td>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['ders_adi'] ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
            <button type="submit">Toplu Sil</button>
            </form>
            <?php
        }
    ?>
</body>
</html>
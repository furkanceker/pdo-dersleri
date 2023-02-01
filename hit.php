<?php
require_once 'baglan.php';

$yazilar = $db->prepare("SELECT * FROM yazilar");
$yazilar->execute();
if($yazilar->rowCount()){
    ?>
        <table border="1">
            <thead>
            <tr>
                <th>ID</th>
                <th>BAŞLIK</th>
                <th>İŞLEM</th>
            </tr>
            </thead>
            <tbody>
    <?php
    foreach($yazilar as $row){
        ?>
             <tr>
                <th><?= $row['id']; ?></th>
                <th><?= $row['baslik']; ?></th>
                <th><a href="detay.php?id=<?= $row['id']; ?>">İçeriği Gör</a></th>
            </tr>
        <?php 
    }
    echo "</tbody></table>";
}else{
    echo "Henüz Yazı Eklenmedi";
}

?>
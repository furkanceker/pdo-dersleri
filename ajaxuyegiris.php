<?php 
require_once 'baglan.php'; 
if(isset($_GET['cikis'])){
    session_destroy();
    header('location:ajaxuyegiris.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <script src="sweetalert2.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Ajax Üye Giriş</title>
  </head>
  <body>
    <div class="container">
        <script>
            function login(){
                var veri = $("#giris").serialize();

                $.ajax({
                    type : "POST",
                    data : veri,
                    url : "giris.php",
                    success : function(data){
                        if($.trim(data) == "bos"){
                            Swal.fire({
                                title: 'Hata!',
                                text: 'Boş Alanları Doldurun',
                                icon: 'error',
                                confirmButtonText: 'Tamam'
                            })
                        }else if($.trim(data)== "ok"){
                            Swal.fire({
                                title: 'Başarılı!',
                                text: 'Giriş Başarılı',
                                icon: 'success',
                                confirmButtonText: 'Tamam'
                            })
                        }else if($.trim(data)== "hata"){
                            Swal.fire({
                                title: 'Hata!',
                                text: 'Giriş Başarısız',
                                icon: 'error',
                                confirmButtonText: 'Tamam'
                            })
                        }else if($.trim(data)== "eposta"){
                            Swal.fire({
                                title: 'Hata!',
                                text: 'Geçersiz E-Posta Adresi',
                                icon: 'error',
                                confirmButtonText: 'Tamam'
                            })
                        }
                    }
                });
            }
        </script>
        <div class="col-6 mt-5">
            <?php if(!isset($_SESSION['oturum'])) { ?>
            <form action="" id="giris" method="post" onsubmit="return false;" >

                <input type="email" name="eposta" class="form-control mb-3" placeholder="Email">
                <input type="password" name="sifre" class="form-control mb-3" placeholder="Şifre">

                <button type="submit" onclick="login();" class="btn btn-success">Giriş Yap</button>
            </form>
            <?php } else { 
                
                echo "<b>".$_SESSION['adsoyad']."</b> Hoşgeldin | <a href='ajaxuyegiris.php?cikis'>Çıkış Yap</a>";  
                $dersler = $db->prepare("SELECT * FROM dersler");
                $dersler->execute();
                if($dersler->rowCount()){

                    ?>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>DERS ID</th>
                                    <th>DERS ADI</th>
                                    <th>İŞLEMLER</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    foreach($dersler as $row){
                        ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['ders_adi']; ?></td>
                                <td>
                                    <?php
                                        $sorgu = $db->prepare("SELECT * FROM favoriler WHERE favori_ekleyen=:e AND favori_eklenen_ders=:d");
                                        $sorgu->execute([':e'=>$_SESSION['id'],':d'=>$row['id']]);
                                        if($sorgu->rowCount()){
                                            ?>                           
                                                <a href="favoriekle.php?cikar=<?= $row['id']; ?>" class="btn btn-danger">Favorilerden Çıkar</a>
                                            <?php
                                        }else{
                                            ?>
                                                <a href="favoriekle.php?id=<?= $row['id']; ?>" class="btn btn-success">Favorilere Ekle</a> 
                                            <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php
                    }
                    echo "</tbody></table>";
                }
            }
            ?>
        </div>
    </div>

    
  </body>
</html>
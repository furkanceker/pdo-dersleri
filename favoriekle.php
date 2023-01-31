<?php 
require_once 'baglan.php'; 
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
    <title>FAVORİ EKLEME</title>
  </head>
  <body>
    <div class="container">
        
        <div class="col-6 mt-5">
            <?php
                if(isset($_GET['cikar'])){
                    if(isset($_SESSION['oturum'])){
                    $ders_id = $_GET['cikar'];
                    $uyeid = @$_SESSION['id'];
                    if(!$ders_id){
                        header('Location:ajaxuyegiris.php');
                    }else{
                        $varmi = $db->prepare("SELECT * FROM favoriler WHERE favori_eklenen_ders=:d AND favori_ekleyen=:e");
                        $varmi->execute([':d'=>$ders_id,':e'=>$uyeid]);
                        if($varmi->rowCount()){
                            $sil = $db->prepare("DELETE FROM favoriler WHERE favori_eklenen_ders=:d AND favori_ekleyen=:e");
                            $sil->execute([':d'=>$ders_id,':e'=>$uyeid]);
                            if($sil){
                                echo "<div class='alert alert-success'>Ders Favorilerden Çıkarıldı</div>";
                                header('refresh:2;url=ajaxuyegiris.php');
                            }else{
                                echo "<div class='alert alert-danger'>Hata Oluştu</div>";
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Ders Bulunamadı</div>";
                            header('refresh:2;url=ajaxuyegiris.php');
                        }
                    }
                }else{
                    echo "<div class='alert alert-danger'>Oturum Açmalısınız</div>";
                }
                }
                if(isset($_GET['id'])){
                    if(isset($_SESSION['oturum'])){
                    $ders_id = @$_GET['id'];
                    $uyeid = @$_SESSION['id'];
                    if(!$ders_id){
                        header('Location:ajaxuyegiris.php');
                    }else{
                        $varmi = $db->prepare("SELECT * FROM favoriler WHERE favori_eklenen_ders=:d AND favori_ekleyen=:e");
                        $varmi->execute([':d'=>$ders_id,':e'=>$uyeid]);
                        if($varmi->rowCount()){
                            echo "<div class='alert alert-danger'>Ders Zaten Kayıtlı</div>";
                            header('refresh:2;url=ajaxuyegiris.php');
                        }else{
                            $ekle = $db->prepare("INSERT INTO favoriler SET
                            favori_ekleyen =:ekleyen,
                            favori_eklenen_ders =:ders
                            ");
                            $ekle->execute(array(':ekleyen'=>$uyeid,':ders'=>$ders_id));
                            if($ekle){
                                echo "<div class='alert alert-success'>Ders Favorilere Eklendi</div>";
                                header('refresh:2;url=ajaxuyegiris.php');
                            }else{
                                echo "<div class='alert alert-danger'>Hata Oluştu</div>";
                            }
                        }
                    }
                }else{
                    echo "<div class='alert alert-danger'>Oturum Açmalısınız</div>";
                }
                }
            ?>
        </div>
    </div>

    
  </body>
</html>
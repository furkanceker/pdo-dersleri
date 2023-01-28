<?php
require_once 'baglan.php';
if($_POST){
    $dersadi = strip_tags(trim($_POST['dersadi']));
    if(!$dersadi){
        echo "<div class='alert alert-danger'>Boş Alan Bırakmayınız</div>";
    }else{
        $ekle = $db->prepare("INSERT INTO dersler SET ders_adi=:d");
        $ekle->execute([':d'=>$dersadi]);
        if($ekle){
            echo "<div class='alert alert-success'>Ekleme Başarılı</div>";
        }else{
            echo "<div class='alert alert-danger'>Ekleme Başarısız</div>";
        }
    }

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

    <title>PDO ile Veri Ekleme</title>
  </head>
  <body>
    <div class="container">
        <div class="col-6">
        <form method="post" action="">
            <div class="form-group">
                <label for="dersadi">Ders Adı</label>
                <input type="text" class="form-control" id="dersadi" name="dersadi" placeholder="Ders Adı Girin">
            </div>
            <button type="submit" class="btn btn-primary">Ders Ekle</button>
        </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
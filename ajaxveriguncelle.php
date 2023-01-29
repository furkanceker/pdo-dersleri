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
    <title>Ajax Veri Güncelleme</title>
  </head>
  <body>
    <div class="container">
        <script>
            function update(){
                var veri = $("#guncelle").serialize();

                $.ajax({
                    type : "POST",
                    data : veri,
                    url : "guncelle.php",
                    success : function(data){
                        if($.trim(data) == "bos"){
                            Swal.fire({
                                title: 'Hata!',
                                text: 'Veri Boş Olamaz',
                                icon: 'error',
                                confirmButtonText: 'Tamam'
                            })
                        }else if($.trim(data)== "ok"){
                            Swal.fire({
                                title: 'Başarılı!',
                                text: 'Güncelleme İşlemi Başarılı',
                                icon: 'success',
                                confirmButtonText: 'Tamam'
                            })
                        }else if($.trim(data)== "hata"){
                            Swal.fire({
                                title: 'Hata!',
                                text: 'Güncelleme İşlemi Başarısız',
                                icon: 'error',
                                confirmButtonText: 'Tamam'
                            })
                        }
                    }
                });
            }
        </script>
        <div class="col-6 mt-5">
            <form action="" id="guncelle" method="post" onsubmit="return false;" >
                <select name="id" class="form-control mb-3">
                    <option value="0">ID SEÇİN</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>

                </select>
                <input type="text" name="veri" class="form-control mb-3">

                <button type="submit" onclick="update();" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>

    
  </body>
</html>
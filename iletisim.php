<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Ajax İletişim Formu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-3">
                <script>
                    function send(){
                        var deger = $("#iletisim").serialize();

                        $.ajax({
                            type:"post",
                            data:deger,
                            url:"gonder.php",
                            success:function(data){
                                if($.trim(data) == "bos"){
                                    Swal.fire({
                                        title: 'Hata!',
                                        text: 'Boş Alanları Doldurun',
                                        icon: 'error',
                                        confirmButtonText: 'Tamam'
                                    })
                                }else if($.trim(data) == "hata"){
                                    Swal.fire({
                                        title: 'Hata!',
                                        text: 'Bir Hata Oluştu',
                                        icon: 'error',
                                        confirmButtonText: 'Tamam'
                                    })
                                }else if($.trim(data) == "ok"){
                                    Swal.fire({
                                        title: 'Başarılı!',
                                        text: 'Mesaj Gönderildi',
                                        icon: 'success',
                                        confirmButtonText: 'Tamam'
                                    })
                                }
                            }
                        })
                    }
                </script>
                <form action="" method="post" onsubmit="return false;" id="iletisim">
                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input type="text" name="ad" class="form-control" placeholder="Adınız">
                    </div>
                    <div class="form-group">
                        <label>Konu</label>
                        <input type="text" name="konu" class="form-control" placeholder="Konu">
                    </div>
                    <div class="form-group">
                        <label>Mesaj</label>
                        <textarea name="mesaj" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" onclick="send();" class="btn btn-success">Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
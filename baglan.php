<?php
@session_start();
@ob_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=pdo-ders;charset=utf8;","root","");
    
} catch (PDOException $hata) {
    print_r($hata->getMessage());
}
?>
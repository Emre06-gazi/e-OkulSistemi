<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Öğretemen ID'sini alma
    $teacherId = isset($_POST['id']) ? $_POST['id'] : null;

    // Diğer gelen verileri alma
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    $dersAdi = $_POST['dersAdi'];

    // Güncelleme sorguları
    $sql_ogretmen = "UPDATE ogretmen SET ad_soyad='$ad_soyad', email='$email', sifre='$sifre', dersAdi='$dersAdi' WHERE id=$teacherId";
    $sql_kullanici = "UPDATE kullanici SET kullanici_adi='$ad_soyad', sifre='$sifre', email='$email', rol='$dersAdi' WHERE id=$teacherId";

    // İki sorguyu da gerçekleştir
    if ($conn->query($sql_ogretmen) === TRUE && $conn->query($sql_kullanici) === TRUE) {
        // Başarılı bir şekilde güncellendiğinde bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
        echo "Başarıyla güncellendi.";
    } else {
        // Hata durumunda bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
        echo "Güncelleme hatası: " . $conn->error;
    }
} else {
    // POST isteği olmadan doğrudan bu sayfaya erişim durumunda bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Geçersiz istek.";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

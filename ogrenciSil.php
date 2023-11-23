<?php
include 'database.php';

// Öğrenci ID'sini alma
$studentId = isset($_GET['id']) ? $_GET['id'] : null;

// Öğrenciyi ve kullanıcıyı silme sorguları
$sql_ogrenci = "DELETE FROM ogrenci WHERE id = $studentId";
$sql_kullanici = "DELETE FROM kullanici WHERE id = $studentId";

// İki sorguyu da gerçekleştir
if ($conn->query($sql_ogrenci) === TRUE && $conn->query($sql_kullanici) === TRUE) {
    // Başarılı bir şekilde silindiğinde bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Öğrenci ve kullanıcı başarıyla silindi.";
} else {
    // Hata durumunda bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Silme hatası: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

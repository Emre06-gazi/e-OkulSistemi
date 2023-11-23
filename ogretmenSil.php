<?php
include 'database.php';

// Öğretemen ID'sini alma
$teacherId = isset($_GET['id']) ? $_GET['id'] : null;

// Öğretemen ve kullanıcıyı silme sorguları
$sql_ogretmen = "DELETE FROM ogretmen WHERE id = $teacherId";
$sql_kullanici = "DELETE FROM kullanici WHERE id = $teacherId";

// İki sorguyu da gerçekleştir
if ($conn->query($sql_ogretmen) === TRUE && $conn->query($sql_kullanici) === TRUE) {
    // Başarılı bir şekilde silindiğinde bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Öğrenci ve kullanıcı başarıyla silindi.";
} else {
    // Hata durumunda bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Silme hatası: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

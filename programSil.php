<?php
include 'database.php';

// Programı silme sorguları
$sql_program = "DELETE FROM ders_programi";

// İki sorguyu da gerçekleştir
if ($conn->query($sql_program) === TRUE) {
    // Başarılı bir şekilde silindiğinde bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Ders Programı başarıyla silindi ve yeniden oluşturuldu!";
    
} else {
    // Hata durumunda bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
    echo "Silme hatası: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

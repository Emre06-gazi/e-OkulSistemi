<?php
include 'database.php';

// Formdan gelen verileri al
$gonderenId = 36; // Sabit olarak gonderen_id'yi ayarla
$konu = $_POST['konu'];
$mesaj = $_POST['mesaj'];
$aliciTipi = $_POST['alici_tipi'];

// Alıcıları belirle
switch ($aliciTipi) {
    case 'TUMU':
        $aliciSql = "SELECT id FROM kullanici";
        break;
    case 'OGRENCILER':
        $aliciSql = "SELECT id FROM kullanici WHERE rol = '2'";
        break;
    case 'OGRETMENLER':
        $aliciSql = "SELECT id FROM kullanici WHERE rol = '1'";
        break;
    default:
        echo "Geçersiz alıcı tipi!";
        exit();
}

$aliciResult = $conn->query($aliciSql);

if ($aliciResult->num_rows > 0) {
    while ($aliciRow = $aliciResult->fetch_assoc()) {
        $aliciId = $aliciRow['id'];

        // Mesajı veritabanına ekle
        $insertMessageSql = "INSERT INTO mesajlar (gonderen_id, alici_id, konu, mesaj) VALUES ('$gonderenId', '$aliciId', '$konu', '$mesaj')";
        if ($conn->query($insertMessageSql) === FALSE) {
            echo "<p class='error-message'>Hata: " . $insertMessageSql . "<br>" . $conn->error . "</p>";
        }
    }

    echo "<p class='success-message'>Mesajlar başarıyla gönderildi.</p>";
} else {
    echo "<p class='error-message'>Alıcı bulunamadı.</p>";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

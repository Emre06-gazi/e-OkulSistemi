<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ogrenciId = $_POST['ogrenci_id'];
    $s1 = $_POST['s1'];
    $s2 = $_POST['s2'];
    $proje = $_POST['proje'];

    // Ortalama puanı hesapla
    $ortalama = ($s1 + $s2 + $proje) / 3;

    // Notları güncelle
    $updateQuery = "UPDATE sınav SET s1 = $s1, s2 = $s2, proje = $proje, ortalama = $ortalama WHERE ogrenci_id = $ogrenciId";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Notlar başarıyla güncellendi.";
    } else {
        echo "Hata: " . $conn->error;
    }

    $conn->close();
}
?>

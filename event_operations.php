<?php
include "database.php";

// POST verilerini alın
$eventDate = date('Y-m-d', strtotime($_POST['eventDate']));
$eventName = $_POST['eventName'];
$eventHour = $_POST['eventHour'];

// SQL sorgusunu oluşturun ve çalıştırın (etkinlik ekleme)
$sql = "INSERT INTO events (event_date, event_name, event_hour) VALUES ('$eventDate', '$eventName', '$eventHour')";

if ($conn->query($sql) === TRUE) {
    echo "Etkinlik başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatın
$conn->close();
?>

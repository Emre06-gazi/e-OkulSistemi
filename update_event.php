<?php
include 'database.php';

// POST verilerini al
$eventName = $_POST['eventName'];
$eventDate = date('Y-m-d', strtotime($_POST['eventDate']));
$eventHour = $_POST['eventHour'];
$selectedDate = $_POST['selectedDate'];

// Güncelleme sorgusu
$sql = "UPDATE events SET event_name='$eventName', event_date='$eventDate', event_hour='$eventHour' WHERE event_date='$selectedDate'";

// Sorguyu çalıştır
if ($conn->query($sql) === TRUE) {
    echo "Etkinlik güncellendi. Tarih: $eventDate";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

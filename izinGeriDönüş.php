<?php
include 'database.php';

// İzin onayı veya reddi gönderilmiş mi kontrolü
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen veriler
    $izinId = $_POST["izin_id"];
    $onayDurumu = $_POST["onay_durumu"];

    // İzin tablosunda güncelleme yap
    $updateSql = "UPDATE izin_tablosu SET onay_durumu = '$onayDurumu' WHERE id = '$izinId'";
    if ($conn->query($updateSql) === TRUE) {
        // Kullanıcıya bildirim gönder
        $bildirim = ($onayDurumu == 1) ? "İzin tarihiniz onaylandı!" : "İzin tarihiniz onaylanmadı!";

        // İzin talebini gönderen kullanıcının ID'sini al
        $selectUserIdSql = "SELECT kullanici_id FROM izin_tablosu WHERE id = '$izinId'";
        $result = $conn->query($selectUserIdSql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $gonderenId = $row["kullanici_id"]; // Kullanıcı ID'sini al

            // Kullanıcıya mesaj gönder
            $insertMessageSql = "INSERT INTO mesajlar (gonderen_id, alici_id, mesaj) VALUES ('36', '$gonderenId', '$bildirim')";
            if ($conn->query($insertMessageSql) === FALSE) {
                echo "<p class='error-message'>Hata: " . $insertMessageSql . "<br>" . $conn->error . "</p>";
            } else {
                // İzin tablosundan izni sil
                $deleteIzinSql = "DELETE FROM izin_tablosu WHERE id = '$izinId'";
                if ($conn->query($deleteIzinSql) === FALSE) {
                    echo "<p class='error-message'>Hata: " . $deleteIzinSql . "<br>" . $conn->error . "</p>";
                } else {
                    // Bildirimi göster
                    echo "<p class='success-message'>$bildirim</p>";
                    // İzinler sayfasına yönlendirme yap
                    header("Location: izinler.php");
                    exit();
                }
            }
        }
    } else {
        echo "<p class='error-message'>Hata: " . $updateSql . "<br>" . $conn->error . "</p>";
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

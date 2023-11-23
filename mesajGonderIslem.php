<?php
session_start();

// Kullanıcının oturum açık mı kontrol et
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Eğer oturum açık değilse giriş sayfasına yönlendir
    exit();
}

// Gönderen kişinin ID'sini al
$gonderenId = $_SESSION['id'];

// Formdan gelen verileri al
$aliciId = $_POST['aliciId'];
$mesaj = $_POST['mesaj'];
$konu = $_POST['konu'];

// Veritabanı bağlantısını ekleyin
include 'database.php';

// Mesajı veritabanına ekle
$insertMesajSql = "INSERT INTO mesajlar (gonderen_id, alici_id, mesaj, konu) VALUES ('$gonderenId', '$aliciId', '$mesaj', '$konu')";

if ($conn->query($insertMesajSql) === TRUE) {
    // Mesaj gönderildiğinde başarılı bir şekilde yönlendir

    // Kullanıcının rolüne göre yönlendirme yap
    $selectRoleSql = "SELECT rol FROM kullanici WHERE id = '$gonderenId'";
    $result = $conn->query($selectRoleSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rol = $row['rol'];

        switch ($rol) {
            case 0:
                header("Location: müdür.php");
                break;
            case 1:
                header("Location: ogretmenProfili.php");
                break;
            case 2:
                header("Location: ogrenciProfili.php");
                break;
            default:
                header("Location: ogrenciMesajlar.php");
                break;
        }
    } else {
        header("Location: ogrenciMesajlar.php");
    }

    exit();
} else {
    // Hata durumunda hata mesajını göster
    echo "Error: " . $insertMesajSql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

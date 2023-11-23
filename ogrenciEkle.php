<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Ekle</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .back-button {
            background-color: #333;
        }
    </style>
</head>
<body>

<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alma
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    $sinif = $_POST['sinif'];

    // Veritabanına öğrenci ekleme sorgusu
    $sql_ogrenci = "INSERT INTO ogrenci (ad_soyad, email, sifre, sinif) VALUES ('$ad_soyad', '$email', '$sifre', '$sinif')";

    if ($conn->query($sql_ogrenci) === TRUE) {

        // Öğrenci eklendikten sonra kullanıcılar tablosuna da ekleme sorgusu
        $sql_kullanici = "INSERT INTO kullanici (kullanici_adi, sifre, email, rol) VALUES ('$ad_soyad', '$sifre', '$email', 2)";

        if ($conn->query($sql_kullanici) === TRUE) {
            echo "<h1>Kullanıcı Başarıyla Eklendi</h1>";
        } else {
            echo "Kullanıcı ekleme hatası: " . $conn->error;
        }

    } else {
        echo "Öğrenci ekleme hatası: " . $conn->error;
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

<button class="back-button" onclick="goBack()">←</button>
<h1>Öğrenci Ekle</h1>

<form method="post">
    <title>Öğrenci Ekle</title>
    <label for="ad_soyad">Ad Soyad:</label>
    <input type="text" name="ad_soyad" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="sifre">Şifre:</label>
    <input type="password" name="sifre" required>

    <label for="sinif">Sınıf:</label>
    <input type="text" name="sinif" required>

    <button type="submit">Öğrenci Ekle</button>
</form>

<script>
    // Geri butonu için JavaScript fonksiyonu
    function goBack() {
        window.location.href = "ogrenciler.php";
    }
</script>
</body>
</html>

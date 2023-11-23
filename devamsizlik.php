<?php
// Veritabanı bağlantısı ve diğer gerekli dosyaların include edilmesi
include 'database.php';

// SINIF_ID'nin doğru bir değerle değiştirilmesi
$sinif_id = isset($_POST['sinif_id']) ? $_POST['sinif_id'] : '';

// Güncelleme mesajının saklanacağı değişken
$updateMessage = '';

// Güncelleme formu gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ogrenci_id']) && isset($_POST['devamsizlik_suresi'])) {
    // POST verilerini al
    $ogrenciId = $_POST['ogrenci_id'];
    $devamsizlikSuresi = $_POST['devamsizlik_suresi'];

    // Devamsızlık tablosunda öğrenci için kayıt var mı kontrol et
    $checkQuery = "SELECT * FROM devamsizlik WHERE ogrenci_id = '$ogrenciId'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Öğrenci için kayıt varsa güncelle
        $updateQuery = "UPDATE devamsizlik SET devamsizlik_suresi = '$devamsizlikSuresi' WHERE ogrenci_id = '$ogrenciId'";
    } else {
        // Öğrenci için kayıt yoksa ekle
        $updateQuery = "INSERT INTO devamsizlik (ogrenci_id, devamsizlik_suresi) VALUES ('$ogrenciId', '$devamsizlikSuresi')";
    }

    if ($conn->query($updateQuery) === TRUE) {
        $updateMessage = "Güncelleme başarıyla eklendi.";

        // Bu kısmı ekleyin: Güncelleme yapıldıktan sonra sayfayı yeniden yükle
        echo '<script>';
        echo 'window.location.href = window.location.href;';
        echo '</script>';
    } else {
        $updateMessage = "Hata: " . $updateQuery . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrencilerin Devamsızlık Bilgisi</title>
    <style>
        /* CSS stilleri buraya eklenebilir */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .update-button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .red-text {
            color: red;
        }

        .update-form {
            display: none;
            margin-top: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .update-form input {
            padding: 8px;
            margin-right: 10px;
        }

        .update-form button {
            background-color: #28a745;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Geçişli siyah örtü */
            z-index: 1;
        }

        .back-button {
            background-color: #333;
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .listele-button {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 10px 10px;
            text-decoration: none;
            display: inline-block;
            font-size: 10px;
            cursor: pointer;
            border-radius: 12px;
        }

        .listele-form {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <button class="back-button" onclick="goBack()">←</button>
    <h1>Öğrencilerin Devamsızlık Bilgisi</h1>
    <form method="post" action="" class="listele-form">
        <label for="sinif_id">Sınıf Seçiniz:</label>
        <select name="sinif_id" required>
            <option value="1. Sınıf">1. Sınıf</option>
            <option value="2. Sınıf">2. Sınıf</option>
            <option value="3. Sınıf">3. Sınıf</option>
        </select>
        <button class="listele-button" type="submit">Listele</button>
    </form>
    <?php
    echo "<p>$updateMessage</p>";

    // Sınıf bilgisini getir
    $sinifAdi = getSinifAdi($sinif_id);

    // Öğrenci ve Devamsızlık tablolarının birleştirilmiş sorgusu
    $query = "SELECT ogrenci.id AS ogrenci_id, ogrenci.ad_soyad AS ogrenci_adi, devamsizlik.devamsizlik_suresi
            FROM ogrenci
            LEFT JOIN devamsizlik ON ogrenci.id = devamsizlik.ogrenci_id
            WHERE ogrenci.sinif = '$sinif_id'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th colspan='3'>$sinifAdi Öğrencilerinin Devamsızlık Bilgisi</th></tr>";
        echo "<tr><th>Öğrenci Adı</th><th>Devamsızlık Süresi</th><th>Devamsızlık Güncelle</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $ogrenciId = $row["ogrenci_id"];
            $ogrenciAdi = $row["ogrenci_adi"];
            $devamsizlikSuresi = $row["devamsizlik_suresi"];

            echo "<tr>";
            echo "<td>$ogrenciAdi</td>";

            // Devamsızlık süresini kırmızı renkte gösterme kontrolü
            $devamsizlikClass = ($devamsizlikSuresi > 10) ? "red-text" : "";
            echo "<td class='$devamsizlikClass'>$devamsizlikSuresi</td>";

            // Güncelle butonu
            echo "<td><button class='update-button' onclick='showUpdateForm($ogrenciId, $devamsizlikSuresi)'>Güncelle</button></td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "";
    }

    // Sınıf adını getiren fonksiyon
    function getSinifAdi($sinif_id)
    {
        switch ($sinif_id) {
            case '1. Sınıf':
                return '1. Sınıf';
            case '2. Sınıf':
                return '2. Sınıf';
            case '3. Sınıf':
                return '3. Sınıf';
            default:
                return 'Bilinmeyen Sınıf';
        }
    }
    ?>

    <div id="update-form" class="update-form">
        <h2>Devamsızlık Güncelle</h2>
        <form method="post" action="">
            <input type="hidden" id="ogrenci_id" name="ogrenci_id">
            <label for="devamsizlik_suresi">Devamsızlık Süresi:</label>
            <input type="text" id="devamsizlik_suresi" name="devamsizlik_suresi" required>
            <button type="submit">Güncelle</button>
            <button type="button" class="close-button" onclick="hideUpdateForm()">Kapat</button>
        </form>
    </div>

    <div id="overlay" class="overlay" onclick="hideUpdateForm()"></div>

    <script>
        // Öğrencinin devamsızlık bilgisini güncellemek için JavaScript fonksiyonu
        function showUpdateForm(ogrenciId, devamsizlikSuresi) {
            document.getElementById('ogrenci_id').value = ogrenciId;
            document.getElementById('devamsizlik_suresi').value = devamsizlikSuresi;
            document.getElementById('update-form').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function hideUpdateForm() {
            document.getElementById('update-form').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function goBack() {
            window.location.href = "ogretmenProfili.php";
        }
    </script>
</body>

</html>

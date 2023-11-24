<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınav & Devamsızlık Bilgisi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .forum-container,
        .form-container {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .forum-post,
        .note-item {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .post-header {
            font-weight: bold;
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

        .no-data {
            color: #888;
            font-style: italic;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <button class="back-button" onclick="goBack()">←</button>
    <h1>Devamsızlık ve Not Bilgisi</h1>

    <div class="forum-container">
        <?php
        // Veritabanı bağlantısı ve diğer gerekli dosyaların include edilmesi
        include 'database.php';

        session_start();
        // Öğrencinin kendi devamsızlık bilgilerini sorgula
        $ogrenciId = $_SESSION['id'];
        $query = "SELECT ogrenci.ad_soyad AS ogrenci_adi, devamsizlik.devamsizlik_suresi
                  FROM ogrenci
                  LEFT JOIN devamsizlik ON ogrenci.id = devamsizlik.ogrenci_id
                  WHERE ogrenci.id = '$ogrenciId'";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ogrenciAdi = $row["ogrenci_adi"];
                $devamsizlikSuresi = $row["devamsizlik_suresi"];

                echo "<div class='forum-post'>";
                echo "<div class='post-header'>$ogrenciAdi'nin Devamsızlık Bilgisi</div>";
                echo "<div>Devamsızlık Süresi: $devamsizlikSuresi gün</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-data'>Devamsızlık bilgisi bulunmamaktadır.</p>";
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>
    </div>

    <div class="form-container">
        <?php
        // Veritabanı bağlantısı ve diğer gerekli dosyaların include edilmesi
        include 'database.php';
        echo "<h1>Puan Durumları</h1>";
        // Öğrencinin kendi not bilgilerini sorgula
        $ogrenciId = $_SESSION['id'];
        $query = "SELECT sınavlar.ders_adi, sınavlar.sinav1, sınavlar.sinav2, sınavlar.proje
                FROM sınavlar
                WHERE sınavlar.ogrenci_id = '$ogrenciId'";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Ders Adı</th><th>1. Sınav</th><th>2. Sınav</th><th>Proje</th><th>Ders Ortalaması</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $dersAdi = $row["ders_adi"];
                $sinav1 = $row["sinav1"];
                $sinav2 = $row["sinav2"];
                $proje = $row["proje"];

                // Ortalamayı hesapla
                $ortalama = ($sinav1 + $sinav2 + $proje) / 3;

                echo "<tr>";
                echo "<td>$dersAdi</td>";
                echo "<td>$sinav1</td>";
                echo "<td>$sinav2</td>";
                echo "<td>$proje</td>";
                echo "<td>$ortalama</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-data'>Not bilgisi bulunmamaktadır.</p>";
        }


        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>
    </div>
</body>
<script>
    function goBack() {
        window.location.href = "ogrenciProfili.php";
    }
</script>

</html>

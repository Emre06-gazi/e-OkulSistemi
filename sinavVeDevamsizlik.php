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

        .forum-container {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

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

        .forum-post {
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
    </style>
</head>

<body>
<button class="back-button" onclick="goBack()">←</button>
    <h1>Devamsızlık Bilgisi</h1>

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
            echo "<p>Devamsızlık bilgisi bulunmamaktadır.</p>";
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>
    </div>

    <div class="form-container">
        <?php
        // Veritabanı bağlantısı ve diğer gerekli dosyaların include edilmesi
        include 'database.php';

        // Öğrencinin kendi not bilgilerini sorgula
        $ogrenciId = $_SESSION['id'];
        $query = "SELECT dersler.dersAdi AS ders_adi, notlar.s1, notlar.s2, notlar.proje, notlar.ortalama
                  FROM notlar
                  JOIN dersler ON notlar.ders_id = dersler.id
                  WHERE notlar.ogrenci_id = '$ogrenciId'";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<form>";
            while ($row = $result->fetch_assoc()) {
                $dersAdi = $row["ders_adi"];
                $s1 = $row["s1"];
                $s2 = $row["s2"];
                $proje = $row["proje"];
                $ortalama = $row["ortalama"];

                echo "<label for='ders_adi'>Ders Adı:</label>";
                echo "<input type='text' id='ders_adi' name='ders_adi' value='$dersAdi' readonly><br>";

                echo "<label for='s1'>1. Sınav:</label>";
                echo "<input type='text' id='s1' name='s1' value='$s1' readonly><br>";

                echo "<label for='s2'>2. Sınav:</label>";
                echo "<input type='text' id='s2' name='s2' value='$s2' readonly><br>";

                echo "<label for='proje'>Proje:</label>";
                echo "<input type='text' id='proje' name='proje' value='$proje' readonly><br>";

                echo "<label for='ortalama'>Ortalama Puan:</label>";
                echo "<input type='text' id='ortalama' name='ortalama' value='$ortalama' readonly><br>";
            }
            echo "</form>";
        } else {
            echo "<p>Not bilgisi bulunmamaktadır.</p>";
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

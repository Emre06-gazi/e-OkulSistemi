<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınavlar</title>
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

        /* Modal CSS */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: left;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Form Style */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
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
    <h1>Sınavlar</h1>

    <?php
        session_start();
        // Veritabanı bağlantısı ve diğer gerekli dosyaların include edilmesi
        include 'database.php';

        // Öğretmen ID'sini session'dan alın
        $ogretmenId = $_SESSION['id'];

        // Sınav notlarını güncelleme işlemi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['update'])) {
                $ogrenciId = $_POST['ogrenci_id'];
                $sinav1 = $_POST['sinav1'];
                $sinav2 = $_POST['sinav2'];
                $proje = $_POST['proje'];
                $dersAdi = $_POST['ders_adi'];

                // Öğrenciye ait kayıt var mı kontrol et
                $checkQuery = "SELECT * FROM sınavlar 
                            LEFT JOIN dersler ON sınavlar.ders_adi = dersler.dersAdi
                            WHERE ogrenci_id = '$ogrenciId' AND dersler.ogretmen_id = '$ogretmenId'";
                $checkResult = $conn->query($checkQuery);

                if ($checkResult->num_rows > 0) {
                    // Kayıt var, güncelle
                    $updateSql = "UPDATE sınavlar SET sinav1 = '$sinav1', sinav2 = '$sinav2', proje = '$proje' 
                                WHERE ogrenci_id = '$ogrenciId' AND ders_adi = '$dersAdi'";
                    if ($conn->query($updateSql) === FALSE) {
                        echo "<p class='error-message'>Hata: " . $updateSql . "<br>" . $conn->error . "</p>";
                    }
                } else {
                    // Kayıt yok, ekle
                    $insertSql = "INSERT INTO sınavlar (ogrenci_id, sinav1, sinav2, proje, ders_adi) 
                                VALUES ('$ogrenciId', '$sinav1', '$sinav2', '$proje', '$dersAdi')";
                    if ($conn->query($insertSql) === FALSE) {
                        echo "<p class='error-message'>Hata: " . $insertSql . "<br>" . $conn->error . "</p>";
                    }
                }
            }
        }

        // Tüm öğrencilerin listesini sorgula
        $query = "SELECT ogrenci.id AS ogrenci_id, ogrenci.ad_soyad, ogrenci.sinif, dersler.dersAdi, sınavlar.sinav1, sınavlar.sinav2, sınavlar.proje,
                (sınavlar.sinav1 + sınavlar.sinav2 + sınavlar.proje) / 3 AS ortalama
                FROM ogrenci
                LEFT JOIN dersler ON 1=1
                LEFT JOIN sınavlar ON ogrenci.id = sınavlar.ogrenci_id AND dersler.dersAdi = sınavlar.ders_adi
                WHERE dersler.ogretmen_id = '$ogretmenId'
                ORDER BY ogrenci.sinif, ogrenci.ad_soyad, dersler.dersAdi";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Öğrenci Adı</th><th>Sınıf</th><th>Ders Adı</th><th>1. Sınav</th><th>2. Sınav</th><th>Proje</th><th>Ortalama</th><th>Notları Güncelle</th></tr>";

            while ($row = $result->fetch_assoc()) {
                $ogrenciId = $row["ogrenci_id"];
                $ogrenciAdi = $row["ad_soyad"];
                $sinif = $row["sinif"];
                $dersAdi = (isset($row["dersAdi"]) && $row["dersAdi"] != null) ? $row["dersAdi"] : "-";

                $sinav1 = ($row["sinav1"] != null) ? $row["sinav1"] : "-";
                $sinav2 = ($row["sinav2"] != null) ? $row["sinav2"] : "-";
                $proje = ($row["proje"] != null) ? $row["proje"] : "-";
                $ortalama = ($row["ortalama"] != null) ? number_format($row["ortalama"], 2) : "-";

                echo "<tr>";
                echo "<td>$ogrenciAdi</td>";
                echo "<td>$sinif</td>";
                echo "<td>$dersAdi</td>";
                echo "<td>$sinav1</td>";
                echo "<td>$sinav2</td>";
                echo "<td>$proje</td>";
                echo "<td>$ortalama</td>";
                echo "<td><button class='update-button' onclick='showUpdateForm($ogrenciId, \"$sinav1\", \"$sinav2\", \"$proje\", \"$dersAdi\")'>Güncelle</button></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Öğrenci bilgisi bulunmamaktadır.</p>";
        }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>

    <div id="update-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeUpdateForm()">&times;</span>
            <h2>Sınav Notlarını Güncelle</h2>
            <form method="post" action="">
                <label for="sinav1">1. Sınav:</label>
                <input type="text" id="sinav1" name="sinav1" required>
                <label for="sinav2">2. Sınav:</label>
                <input type="text" id="sinav2" name="sinav2" required>
                <label for="proje">Proje:</label>
                <input type="text" id="proje" name="proje" required>
                <input type="hidden" id="ogrenci_id" name="ogrenci_id">
                <input type="hidden" id="ders_adi" name="ders_adi">
                <button type="submit" name="update">Güncelle</button>
            </form>
        </div>
    </div>

    <script>
        function showUpdateForm(ogrenciId, sinav1, sinav2, proje, dersAdi) {
            document.getElementById('ogrenci_id').value = ogrenciId;
            document.getElementById('sinav1').value = sinav1;
            document.getElementById('sinav2').value = sinav2;
            document.getElementById('proje').value = proje;
            document.getElementById('ders_adi').value = dersAdi;
            document.getElementById('update-form').style.display = 'block';
        }

        function closeUpdateForm() {
            document.getElementById('update-form').style.display = 'none';
        }

        function goBack() {
            window.location.href = "ogretmenProfili.php";
        }
    </script>
</body>

</html>

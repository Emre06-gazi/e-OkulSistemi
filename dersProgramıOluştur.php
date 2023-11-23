<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ders Programı Oluştur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h1, h2 {
            color: #333;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            color: #777;
        }

        .back-button {
            background-color: #333;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: left;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-button-container {
            text-align: center; /* Butonları merkez hizala */
            margin-top: 10px; /* Uzaklık ekleyerek daha düzenli bir görünüm sağla */
        }

        .delete-button {
            background-color: red;
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
    </style>
</head>

<body>
    <button class="back-button" onclick="goBack()">←</button>
    <h1>Ders Programı Oluştur</h1>
    <div class="delete-button-container">
        <button class="delete-button" onclick="deleteProgram()">Tüm Ders Programını Sil ve Yeniden Oluştur</button>
    </div>

    <?php
        include 'database.php';
     
        $sql = "SELECT * FROM dersler";
        $result = $conn->query($sql);

        $dersler = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dersler[] = $row['dersAdi'];
            }
        }

        $siniflar = array("1. Sınıf", "2. Sınıf", "3. Sınıf");
        foreach ($siniflar as $sinif) {
            $checkSql = "SELECT COUNT(*) as count FROM ders_programi WHERE sinif = '$sinif' AND ders_programi_olusturuldu = 1";
            $checkResult = $conn->query($checkSql);
            $rowCount = $checkResult->fetch_assoc()['count'];

            if ($rowCount == 0) {
                $dersProgrami = getRandomDersProgrami($dersler);

                foreach ($dersProgrami as $program) {
                    $sinif = $conn->real_escape_string($sinif);
                    $gun = $conn->real_escape_string($program['gun']);
                    $saat = $conn->real_escape_string($program['saat']);
                    $ders = $conn->real_escape_string($program['ders']);

                    $insertSql = "INSERT INTO ders_programi (sinif, gun, saat, ders, ders_programi_olusturuldu) VALUES ('$sinif', '$gun', '$saat', '$ders', 1)";
                    $conn->query($insertSql);
                }

                echo "<h2>{$sinif} Ders Programı</h2>";
                echo "<table>";
                echo "<tr><th>Gün</th><th>Saat</th><th>Ders</th></tr>";

                foreach ($dersProgrami as $program) {
                    echo "<tr><td>{$program['gun']}</td><td>{$program['saat']}</td><td>{$program['ders']}</td></tr>";
                }

                echo "</table>";
            } else {
                echo "<h2>{$sinif} Mevcut Ders Programı</h2>";

                $listSql = "SELECT * FROM ders_programi WHERE sinif = '$sinif' AND ders_programi_olusturuldu = 1";
                $listResult = $conn->query($listSql);

                if ($listResult->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Gün</th><th>Saat</th><th>Ders</th></tr>";

                    while ($row = $listResult->fetch_assoc()) {
                        echo "<tr><td>{$row['gun']}</td><td>{$row['saat']}</td><td>{$row['ders']}</td></tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>Ders programı bulunamadı.</p>";
                }
            }
        }

        // Rastgele ders programı oluşturma fonksiyonu
        function getRandomDersProgrami($dersler)
        {
            $gunler = array("Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma");
            $saatler = array("09:00-10:30", "10:45-12:15", "13:00-14:30", "14:45-16:15");

            $dersProgrami = array();

            foreach ($gunler as $gun) {
                foreach ($saatler as $saat) {
                    $randomDers = $dersler[array_rand($dersler)];

                    // Ders programında çakışma kontrolü
                    while (dersProgramindaCakismaVarMi($dersProgrami, $gun, $saat, $randomDers)) {
                        $randomDers = $dersler[array_rand($dersler)];
                    }

                    $dersProgrami[] = array("gun" => $gun, "saat" => $saat, "ders" => $randomDers);
                }
            }

            return $dersProgrami;
        }

        // Ders programında çakışma kontrolü
        function dersProgramindaCakismaVarMi($dersProgrami, $gun, $saat, $ders)
        {
            foreach ($dersProgrami as $program) {
                if ($program['gun'] == $gun && $program['saat'] == $saat && $program['ders'] == $ders) {
                    return true; // Çakışma var
                }
            }

            return false; // Çakışma yok
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>
</body>
<script>
    function goBack() {
        window.location.href = "müdür.php";
    }

    function deleteProgram() {
        if (confirm("Programı silmek istediğinize emin misiniz?")) {
            // AJAX isteği
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Ders Programı başarıyla silindi ve yeniden oluşturuldu!");
                    location.reload();
                }
            };

            // Silme isteğini yap
            xhr.open("GET", "programSil.php", true);
            xhr.send();
        }
    }
</script>

</html>

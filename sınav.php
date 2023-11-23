<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınavlar</title>
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
            color: #333;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
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

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <?php
    include 'database.php';

    // Öğretmenin giriş yaptığı varsayalım (örnek öğretmen ID'si: 1)
    $ogretmenId = 1;

    // Öğretmenin dersine ait öğrencileri ve sınıfları al
    $selectStudentsSql = "SELECT * FROM ogrenci WHERE sinif IN (SELECT sinif FROM ders WHERE ogretmen_id = '$ogretmenId')";
    $result = $conn->query($selectStudentsSql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ogrenciId = $row['id'];
            $sinif = $row['sinif'];

            // Sınav tarihi oluştur
            $sınavTarihi = generateRandomDate();
            // Proje tarihi oluştur
            $projeTarihi = generateRandomDate();

            $insertSql = "INSERT INTO sinav_proje_tarihleri (ogrenci_id, sinif, sinav_tarihi, proje_tarihi) VALUES ('$ogrenciId', '$sinif', '$sınavTarihi', '$projeTarihi')";

            echo "<p>Sınav tarihi oluşturuldu: $sınavTarihi - Proje tarihi oluşturuldu: $projeTarihi</p>";
        }
    }

    function generateRandomDate() {
        $startTimestamp = strtotime("now");
        $endTimestamp = strtotime("+1 month"); // 1 aylık bir dönem için örnektir, değiştirebilirsiniz

        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

        return date("Y-m-d", $randomTimestamp);
    }
    ?>

    <h1>Sınavlar ve Projeler</h1>

    <!-- Sınav Formu -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="sinav_tarihi">Sınav Tarihi:</label>
        <input type="date" name="sinav_tarihi" required>
        <input type="submit" value="Sınav Tarihini Kaydet">
    </form>

    <!-- Proje Formu -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="proje_tarihi">Proje Tarihi:</label>
        <input type="date" name="proje_tarihi" required>
        <input type="submit" value="Proje Tarihini Kaydet">
    </form>

    <!-- Deneme Sınavı Formu -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="deneme_sinavi_tarihi">Deneme Sınavı Tarihi:</label>
        <input type="date" name="deneme_sinavi_tarihi" required>
        <input type="submit" value="Deneme Sınavı Tarihini Kaydet">
    </form>

</body>
</html>

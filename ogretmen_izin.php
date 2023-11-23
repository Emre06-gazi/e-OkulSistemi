<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmen İzin İşlemleri</title>
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

        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
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
    <?php
    include 'database.php';

    // İzin formu gönderilmiş mi kontrolü
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen veriler
        $kullaniciId = $_POST["kullanici_id"];
        $baslangicTarihi = $_POST["baslangic_tarihi"];
        $bitisTarihi = $_POST["bitis_tarihi"];
        $aciklama = $_POST["aciklama"];

        // İzin tablosuna yeni izin ekle
        $insertSql = "INSERT INTO izin_tablosu (kullanici_id, baslangic_tarihi, bitis_tarihi, aciklama) VALUES ('$kullaniciId', '$baslangicTarihi', '$bitisTarihi', '$aciklama')";
        if ($conn->query($insertSql) === TRUE) {
            echo "<p>İzin talebiniz başarıyla gönderildi.</p>";
        } else {
            echo "<p class='error-message'>Hata: " . $insertSql . "<br>" . $conn->error . "</p>";
        }
    }
    ?>

    <h1>Öğretmen İzin İşlemleri</h1>

    <!-- İzin Talep Formu -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="kullanici_id">Öğretmen Seç:</label>
        <select name="kullanici_id" required>
            <?php
            // Kullanıcı tablosundan öğretmenleri seç
            $selectUsersSql = "SELECT id, kullanici_adi FROM kullanici WHERE rol = '1'";
            $result = $conn->query($selectUsersSql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["kullanici_adi"] . "</option>";
                }
            } else {
                echo "<option value='' disabled selected>Öğretmen bulunamadı</option>";
            }
            ?>
        </select>

        <br>

        <label for="baslangic_tarihi">İzin Başlangıç Tarihi:</label>
        <input type="date" name="baslangic_tarihi" required>

        <br>

        <label for="bitis_tarihi">İzin Bitiş Tarihi:</label>
        <input type="date" name="bitis_tarihi" required>

        <br>

        <label for="aciklama">Açıklama:</label>
        <textarea name="aciklama" rows="4" cols="50" required></textarea>

        <br>

        <input type="submit" value="İzin Talebi Gönder">
    </form>
    <script>
        function goBack() {
            window.location.href = "ogretmenProfili.php";
        }
    </script>
</body>

</html>

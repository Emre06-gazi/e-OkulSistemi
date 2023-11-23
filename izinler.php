<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müdür İzin Talep Ekranı</title>
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
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        form {
            display: inline-block;
        }

        .approve-button {
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

        .reject-button {
            background-color: #FF0000;
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

        .approve-button:hover {
            background-color: #45a049;
        }

        .reject-button:hover {
            background-color: #FF3333;
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
            // Kullanıcıya bildirim gönder (bu kısım geliştirilmelidir)
            $bildirim = ($onayDurumu == 1) ? "İzin tarihiniz onaylandı!" : "İzin tarihiniz onaylanmadı!";
            // Bildirimi göster (bu kısım geliştirilmelidir)
            echo "<p class='success-message'>$bildirim</p>";
        } else {
            echo "<p class='error-message'>Hata: " . $updateSql . "<br>" . $conn->error . "</p>";
        }
    }
    ?>
    <button class="back-button" onclick="goBack()">←</button>
    <h1>Müdür Ekranı - İzin Talepleri</h1>

    <?php
    // İzin taleplerini listele
    $selectIzinlerSql = "SELECT * FROM izin_tablosu";
    $result = $conn->query($selectIzinlerSql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Kullanıcı Adı</th><th>Başlangıç Tarihi</th><th>Bitiş Tarihi</th><th>Açıklama</th><th>Onay Durumu</th><th>Onayla/Reddet</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $izinId = $row["id"];
            $kullaniciAdi = getKullaniciAdi($row["kullanici_id"]);
            $baslangicTarihi = $row["baslangic_tarihi"];
            $bitisTarihi = $row["bitis_tarihi"];
            $aciklama = $row["aciklama"];
            $onayDurumu = $row["onay_durumu"];

            echo "<tr>";
            echo "<td>$kullaniciAdi</td><td>$baslangicTarihi</td><td>$bitisTarihi</td><td>$aciklama</td>";

            if ($onayDurumu == 1) {
                echo "<td>Onaylandı</td>";
            } elseif ($onayDurumu == 0) {
                echo "<td>İşlem Bekliyor</td>";
            } else {
                echo "<td>Reddedildi</td>";
            }

            // Onayla/Reddet düğmeleri
            echo "<td>
                    <form action='izinGeriDönüş.php' method='post'>
                        <input type='hidden' name='izin_id' value='$izinId'>
                        <input type='hidden' name='onay_durumu' value='1'>
                        <button type='submit' class='approve-button'>Onayla</button>
                    </form>
                    <form action='izinGeriDönüş.php' method='post'>
                        <input type='hidden' name='izin_id' value='$izinId'>
                        <input type='hidden' name='onay_durumu' value='0'>
                        <button type='submit' class='reject-button'>Reddet</button>
                    </form>
                  </td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>İzin talebi bulunmamaktadır.</p>";
    }

    function getKullaniciAdi($kullaniciId)
    {
        global $conn;
        $selectKullaniciSql = "SELECT kullanici_adi FROM kullanici WHERE id = '$kullaniciId'";
        $result = $conn->query($selectKullaniciSql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["kullanici_adi"];
        } else {
            return "Bilinmeyen Kullanıcı";
        }
    }
    ?>
</body>
    <script>
        function goBack() {
            window.location.href = "müdür.php";
        }
    </script>
</html>

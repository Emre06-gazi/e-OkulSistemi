
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Ders Programı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 80%; /* Tablo genişliğini artır */
            margin: 20px auto; /* Tabloyu ortala */
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            color: #777;
            text-align: center;
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
    </style>
</head>
<button class="back-button" onclick="goBack()">←</button>
<body>
<?php
// Session kontrolü ile kullanıcının giriş yapmış ve öğrenci olduğunu doğrula
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] != '2') {
    // Eğer oturum açılmamışsa veya kullanıcı öğrenci değilse, giriş sayfasına yönlendirme yapabilirsiniz.
    header("Location: login.html");
    exit();
}

include 'database.php';

// Kullanıcının sahip olduğu dersleri belirleme
$ogrenciId = $_SESSION['id'];
$selectDerslerSql = "SELECT sinif FROM ogrenci WHERE id = '$ogrenciId'";
$result = $conn->query($selectDerslerSql);

$siniflar = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $siniflar[] = $row['sinif'];
    }
}

// Öğrencinin sahip olduğu sınıfa ait ders programını gösterme
foreach ($siniflar as $sinif) {
    $selectProgramSql = "SELECT * FROM ders_programi WHERE sinif = '$sinif'";
    $programResult = $conn->query($selectProgramSql);

    if ($programResult->num_rows > 0) {
        echo "<h1>{$sinif} Haftalık Ders Programınız</h1>";
        echo "<table>";
        echo "<tr><th>Gün</th><th>Saat</th><th>Ders Adı</th></tr>";

        while ($programRow = $programResult->fetch_assoc()) {
            echo "<tr><td>{$programRow['gun']}</td><td>{$programRow['saat']}</td><td>{$programRow['ders']}</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>{$sinif}a ait program bulunamadı.</p>";
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
<script>
    function goBack() {
        window.location.href = "ogrenciProfili.php";
    }
</script>
</body>
</html>

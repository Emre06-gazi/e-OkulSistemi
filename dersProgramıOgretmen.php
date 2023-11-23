
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmen Ders Programı</title>
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
<body>
<button class="back-button" onclick="goBack()">←</button>
<?php
// Session kontrolü ile kullanıcının giriş yapmış ve öğretmen olduğunu doğrula
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] != '1') {
    // Eğer oturum açılmamışsa veya kullanıcı öğretmen değilse, giriş sayfasına yönlendirme yapabilirsiniz.
    header("Location: login.html");
    exit();
}

include 'database.php';

// Kullanıcının sahip olduğu dersleri belirleme
$ogretmenId = $_SESSION['id'];
$selectDerslerSql = "SELECT dersAdi FROM ogretmen WHERE id = '$ogretmenId'";
$result = $conn->query($selectDerslerSql);

$dersler = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dersler[] = $row['dersAdi'];
    }
}

// Öğretmenin sahip olduğu derslere ait ders programını gösterme
foreach ($dersler as $ders) {
    $selectProgramSql = "SELECT * FROM ders_programi WHERE ders = '$ders'";
    $programResult = $conn->query($selectProgramSql);

    if ($programResult->num_rows > 0) {
        echo "<h1>{$ders} Dersi Ders Programı</h1>";
        echo "<table>";
        echo "<tr><th>Sınıf</th><th>Gün</th><th>Saat</th></tr>";

        while ($programRow = $programResult->fetch_assoc()) {
            echo "<tr><td>{$programRow['sinif']}</td><td>{$programRow['gun']}</td><td>{$programRow['saat']}</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>{$ders} dersine ait program bulunamadı.</p>";
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
<script>
    function goBack() {
        window.location.href = "ogretmenProfili.php";
    }
</script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Mesaj Kutusu</title>
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

        .message-button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <button class="back-button" onclick="goBack()">←</button>
    <h1>Öğrenci Mesaj Kutusu</h1>

    <a href="mesajGonder.php" class="message-button">Mesaj Gönder</a>

    <?php
    // Öğrenci ID'sini al
    session_start();
    $ogrenciId = $_SESSION['id'];

    // Veritabanı bağlantısını ekleyin
    include 'database.php';

    // Öğrenciye gelen mesajları listele
    $selectMesajlarSql = "SELECT m.*, k.kullanici_adi FROM mesajlar m
                         JOIN kullanici k ON m.gonderen_id = k.id
                         WHERE m.alici_id = '$ogrenciId'
                         ORDER BY m.tarih DESC";

    $result = $conn->query($selectMesajlarSql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Gönderen</th><th>Mesaj</th><th>Tarih</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $gonderen = $row['kullanici_adi'];
            $mesaj = $row['mesaj'];
            $tarih = $row['tarih'];

            echo "<tr>";
            echo "<td>$gonderen</td><td>$mesaj</td><td>$tarih</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Mesajınız bulunmamaktadır.</p>";
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

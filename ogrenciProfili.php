<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Profili</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            margin: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            position: relative;
        }

        .back-button {
            background-color: #343a40;
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            position: absolute;
            left: 10px;
            top: 10px;
        }

        h1 {
            color: #343a40;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .action-button {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #0056b3;
        }

        #clock-container,
        #calendar-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        #clock,
        #date,
        #calendar {
            font-size: 1.5em;
            color: #343a40;
            margin: 5px 0;
        }

        #clock-container,
        #calendar-container {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        #calendar {
            font-size: 1.5em;
            color: #343a40;
            margin: 10px 0;
        }

        /* Diğer stiller buraya eklenebilir */
table {
    width: 100%;
    margin-top: 15px;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #343a40; /* Koyu gri renk */
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

    </style>
</head>

<body>
    <div class="container">
        <button class="back-button" onclick="goBack()">←</button>
        <br></br>
        <h1>Öğrenci Paneli</h1>

        <div class="button-container">
            <button class="action-button" onclick="openDersProgrami()">Ders Programını Görüntüle</button>
            <button class="action-button" onclick="openIzin()">İzin Talebi</button>
            <button class="action-button" onclick="openDevamsizlik()">Sınav & Devamsızlık Bilgilerini Gör</button>
            <button class="action-button" onclick="openMesaj()">Mesajlar</button>
        </div>

        <div id="clock-container">
            <div id="clock"></div>
            <div id="date"></div>
        </div>

        <div id="calendar-container">
            <?php include 'tarihSaat.php'; ?>
            <br></br>
            <h2>Etkinlikler</h2>
            <table border="1">
                <tr>
                    <th>Tarih</th>
                    <th>Etkinlik Adı</th>
                    <th>Saat</th>
                </tr>
                <?php
                include 'database.php';

                $sql = "SELECT event_date, event_name, event_hour FROM events";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["event_date"] . "</td>";
                        echo "<td>" . $row["event_name"] . "</td>";
                        echo "<td>" . $row["event_hour"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Etkinlik bulunamadı.</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </div>
    </div>

    <script>
        function openDersProgrami() {
            window.location.href = "dersProgramıOgrenci.php";
        }

        function openIzin() {
            window.location.href = "izinOgrenci.php";
        }

        function openDevamsizlik() {
            window.location.href = "sinavVeDevamsizlik.php";
        }

        function openMesaj() {
            window.location.href = "ogrenciMesajlar.php";
        }

        function showDateTime() {
            const now = new Date();

            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const formattedTime = `${hours < 10 ? '0' : ''}${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            document.getElementById('clock').textContent = formattedTime;

            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const formattedDate = new Intl.DateTimeFormat('tr-TR', options).format(now);
            document.getElementById('date').textContent = formattedDate;
        }

        setInterval(() => {
            showDateTime();
        }, 1000);

        showDateTime();

        function goBack() {
            window.location.href = "login.html";
        }
    </script>
</body>

</html>

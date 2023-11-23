<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmen Profili</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Diğer stiller buraya eklenebilir */
        .container {
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #343a40;
            font-family: 'Arial', sans-serif;
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
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
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

        /* Özel stiller buraya ekleniyor */
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
    <div class="container">
        <button class="back-button" onclick="goBack()">←</button>
        <br></br>
        <h1>Öğretmen Paneli</h1>
        <div class="button-container">
            <button class="action-button" onclick="openDersProgrami()">Ders Programını Görüntüle</button>
            <button class="action-button" onclick="openOgrenciler()">Öğrenciler</button>
            <button class="action-button" onclick="openOgretmenIzin()">Öğretmen İzin Talebi</button>
            <button class="action-button" onclick="openSınav()">Sınavlar</button>
            <button class="action-button" onclick="openDevamsizlik()">Devamsızlıklar</button>
            <button class="action-button" onclick="openMesaj()">Mesajlar</button>
        </div>

        <div id="clock-container">
            <div id="clock"></div>
            <div id="date"></div>
        </div>

        <div id="calendar-container">
            <?php include 'tarihSaat.php'; ?>
        </div>
    </div>

    <script>
        function openDersProgrami() {
            window.location.href = "dersProgramıOgretmen.php";
        }

        function openOgrenciler() {
            window.location.href = "ogrenciler.php";
        }

        function openOgretmenIzin() {
            window.location.href = "ogretmen_izin.php";
        }

        function openSınav() {
            window.location.href = "sınav.php";
        }

        function openDevamsizlik() {
            window.location.href = "devamsizlik.php";
        }

        function openMesaj() {
            window.location.href = "ogretmenMesajlar.php";
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

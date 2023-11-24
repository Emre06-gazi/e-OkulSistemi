<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müdür Paneli</title>
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
            position: absolute; /* Yeni eklenen stil özelliği */
            left: 10px; /* Yeni eklenen stil özelliği */
            top: 10px; /* Yeni eklenen stil özelliği */
        }

        .event-form {
            display: none;
            text-align: left;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .event-form label {
            display: block;
            margin-bottom: 10px;
        }

        .event-form button {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
            background: none;
            border: none;
            color: #333;
        }

    </style>
</head>

<body>
    <div class="container">
        <button class="back-button" onclick="goBack()">←</button>
        <h1>Müdür Paneli</h1>
        <div class="button-container">
            <button class="action-button" onclick="openDersProgrami()">Ders Programı Oluştur</button>
            <button class="action-button" onclick="openOgrenciler()">Öğrenciler</button>
            <button class="action-button" onclick="openOgretmenler()">Öğretmenler</button>
            <button class="action-button" onclick="openIzin()">İzin İşlemleri</button>
            <button class="action-button" onclick="openTopluMesaj()">Toplu Mesaj Gönder</button>
            <button class="action-button" onclick="openMesaj()">Mesajlar</button>
        </div>

        <div id="clock-container">
            <div id="clock"></div>
            <div id="date"></div>
        </div>

        <div id="calendar-container" ondblclick="openEventForm(event)">
            <?php include 'tarihSaat.php'; ?>
        </div>

        <div id="event-form" class="event-form">
            <button class="close-button" onclick="closeEventForm()">X</button>
            <h2>Etkinlik Oluştur</h2>
                <form id="eventForm">
                <label for="eventDate">Tarih:</label>
                <input type="text" id="eventDate" name="eventDate" readonly>
                <label for="eventName">Etkinlik Adı:</label>
                <input type="text" id="eventName" name="eventName" required>
                <label for="eventHour">Etkinlik Saati:</label>
                <input type="time" id="eventHour" name="eventHour" required>
                <button type="button" onclick="saveEvent()">Kaydet</button>
                <button type="button" onclick="updateEvent()">Güncelle</button>
            </form>
        </div>
    </div>

    <script>
        let selectedDateValue = "";

        function showDateTime() {
            const now = new Date();

            // Saat bilgisi
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const formattedTime = `${hours < 10 ? '0' : ''}${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            document.getElementById('clock').textContent = formattedTime;

            // Tarih bilgisi
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const formattedDate = new Intl.DateTimeFormat('tr-TR', options).format(now);
            document.getElementById('date').textContent = formattedDate;
        }

        // Her saniyede bir tarih ve saat bilgisini güncelle
        setInterval(() => {
            showDateTime();
        }, 1000);

        // Sayfa ilk açıldığında da tarih ve saat bilgisini göster
        showDateTime();

        // Diğer butonları buraya ekleyebilirsiniz
        function openDersProgrami() {
            // Ders programı açılacak sayfanın URL'ini belirtin
            window.location.href = "dersProgramıOluştur.php";
        }

        function openOgrenciler() {
            // Öğrenciler sayfasını açacak sayfanın URL'ini belirtin
            window.location.href = "ogrenciler.php";
        }

        function openOgretmenler() {
            // Öğretmenler sayfasını açacak sayfanın URL'ini belirtin
            window.location.href = "ogretmen.php";
        }

        function openIzin() {
            // Öğretmen izin sayfasını açacak sayfanın URL'ini belirtin
            window.location.href = "izinler.php";
        }

        function openTopluMesaj() {
            // Toplu mesaj gönderme sayfasını açacak sayfanın URL'ini belirtin
            window.location.href = "toplu_mesaj.php";
        }

        function openMesaj() {
            window.location.href = "müdürMesajlar.php";
        }

        function goBack() {
            window.location.href = "login.html";
        }
 
        function openEventForm(event) {
            document.getElementById('event-form').style.display = 'block';

            // Çift tıklanan hücrenin içindeki tarih bilgisini al
            const selectedDate = event.target.textContent.trim();

            if (selectedDate) {
                const currentDate = new Date();
                const selectedDay = parseInt(selectedDate);

                selectedDateValue = selectedDate;

                // Seçilen gün değeri ile yeni bir tarih oluştur
                const selectedDateObj = new Date(currentDate.getFullYear(), currentDate.getMonth(), selectedDay);

                // Eğer seçilen tarih geçmiş bir tarihse veya aynı ayda değilse, o tarihi kullan
                if (selectedDateObj < currentDate || selectedDateObj.getMonth() !== currentDate.getMonth()) {
                    formatAndSetEventDate(selectedDateObj);
                } else {
                    // Eğer aynı aydaysa, mevcut tarih bilgilerini kullan
                    formatAndSetEventDate(currentDate);

                    // Kontrol ekle: Ay ve yıl aynı mı?
                    if (selectedDateValue.substring(3, 10) !== formatSelectedDate(currentDate).substring(3, 10)) {
                        alert('Seçilen tarih, mevcut ay ve yıl ile aynı olmalıdır.');
                        closeEventForm();
                    }
                }
            } else {
                alert('Tarih bilgisi alınamadı.');
                closeEventForm();
            }
        }

        function formatAndSetEventDate(dateObj) {
            const formattedDate = formatSelectedDate(dateObj);
            document.getElementById('eventDate').value = formattedDate;
        }

        function formatSelectedDate(dateObj) {
            const day = dateObj.getDate();
            const month = dateObj.getMonth() + 1; // Ay bilgisini düzeltmek için 1 ekleyin
            const year = dateObj.getFullYear();

            // İstenen tarih formatına göre düzenleme yapın
            const formattedDate = `${day < 10 ? '0' : ''}${day}/${month < 10 ? '0' : ''}${month}/${year}`;

            return formattedDate;
        }


        function saveEvent() {
            const eventDate = document.getElementById('eventDate').value;
            const eventName = document.getElementById('eventName').value;
            const eventHour = document.getElementById('eventHour').value;

            // AJAX kullanarak PHP dosyasına isteği gönderin
            const xhr = new XMLHttpRequest();
            const url = 'event_operations.php';
            const params = `eventDate=${eventDate}&eventName=${eventName}&eventHour=${eventHour}`;
            
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Sunucudan dönen cevabı göster
                    closeEventForm();
                }
            }

            xhr.send(params);
        }
        function updateEvent() {
            // Güncelleme işlemi için gerekli kodu ekleyin
            const eventName = document.getElementById('eventName').value;
            const eventDate = document.getElementById('eventDate').value;
            const eventHour = document.getElementById('eventHour').value;

            // AJAX ile PHP'ye güncelleme isteği gönderme
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Sunucudan gelen yanıtı işle
                    const response = xhr.responseText;
                    alert(response); // Sunucudan gelen yanıtı göster
                    closeEventForm();
                }
            };

            // Gönderilecek verileri hazırla
            const data = `eventName=${eventName}&eventDate=${eventDate}&eventHour=${eventHour}&selectedDate=${selectedDateValue}`;

            // İsteği gönder
            xhr.send(data);
        }

        function closeEventForm() {
            document.getElementById('event-form').style.display = 'none';
        }
    </script>
</body>

</html>

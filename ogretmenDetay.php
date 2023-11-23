<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmen Bilgileri</title>
    
    <style>
   body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
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
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
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
        .back-button {
            background-color: #333;
        }
    </style>
</head>
<body>

<?php
include 'database.php';

// Öğretemen ID'sini alma
$teacherId = isset($_GET['id']) ? $_GET['id'] : null;

// Öğretemen verilerini çekme
$sql = "SELECT * FROM ogretmen WHERE id = $teacherId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <button class="back-button" onclick="goBack()">←</button>
    <h1>Öğretmen Bilgileri</h1>
    
    <form id="updateForm">
        <label for="ad_soyad">Ad Soyad:</label>
        <input type="text" id="ad_soyad" name="ad_soyad" value="<?php echo $row['ad_soyad']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" value="<?php echo $row['sifre']; ?>" required>

        <label for="dersAdi">Ders:</label>
        <input type="text" id="ders_Adi" name="dersAdi" value="<?php echo $row['dersAdi']; ?>" required>

        <button type="button" onclick="updateOgretmen()">Güncelle</button>
    </form>

<?php
} else {
    echo "Öğretmen bulunamadı.";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

<script>
    function goBack() {
        window.location.href = "ogretmen.php";
    }
    function updateOgretmen() {
        var formData = new FormData(document.getElementById("updateForm"));
        formData.append("id", <?php echo $teacherId; ?>);

        // AJAX isteği
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Başarılı bir şekilde güncellendiğinde yapılacak işlemler
                    alert("Öğretmen bilgileri güncellendi.");
                    // Sayfayı yenile
                    location.reload();
                } else {
                    // Hata durumunda bir şey yapmak istiyorsanız burada ekleyebilirsiniz.
                    alert("Güncelleme hatası: " + xhr.responseText);
                }
            }
        };

        // Güncelleme isteğini yap
        xhr.open("POST", "ogretmenGuncelle.php", true);
        xhr.send(formData);
    }
</script>

</body>
</html>

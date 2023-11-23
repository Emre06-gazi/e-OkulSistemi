<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj Gönder</title>
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
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
    <h1>Mesaj Gönder</h1>

    <form action="mesajGonderIslem.php" method="post">
        <label for="aliciId">Alıcı ID:</label>
        <input type="text" name="aliciId" required>

        <label for="konu">Konu:</label>
        <input type="konu" name="konu" required>

        <label for="mesaj">Mesajınız:</label>
        <textarea name="mesaj" rows="4" required></textarea>

        <button type="submit">Mesaj Gönder</button>
    </form>
</body>
<script>
     function goBack() {
            // Kullanıcının rolünü kontrol et
            <?php
            session_start();
            $rol = $_SESSION['rol'];

            switch ($rol) {
                case 0:
                    echo 'window.location.href = "müdür.php";';
                    break;
                case 1:
                    echo 'window.location.href = "ogretmenProfili.php";';
                    break;
                case 2:
                    echo 'window.location.href = "ogrenciProfili.php";';
                    break;
                default:
                    echo 'window.location.href = "ogrenciMesajlar.php";';
                    break;
            }
            ?>
        }
</script>
</html>

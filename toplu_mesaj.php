<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplu Mesaj Gönder</title>
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

        input,
        textarea,
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
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
    <h1>Toplu Mesaj Gönder</h1>

    <form action="topluMesajGonder.php" method="post">
        <label for="konu">Konu:</label>
        <input type="text" name="konu" required>

        <label for="mesaj">Mesaj:</label>
        <textarea name="mesaj" rows="4" required></textarea>

        <label for="alici_tipi">Alıcı Tipi:</label>
        <select name="alici_tipi" required>
            <option value="TUMU">TÜMÜ</option>
            <option value="OGRENCILER">Öğrenciler</option>
            <option value="OGRETMENLER">Öğretmenler</option>
        </select>

        <input type="submit" value="Mesaj Gönder">
    </form>
</body>
    <script>
        function goBack() {
            window.location.href = "müdür.php";
        }
    </script>
</html>

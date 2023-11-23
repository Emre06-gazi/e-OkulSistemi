<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmenler</title>
    
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
            cursor: pointer; /* Sütuna tıklanabilirlik için cursor stilini değiştiriyoruz */
        }

        th {
            background-color: #f2f2f2;
        }

        .filter-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
            margin: 20px;
        }

        .button {
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .details-button {
            background-color: #4CAF50;
            color: white;
        }

        .delete-button {
            background-color: red;
            color: white;
        }

        .add-button {
            background-color: blue;
            color: white;
        }

        .back-button {
            background-color: #333;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            text-align: left;
            margin: 10px;
        }
    </style>
</head>
<body>

<?php
include 'database.php';

// Öğrenci verilerini çekme
$sql_teachers = "SELECT * FROM ogretmen";
$result_teachers = $conn->query($sql_teachers);

if ($result_teachers->num_rows > 0) {
    echo "<button class='button back-button' onclick='goBack()'>←</button>";
    echo "<h1>Öğretmen Listesi</h1>";
    
    // Öğrenci ekle butonu
    echo "<div class='button-container'><button class='button add-button' onclick='addOgretmen()'>Öğretmen Ekle</button></div>";
    
    // Verileri tabloya ekleme
    echo "<table>";
    echo "<tr><th onclick='sortTable(0)'>Ad Soyad &#x2195;</th><th>Email</th><th>Şifre</th><th onclick='sortTable(3)'>Sınıf &#x2195;</th><th>İşlemler</th></tr>";

    while ($row_teacher = $result_teachers->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_teacher["ad_soyad"] . "</td>";
        echo "<td>" . $row_teacher["email"] . "</td>";
        echo "<td>" . $row_teacher["sifre"] . "</td>";
        echo "<td>" . $row_teacher["dersAdi"] . "</td>";
        echo "<td>
                  <button class='button details-button' onclick='openShowDetails(" . $row_teacher["id"] . ")'>Detaylar</button>
                  <button class='button delete-button' onclick='deleteOgretmen(" . $row_teacher["id"] . ")'>Sil</button>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
    
} else {
    echo "Öğrtemen bulunamadı.";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

<script>
    function openShowDetails(teacherId) {
        window.location.href = "ogretmenDetay.php?id=" + teacherId;
    }
    function goBack() {
        window.location.href = "müdür.php";
    }

    function deleteOgretmen(teacherId) {
        if (confirm("Öğretmeni silmek istediğinize emin misiniz?")) {
            // AJAX isteği
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Öğretmen başarıyla silindi.");
                    location.reload();
                }
            };

            // Silme isteğini yap
            xhr.open("GET", "ogretmenSil.php?id=" + teacherId, true);
            xhr.send();
        }
    }

    function addOgretmen() {
        window.location.href = "ogretmenEkle.php";
    }

    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.querySelector("table");
        switching = true;
        // Sıralama düzeni, başlangıçta artan olarak ayarlanmıştır.
        dir = "asc"; 
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < rows.length - 1; i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[n];
                y = rows[i + 1].getElementsByTagName("td")[n];
                var cmpX = isNaN(parseInt(x.innerHTML)) ? x.innerHTML.toLowerCase() : parseInt(x.innerHTML);
                var cmpY = isNaN(parseInt(y.innerHTML)) ? y.innerHTML.toLowerCase() : parseInt(y.innerHTML);
                if (dir == "asc") {
                    if (cmpX > cmpY) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (cmpX < cmpY) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
</body>
</html>

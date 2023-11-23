<?php
session_start(); 

include 'database.php';

$kullanici_adi = $_POST['username'];
$sifre = $_POST['password'];

$query = "SELECT * FROM kullanici WHERE kullanici_adi = '$kullanici_adi' AND sifre = '$sifre'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $user_id = $user['id'];
    $user_role = $user['rol'];

    // Kullanıcı oturumu başlat
    $_SESSION['id'] = $user_id;
    $_SESSION['rol'] = $user_role;

    if ($user_role == '0') {
        header("Location: müdür.php");
    } else if ($user_role == '1'){
        header("Location: ogretmenProfili.php");
    } else {
        header("Location: ogrenciProfili.php");
    }
} else {
    echo "Kullanıcı adı veya şifre hatalı!";
}

$conn->close();
?>

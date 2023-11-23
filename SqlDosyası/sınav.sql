-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Kas 2023, 14:01:24
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sınav`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

CREATE TABLE `dersler` (
  `id` int(11) NOT NULL,
  `dersAdi` varchar(255) NOT NULL,
  `ogretmen_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `dersler`
--

INSERT INTO `dersler` (`id`, `dersAdi`, `ogretmen_id`) VALUES
(1, 'Matematik', 2),
(2, 'Türkçe', 3),
(3, 'Fen Bilgisi', 4),
(4, 'İngilizce', 5),
(5, 'Müzik', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders_programi`
--

CREATE TABLE `ders_programi` (
  `id` int(11) NOT NULL,
  `sinif` varchar(255) NOT NULL,
  `gun` varchar(255) NOT NULL,
  `saat` varchar(255) NOT NULL,
  `ders` varchar(255) NOT NULL,
  `ders_programi_olusturuldu` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ders_programi`
--

INSERT INTO `ders_programi` (`id`, `sinif`, `gun`, `saat`, `ders`, `ders_programi_olusturuldu`) VALUES
(601, '1. Sınıf', 'Pazartesi', '09:00-10:30', 'Müzik', 1),
(602, '1. Sınıf', 'Pazartesi', '10:45-12:15', 'İngilizce', 1),
(603, '1. Sınıf', 'Pazartesi', '13:00-14:30', 'İngilizce', 1),
(604, '1. Sınıf', 'Pazartesi', '14:45-16:15', 'Matematik', 1),
(605, '1. Sınıf', 'Salı', '09:00-10:30', 'İngilizce', 1),
(606, '1. Sınıf', 'Salı', '10:45-12:15', 'Müzik', 1),
(607, '1. Sınıf', 'Salı', '13:00-14:30', 'Matematik', 1),
(608, '1. Sınıf', 'Salı', '14:45-16:15', 'İngilizce', 1),
(609, '1. Sınıf', 'Çarşamba', '09:00-10:30', 'Matematik', 1),
(610, '1. Sınıf', 'Çarşamba', '10:45-12:15', 'Fen Bilgisi', 1),
(611, '1. Sınıf', 'Çarşamba', '13:00-14:30', 'Fen Bilgisi', 1),
(612, '1. Sınıf', 'Çarşamba', '14:45-16:15', 'Türkçe', 1),
(613, '1. Sınıf', 'Perşembe', '09:00-10:30', 'Türkçe', 1),
(614, '1. Sınıf', 'Perşembe', '10:45-12:15', 'İngilizce', 1),
(615, '1. Sınıf', 'Perşembe', '13:00-14:30', 'Fen Bilgisi', 1),
(616, '1. Sınıf', 'Perşembe', '14:45-16:15', 'Fen Bilgisi', 1),
(617, '1. Sınıf', 'Cuma', '09:00-10:30', 'Fen Bilgisi', 1),
(618, '1. Sınıf', 'Cuma', '10:45-12:15', 'Fen Bilgisi', 1),
(619, '1. Sınıf', 'Cuma', '13:00-14:30', 'Türkçe', 1),
(620, '1. Sınıf', 'Cuma', '14:45-16:15', 'Matematik', 1),
(621, '2. Sınıf', 'Pazartesi', '09:00-10:30', 'Türkçe', 1),
(622, '2. Sınıf', 'Pazartesi', '10:45-12:15', 'Fen Bilgisi', 1),
(623, '2. Sınıf', 'Pazartesi', '13:00-14:30', 'Fen Bilgisi', 1),
(624, '2. Sınıf', 'Pazartesi', '14:45-16:15', 'Matematik', 1),
(625, '2. Sınıf', 'Salı', '09:00-10:30', 'Matematik', 1),
(626, '2. Sınıf', 'Salı', '10:45-12:15', 'İngilizce', 1),
(627, '2. Sınıf', 'Salı', '13:00-14:30', 'Müzik', 1),
(628, '2. Sınıf', 'Salı', '14:45-16:15', 'Matematik', 1),
(629, '2. Sınıf', 'Çarşamba', '09:00-10:30', 'Türkçe', 1),
(630, '2. Sınıf', 'Çarşamba', '10:45-12:15', 'Türkçe', 1),
(631, '2. Sınıf', 'Çarşamba', '13:00-14:30', 'İngilizce', 1),
(632, '2. Sınıf', 'Çarşamba', '14:45-16:15', 'Matematik', 1),
(633, '2. Sınıf', 'Perşembe', '09:00-10:30', 'Fen Bilgisi', 1),
(634, '2. Sınıf', 'Perşembe', '10:45-12:15', 'Müzik', 1),
(635, '2. Sınıf', 'Perşembe', '13:00-14:30', 'Matematik', 1),
(636, '2. Sınıf', 'Perşembe', '14:45-16:15', 'Matematik', 1),
(637, '2. Sınıf', 'Cuma', '09:00-10:30', 'İngilizce', 1),
(638, '2. Sınıf', 'Cuma', '10:45-12:15', 'İngilizce', 1),
(639, '2. Sınıf', 'Cuma', '13:00-14:30', 'İngilizce', 1),
(640, '2. Sınıf', 'Cuma', '14:45-16:15', 'Fen Bilgisi', 1),
(641, '3. Sınıf', 'Pazartesi', '09:00-10:30', 'Müzik', 1),
(642, '3. Sınıf', 'Pazartesi', '10:45-12:15', 'Fen Bilgisi', 1),
(643, '3. Sınıf', 'Pazartesi', '13:00-14:30', 'Matematik', 1),
(644, '3. Sınıf', 'Pazartesi', '14:45-16:15', 'Matematik', 1),
(645, '3. Sınıf', 'Salı', '09:00-10:30', 'Müzik', 1),
(646, '3. Sınıf', 'Salı', '10:45-12:15', 'Müzik', 1),
(647, '3. Sınıf', 'Salı', '13:00-14:30', 'Matematik', 1),
(648, '3. Sınıf', 'Salı', '14:45-16:15', 'Müzik', 1),
(649, '3. Sınıf', 'Çarşamba', '09:00-10:30', 'Müzik', 1),
(650, '3. Sınıf', 'Çarşamba', '10:45-12:15', 'Müzik', 1),
(651, '3. Sınıf', 'Çarşamba', '13:00-14:30', 'Matematik', 1),
(652, '3. Sınıf', 'Çarşamba', '14:45-16:15', 'Matematik', 1),
(653, '3. Sınıf', 'Perşembe', '09:00-10:30', 'İngilizce', 1),
(654, '3. Sınıf', 'Perşembe', '10:45-12:15', 'Müzik', 1),
(655, '3. Sınıf', 'Perşembe', '13:00-14:30', 'Müzik', 1),
(656, '3. Sınıf', 'Perşembe', '14:45-16:15', 'Matematik', 1),
(657, '3. Sınıf', 'Cuma', '09:00-10:30', 'İngilizce', 1),
(658, '3. Sınıf', 'Cuma', '10:45-12:15', 'Türkçe', 1),
(659, '3. Sınıf', 'Cuma', '13:00-14:30', 'Müzik', 1),
(660, '3. Sınıf', 'Cuma', '14:45-16:15', 'İngilizce', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `devamsizlik`
--

CREATE TABLE `devamsizlik` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `devamsizlik_suresi` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `devamsizlik`
--

INSERT INTO `devamsizlik` (`id`, `ogrenci_id`, `devamsizlik_suresi`) VALUES
(1, 22, 1),
(3, 14, 12),
(4, 13, 6),
(5, 15, 3),
(6, 23, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `etkinlikler`
--

CREATE TABLE `etkinlikler` (
  `id` int(11) NOT NULL,
  `tarih` date DEFAULT NULL,
  `etkinlik_adi` varchar(255) DEFAULT NULL,
  `etkinlik_saati` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `izin_tablosu`
--

CREATE TABLE `izin_tablosu` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `baslangic_tarihi` date NOT NULL,
  `bitis_tarihi` date NOT NULL,
  `aciklama` text DEFAULT NULL,
  `onay_durumu` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `izin_tablosu`
--

INSERT INTO `izin_tablosu` (`id`, `kullanici_id`, `baslangic_tarihi`, `bitis_tarihi`, `aciklama`, `onay_durumu`) VALUES
(9, 3, '2023-11-11', '2023-11-18', 'asdasd', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `kullanici_adi`, `email`, `sifre`, `rol`) VALUES
(3, 'Burcu Yeşim', 'burcu@email.com', '123', '1'),
(4, 'Meltem Büşra', 'meltem@email.com', '123', '1'),
(5, 'Zekeriya Ünal', 'zeko@email.com', '123', '1'),
(6, 'İsmail Demir', 'ismail@email.com', '123', '2'),
(8, 'Caner Demir', 'caner@email.com', '123', '2'),
(9, 'Adnan Korkmaz', 'adnan@email.com', '123', '2'),
(10, 'Ezgi Demir', 'ezgi@email.com', '123', '2'),
(11, 'Hacer Korkmaz', 'hacer@email.com', '123', '2'),
(12, 'Fatma Demir', 'fatma@email.com', '123', '2'),
(13, 'İsmet Korkmaz', 'ismet@email.com', '1232222', '2'),
(14, 'Ali Demir', 'ali@email.com', '123', '2'),
(15, 'Mükremin Korkmaz', 'müko@email.com', '123', '2'),
(17, 'Sıla Korkmaz', 'sıla@email.com', '123', '2'),
(18, 'Taylan Demir', 'taylan@email.com', '123', '2'),
(19, 'Gokhan Korkmaz', 'gokhan@email.com', '123', '2'),
(20, 'Hasım Demir', 'hasım@email.com', '123', '2'),
(21, 'Furkan Korkmaz', 'furkan@email.com', '123', '2'),
(22, 'Kasım Demir', 'Kasım@email.com', '123', '2'),
(23, 'Kübra Korkmaz', 'Kübra@email.com', '123', '2'),
(24, 'Halime Demir', 'Halime@email.com', '123', '2'),
(26, 'Mehmet Demir', 'Mehmet@email.com', '123', '2'),
(27, 'Ömer Korkmaz', 'Ömer@email.com', '123', '2'),
(28, 'Akın Demir', 'Akın@email.com', '123', '2'),
(29, 'Utku Korkmaz', 'Utku@email.com', '123', '2'),
(30, 'Ugur Aysa', 'omerakn0wwwss07@gmail.com', 'ad', '2'),
(31, 'Caner Demiraa', 'salkfs@gmail.com', '12312', '2'),
(32, 'Ugur Aygün', 'ugur@email.com', '123123', '2'),
(33, 'Ugur Ayaaa', 'emre_1213sss312@hotmail.com', '123', '2'),
(34, 'Fırat', 'eeeee@hotmail.com', 'dddd', '2'),
(35, 'Fırat Aydınus', 'firat@email.com', 'e123', '1'),
(36, 'Emre', 'emre@email.com', '12333', '0'),
(37, 'Ugur Ayaaaa', 'emre_12eee13312@hotmail.com', '123', '2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `alici_id` int(11) NOT NULL,
  `mesaj` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `gonderen_id` int(11) NOT NULL,
  `konu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `alici_id`, `mesaj`, `tarih`, `gonderen_id`, `konu`) VALUES
(1, 8, 'İzin tarihiniz onaylandı!', '2023-11-23 07:04:25', 36, ''),
(2, 6, 'İzin tarihiniz onaylandı!', '2023-11-23 07:07:14', 36, ''),
(3, 8, 'İzin tarihiniz onaylandı!', '2023-11-23 07:07:35', 36, ''),
(4, 6, 'İzin tarihiniz onaylandı!', '2023-11-23 07:15:50', 36, ''),
(5, 8, 'İzin tarihiniz onaylandı!', '2023-11-23 07:17:22', 36, ''),
(6, 6, '', '2023-11-23 07:18:06', 36, ''),
(7, 3, 'İzin tarihi onaylandı!', '2023-11-23 07:18:52', 36, ''),
(8, 3, 'İzin tarihiniz onaylandı!', '2023-11-23 07:20:47', 36, ''),
(9, 3, 'İzin tarihiniz onaylandı!', '2023-11-23 07:21:32', 36, ''),
(10, 3, 'İzin tarihiniz onaylanmadı!', '2023-11-23 07:21:34', 36, ''),
(11, 6, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(12, 8, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(13, 9, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(14, 10, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(15, 11, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(16, 12, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(17, 13, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(18, 14, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(19, 15, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(20, 17, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(21, 18, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(22, 19, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(23, 20, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(24, 21, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(25, 22, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(26, 23, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(27, 24, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(28, 26, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(29, 27, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(30, 28, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(31, 29, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(32, 30, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(33, 31, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(34, 32, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(35, 33, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(36, 34, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(37, 37, 'asd', '2023-11-23 07:37:57', 36, 'Firmanın Durumu'),
(38, 35, 'İzin tarihiniz onaylandı!', '2023-11-23 07:39:43', 36, ''),
(39, 3, 'Hocam merhabaalar, proje ödevini gönderdim ama puan gırmedınız.', '2023-11-23 09:29:57', 36, 'Ders'),
(40, 3, 'Hocam naber', '2023-11-23 09:31:04', 6, 'Firmanın Durumu'),
(41, 36, 'Hocam okul çok kötü he', '2023-11-23 09:33:57', 3, 'Okulun'),
(42, 3, 'asdsad', '2023-11-23 09:39:01', 3, 'Firmanın Durumu'),
(43, 3, 'sadsadas', '2023-11-23 09:39:37', 36, 'Firmanın Durumu'),
(44, 36, 'asdas', '2023-11-23 09:39:59', 3, 'Firmanın Durumu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) DEFAULT NULL,
  `ders_id` int(11) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `s2` int(11) DEFAULT NULL,
  `proje` int(11) DEFAULT NULL,
  `ortalama` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `sinif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`id`, `ad_soyad`, `email`, `sifre`, `sinif`) VALUES
(13, 'İsmet Korkmaz', 'ismet@email.com', '1232222', '1. sınıf'),
(14, 'Ali Demir', 'ali@email.com', '123', '2. sınıf'),
(15, 'Mükremin Korkmaz', 'müko@email.com', '123', '2. sınıf'),
(17, 'Sıla Korkmaz', 'sila@email.com', '123', '2. sınıf'),
(19, 'Gokhan Korkmaz', 'gokhan@email.com', '123', '2. sınıf'),
(20, 'Hasım Demir', 'hasim@email.com', '123', '2. sınıf'),
(21, 'Furkan Korkmaz', 'furkan@email.com', '123', '2. sınıf'),
(22, 'Kasım Demir', 'kasim@email.com', '123', '3. sınıf'),
(23, 'Kübra Korkmaz', 'kubra@email.com', '123', '3. sınıf'),
(24, 'Halime Demir', 'halime@email.com', '123', '3. sınıf'),
(26, 'Mehmet Demir', 'mehmet@email.com', '123', '3. sınıf'),
(27, 'Ömer Korkmaz', 'omer@email.com', '123', '3. sınıf'),
(28, 'Akın Demir', 'akin@email.com', '123', '3. sınıf'),
(29, 'Utku Korkmaz', 'utku@email.com', '123', '3. sınıf'),
(30, 'Ugur Ay', 'emre_1213312@hotmail.com', '123', '2. Sınıf'),
(40, 'Ugur Ayaaa', 'emre_1213sss312@hotmail.com', '123', '2. Sınıf'),
(41, 'Ugur Ayaaaa', 'emre_12eee13312@hotmail.com', '123', '2. Sınıf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci_sinav_proje_tarihleri`
--

CREATE TABLE `ogrenci_sinav_proje_tarihleri` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) DEFAULT NULL,
  `sinif` int(11) DEFAULT NULL,
  `sinav_tarihi` date DEFAULT NULL,
  `proje_tarihi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmen`
--

CREATE TABLE `ogretmen` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `dersAdi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ogretmen`
--

INSERT INTO `ogretmen` (`id`, `ad_soyad`, `email`, `sifre`, `dersAdi`) VALUES
(3, 'Burcu Yeşim', 'burcu@email.com', '123', 'Türkçe'),
(4, 'Meltem Büşra', 'meltem@email.com', '123', 'Fen Bilgisi'),
(5, 'Zekeriya Ünal', 'zeko@email.com', '123', 'İngilizce'),
(6, 'Hakan Safa', 'hakana@email.com', '123', 'Müzik'),
(8, 'Fırat Aydınus', 'firat@email.com', 'e123', 'Sosyal Bilgiler');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `dersler`
--
ALTER TABLE `dersler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogretmen_id` (`ogretmen_id`);

--
-- Tablo için indeksler `ders_programi`
--
ALTER TABLE `ders_programi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `devamsizlik`
--
ALTER TABLE `devamsizlik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`);

--
-- Tablo için indeksler `etkinlikler`
--
ALTER TABLE `etkinlikler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `izin_tablosu`
--
ALTER TABLE `izin_tablosu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alici_id` (`alici_id`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`),
  ADD KEY `ders_id` (`ders_id`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `ogrenci_sinav_proje_tarihleri`
--
ALTER TABLE `ogrenci_sinav_proje_tarihleri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`);

--
-- Tablo için indeksler `ogretmen`
--
ALTER TABLE `ogretmen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ders_programi`
--
ALTER TABLE `ders_programi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=661;

--
-- Tablo için AUTO_INCREMENT değeri `devamsizlik`
--
ALTER TABLE `devamsizlik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `etkinlikler`
--
ALTER TABLE `etkinlikler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `izin_tablosu`
--
ALTER TABLE `izin_tablosu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci_sinav_proje_tarihleri`
--
ALTER TABLE `ogrenci_sinav_proje_tarihleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ogretmen`
--
ALTER TABLE `ogretmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `devamsizlik`
--
ALTER TABLE `devamsizlik`
  ADD CONSTRAINT `devamsizlik_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`);

--
-- Tablo kısıtlamaları `izin_tablosu`
--
ALTER TABLE `izin_tablosu`
  ADD CONSTRAINT `izin_tablosu_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici` (`id`);

--
-- Tablo kısıtlamaları `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD CONSTRAINT `mesajlar_ibfk_1` FOREIGN KEY (`alici_id`) REFERENCES `kullanici` (`id`);

--
-- Tablo kısıtlamaları `notlar`
--
ALTER TABLE `notlar`
  ADD CONSTRAINT `notlar_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`),
  ADD CONSTRAINT `notlar_ibfk_2` FOREIGN KEY (`ders_id`) REFERENCES `dersler` (`id`);

--
-- Tablo kısıtlamaları `ogrenci_sinav_proje_tarihleri`
--
ALTER TABLE `ogrenci_sinav_proje_tarihleri`
  ADD CONSTRAINT `ogrenci_sinav_proje_tarihleri_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

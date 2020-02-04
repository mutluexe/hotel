-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Şub 2020, 11:37:12
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hotel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `guest`
--

CREATE TABLE `guest` (
  `guestPK` int(11) NOT NULL,
  `firstname` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `birthDate` date NOT NULL,
  `address` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `idNo` varchar(11) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `guest`
--

INSERT INTO `guest` (`guestPK`, `firstname`, `lastname`, `birthDate`, `address`, `idNo`) VALUES
(1, 'john', 'doe', '1974-02-02', 'lorem ipsum dolor', '12312323123'),
(2, 'jack', 'ripper', '1944-01-03', 'lorem ipsum dolor', '12312323124'),
(3, 'van', 'helsing', '1874-05-23', 'lorem ipsum dolor', '12312323120'),
(4, 'naruto', 'uzumaki', '1998-04-04', 'konoha', '32132132321'),
(5, 'linus', 'torvalds', '1952-05-05', '', '12312365123'),
(12, 'haluk', 'bilginer', '1942-05-11', 'istanbul', '65454654564'),
(13, 'Mutlu', 'donmez', '1998-06-10', 'Ahatli', '34856268321'),
(14, 'Ilkin', 'Mamedov', '1970-01-01', 'asdasdasd', '34856268323'),
(15, 'melih', 'gunay', '1980-05-10', 'asdasda', '34856268364');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `room`
--

CREATE TABLE `room` (
  `roomPK` int(11) NOT NULL,
  `type` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `room`
--

INSERT INTO `room` (`roomPK`, `type`, `capacity`, `roomNo`, `price`) VALUES
(1, 'double', 2, 201, 30),
(2, 'double', 2, 202, 30),
(3, 'triple', 3, 301, 50),
(6, 'triple', 3, 302, 50),
(7, 'triple', 3, 303, 50),
(9, 'queen', 2, 401, 80),
(10, 'queen', 2, 402, 80),
(12, 'king', 1, 501, 70);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sghelper`
--

CREATE TABLE `sghelper` (
  `sghelperID` int(11) NOT NULL,
  `guestFK` int(11) NOT NULL,
  `stayFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sghelper`
--

INSERT INTO `sghelper` (`sghelperID`, `guestFK`, `stayFK`) VALUES
(14, 1, 22),
(15, 15, 23);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stay`
--

CREATE TABLE `stay` (
  `stayPK` int(11) NOT NULL,
  `checkinDate` date NOT NULL,
  `checkoutDate` date NOT NULL,
  `reservDate` date NOT NULL,
  `payment` int(11) NOT NULL,
  `roomFK` int(11) NOT NULL,
  `userFK` int(11) NOT NULL,
  `guestFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `stay`
--

INSERT INTO `stay` (`stayPK`, `checkinDate`, `checkoutDate`, `reservDate`, `payment`, `roomFK`, `userFK`, `guestFK`) VALUES
(22, '2019-05-05', '2019-05-08', '2019-05-04', 30, 1, 2, 1),
(23, '1970-01-01', '1970-01-01', '1970-01-01', 50, 7, 2, 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(2, 'administrator', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guestPK`),
  ADD UNIQUE KEY `idNo` (`idNo`);

--
-- Tablo için indeksler `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomPK`),
  ADD UNIQUE KEY `roomNo` (`roomNo`);

--
-- Tablo için indeksler `sghelper`
--
ALTER TABLE `sghelper`
  ADD PRIMARY KEY (`sghelperID`),
  ADD KEY `guestFK` (`guestFK`),
  ADD KEY `sghelper_ibfk_2` (`stayFK`);

--
-- Tablo için indeksler `stay`
--
ALTER TABLE `stay`
  ADD PRIMARY KEY (`stayPK`),
  ADD KEY `roomFK` (`roomFK`),
  ADD KEY `userFK` (`userFK`),
  ADD KEY `guestFK` (`guestFK`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `guest`
--
ALTER TABLE `guest`
  MODIFY `guestPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `room`
--
ALTER TABLE `room`
  MODIFY `roomPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `sghelper`
--
ALTER TABLE `sghelper`
  MODIFY `sghelperID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `stay`
--
ALTER TABLE `stay`
  MODIFY `stayPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `sghelper`
--
ALTER TABLE `sghelper`
  ADD CONSTRAINT `sghelper_ibfk_1` FOREIGN KEY (`guestFK`) REFERENCES `guest` (`guestPK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sghelper_ibfk_2` FOREIGN KEY (`stayFK`) REFERENCES `stay` (`stayPK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `stay`
--
ALTER TABLE `stay`
  ADD CONSTRAINT `stay_ibfk_1` FOREIGN KEY (`roomFK`) REFERENCES `room` (`roomPK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stay_ibfk_2` FOREIGN KEY (`userFK`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stay_ibfk_3` FOREIGN KEY (`guestFK`) REFERENCES `guest` (`guestPK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

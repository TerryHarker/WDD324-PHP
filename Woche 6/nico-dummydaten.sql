-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Apr 2025 um 20:11
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `wdd324_demo`
--

--
-- Daten für Tabelle `post`
--

INSERT INTO `post` (`ID`, `title`, `content`, `createdate`, `status`, `user_ID`) VALUES
(1, 'Phasellus sit amet erat.', 'Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.', '2024-01-12 01:31:20', 0, 2),
(2, 'Nulla facilisi.', 'Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.', '2024-06-21 03:12:27', 1, 1),
(3, 'Donec odio justo, sollicitudin ut, suscipit a', 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.', '2025-03-01 04:39:23', 1, 2),
(4, 'Sed vel enim sit amet nunc viverra dapibus.', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '2024-07-15 13:30:20', 1, 1),
(5, 'Donec odio justo, sollicitudin ut, suscipit a', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.', '2024-02-25 12:18:56', 1, 2),
(6, 'Fusce posuere felis sed lacus.', 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.', '2025-01-01 05:07:58', 0, 1),
(7, 'Fusce posuere felis sed lacus.', 'Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.', '2024-03-01 08:35:45', 0, 2),
(8, 'Proin at turpis a pede posuere nonummy.', 'Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.', '2024-10-08 09:23:21', 1, 1),
(9, 'Etiam pretium iaculis justo.', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', '2024-03-07 12:25:20', 1, 2),
(10, 'Ut at dolor quis odio consequat varius.', 'Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.', '2024-10-19 12:13:15', 1, 2);

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`ID`, `imgurl`, `title`, `subtitle`, `status`) VALUES
(1, 'Business-20.png', 'Business 20', '2025', 1),
(2, 'eaef_Blurr-402x.jpg', 'BLurr', '2025', 1),
(3, 'Pompeo.jpg', 'Pompeo', '2024', 1),
(4, 'biznus.jpg', 'BizNus', '2023', 1);

--
-- Daten für Tabelle `tag`
--

INSERT INTO `tag` (`ID`, `name`) VALUES
(1, 'PHP'),
(2, 'JavaScript'),
(3, 'Design');

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `email`, `password`) VALUES
(1, 'nico@gmail.com', '$2y$10$hZq6JCytywpsNsggnegiWu0KxLCSbiWw7BAk3u1GbIi35mrm3qr5W'),
(2, 'dani@gmail.com', '$2y$10$GhIWhHI/OJH3eAWMHvk3zecVSeR4mdmLp1lp/oNBMWN22yra22rf6');
COMMIT;


INSERT INTO `post_tag` (`post_ID`, `tag_ID`) VALUES ('1', '2'), ('1', '3'), ('2', '1'), ('3', '1'), ('3', '2'), ('5', '1'), ('6', '2'), ('7', '3'), ('8', '1'), ('10', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

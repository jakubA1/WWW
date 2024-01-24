-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 24, 2024 at 05:00 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'Mleko'),
(3, 0, 'rereT'),
(7, 0, 'wewe'),
(8, 0, 'wewe'),
(9, 0, 'nmnm'),
(10, 1, 'BBB'),
(11, 0, 'CCC'),
(13, 0, 'BBBBBB'),
(14, 0, 'lol');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Strona główna', '	<style>\r\n	body{\r\n		background-image: url(./img/tlo_sglowna.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n	</style>\r\n	<header class=\"hglowna\">\r\n        <h1>Historia lotów kosmicznych</h1>\r\n    </header>\r\n		<table>\r\n			<tr>\r\n				<td><p style=\"text-align: justify\";>\r\n				Pierwsze realne propozycje podróży kosmicznych przypisywane są Konstantinowi Ciołkowskiemu. Jego najsłynniejsze dzieło, „Исследование мировых пространств реактивными приборами” (Eksploracja przestrzeni kosmicznej dzięki urządzeniom odrzutowym), zostało opublikowane w roku 1903, ale ta teoretyczna rozprawa nie była szeroko znana poza Rosją.\r\n				<br></br>\r\n				Loty kosmiczne stały się możliwe z inżynierskiego punktu widzenia po publikacji Roberta Goddarda Metoda osiągania ekstremalnych wysokości, w której zaproponował szereg konkretnych rozwiązań pozwalających na zasadnicze ulepszenie rakiet, m.in. przez zastosowanie dyszy de Lavala do silników rakietowych. Dysza pozwala na osiągnięcie naddźwiękowego wypływu gazu. Co najważniejsze, R. Goddard zbudował rakiety na paliwo ciekłe i rozwiązał szereg związanych z nimi problemów (m.in. sterowanie rakietą). Prace jego miały wielki wpływ na Hermanna Obertha i Wernhera von Brauna, później kluczowe postaci z dziedziny lotów kosmicznych.\r\n				<br></br>\r\n				Pierwszą rakietą, która dotarła do przestrzeni kosmicznej była niemiecka rakieta V2 w czasie lotu testowego 3 października 1942. 4 października 1957 Związek Socjalistycznych Republik Radzieckich wystrzelił Sputnika 1, który stał się pierwszym sztucznym satelitą na orbicie Ziemi. Pierwszym lotem załogowym była misja Wostok 1 12 kwietnia 1961 – na pokładzie pojazdu znajdował się kosmonauta Jurij Gagarin, który dokonał jednego okrążenia wokół Ziemi.\r\n				<br></br>\r\n				Rakiety pozostają jedynymi praktycznymi środkami dotarcia do przestrzeni kosmicznej. Inne techniki jak scramjet, w dalszym ciągu nie pozwalają na osiągnięcie prędkości orbitalnej.\r\n				</p></td>\r\n				<td><img class=\"imglw\" src=\"./img/proton.jpg\" alt=\"proton\"></td>\r\n			<tr>\r\n		</table>\r\n	\r\n	<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n		<FORM METHOD=\"POST\" NAME=\"background\">\r\n		<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_sglowna.jpg\')\">\r\n		</FORM>\r\n	</div>', 1),
(2, 'Pionierzy Kosmosu', '	<style>\r\n	body{\r\n		background-image: url(./img/tlo_p.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n	</style>\r\n	<header>\r\n        <h1>Pionierzy Kosmosu</h1>\r\n    </header>\r\n\r\n    <div class=\"content\">\r\n        <section class=\"p1\">\r\n            <h2>Wernher von Braun</h2>\r\n            <p>Niemiecki i amerykański inżynier i architekt rakiet. Kluczowa postać w rozwoju rakiet balistycznych w Niemczech i późniejszym programie kosmicznym USA.</p>\r\n            <img src=\"./img/Wernher.jpg\" alt=\"Wernher\">\r\n        </section>\r\n\r\n        <section class=\"p1\">\r\n            <h2>Sergei Korolev</h2>\r\n            <p>Główny konstruktor radzieckiego programu kosmicznego, odpowiedzialny za pierwsze satelity, misje międzyplanetarne i pierwszego człowieka w kosmosie.</p>\r\n            <img src=\"./img/Korolev.jpg\" alt=\"Korolev\">\r\n        </section>\r\n\r\n        <section class=\"p1\">\r\n            <h2>NASA</h2>\r\n            <p>Narodowa Agencja Aeronautyki i Przestrzeni Kosmicznej, lider w badaniach kosmicznych, odpowiedzialna za misje Apollo, Teleskop Hubble\'a i Mars Rovers.</p>\r\n            <img src=\"./img/NASA.png\" alt=\"NASA\">\r\n        </section>\r\n    </div>\r\n	\r\n	<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n		<FORM METHOD=\"POST\" NAME=\"background\">\r\n		<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_p.jpg\')\">\r\n		</FORM>\r\n	</div>\r\n\r\n\r\n', 1),
(3, 'Misje Historyczne', '	<style>\r\n	body{\r\n		background-image: url(./img/tlo_p.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n	</style>\r\n	<header>\r\n        <h1>Misje Historyczne Lotów Kosmicznych</h1>\r\n    </header>\r\n\r\n    <div class=\"content\">\r\n	\r\n        <section class=\"p1\">\r\n            <h2>Apollo 11</h2>\r\n            <p>Pierwsza misja, która wylądowała ludzi na Księżycu. Astronauci Neil Armstrong i Buzz Aldrin stanęli na Księżycu 20 lipca 1969 roku.</p>\r\n            <img src=\"./img/Apollo11.png\" alt=\"Apollo11\">\r\n        </section>\r\n\r\n        <section class=\"p1\">\r\n            <h2>Program Sojuz</h2>\r\n            <p>Seria załogowych lotów kosmicznych realizowanych przez Związek Radziecki i Rosję, w tym pierwszy lot człowieka w kosmosie.</p>\r\n            <img src=\"./img/Sojuz.jpg\" alt=\"Sojuz\">\r\n        </section>\r\n\r\n        <section class=\"p1\">\r\n            <h2>Mars Rover Missions</h2>\r\n            <p>Misje łazików marsjańskich, które przesyłały cenne dane naukowe z powierzchni Marsa, w tym Curiosity i Perseverance.</p>\r\n            <img src=\"./img/Mars.jpg\" alt=\"Mars\">\r\n        </section>\r\n		\r\n    </div>\r\n	\r\n	<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n		<FORM METHOD=\"POST\" NAME=\"background\">\r\n		<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_p.jpg\')\">\r\n		</FORM>\r\n	</div>\r\n\r\n\r\n', 1),
(4, 'Technologia i Statki Kosmiczne', '	<style>\r\n	body{\r\n		background-image: url(./img/tlo_p.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n	</style>\r\n	<header>\r\n        <h1>Technologia i Statki Kosmiczne</h1>\r\n    </header>\r\n	\r\n	<div class=\"content\">\r\n	\r\n		<section class=\"p1\">\r\n			<h2>Rakieta Saturn V</h2>\r\n			<p>Rakieta Saturn V była używana przez program Apollo NASA i jest uważana za kamień milowy w historii lotów kosmicznych. To właśnie dzięki niej ludzie po raz pierwszy stanęli na Księżycu.</p>\r\n			<img src=\"./img/Saturn5.jpg\" alt=\"Saturn V\">\r\n		</section>\r\n		\r\n		<section class=\"p1\">\r\n			<h2>SpaceX Starship</h2>\r\n			<p>Starship, opracowany przez SpaceX, to wielokrotnego użytku statek kosmiczny zaprojektowany do przewożenia ludzi i ładunków na Marsa i inne cele w Układzie Słonecznym.</p>\r\n			<img style=\"max-width: 30%;\" src=\"./img/Starship.jpg\" alt=\"Starship\">\r\n		</section>\r\n		\r\n		<section class=\"p1\">\r\n			<h2>Napędy Jądrowe</h2>\r\n			<p>Napędy jądrowe to przyszłościowa technologia, która może znacznie skrócić czas podróży międzyplanetarnych, otwierając nowe możliwości w eksploracji kosmosu.</p>\r\n			<img src=\"./img/naped.jpg\" alt=\"Napęd Jądrowy\">\r\n		</section>\r\n		\r\n	</div>\r\n	\r\n	<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n		<FORM METHOD=\"POST\" NAME=\"background\">\r\n		<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_p.jpg\')\">\r\n		</FORM>\r\n	</div>', 1),
(5, 'Nauka w kosmosie', '	<style>\r\n	body{\r\n		background-image: url(./img/tlo_p.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n	</style>\r\n	<header>\r\n        <h1>Nauka w Kosmosie</h1>\r\n    </header>\r\n	\r\n	<div class=\"content\">\r\n	\r\n		<section class=\"p1\">\r\n			<h2>Badania na Międzynarodowej Stacji Kosmicznej</h2>\r\n			<p>ISS jest laboratorium naukowym, gdzie przeprowadzane są eksperymenty w mikrograwitacji, które nie mogłyby zostać wykonane na Ziemi.</p>\r\n			<img src=\"./img/ISS.jpg\" alt=\"ISS\">\r\n		</section>\r\n		\r\n		<section class=\"p1\">\r\n			<h2>Obserwacje Astronomiczne</h2>\r\n			<p>Teleskopy kosmiczne takie jak Hubble pozwalają astronomom na obserwowanie gwiazd i galaktyk w świetle, które nie dociera do powierzchni Ziemi.</p>\r\n			<img src=\"./img/Hubb.jpg\" alt=\"Teleskop Hubbla\">\r\n		</section>\r\n		\r\n		<section class=\"p1\">\r\n			<h2>Badania Planetarne</h2>\r\n			<p>Misje takie jak Voyager i Cassini przekazują nam informacje o planetach naszego Układu Słonecznego i ich księżycach.</p>\r\n			<img src=\"./img/Voyager.jpg\" alt=\"Voyager\">\r\n		</section>\r\n	\r\n	</div>\r\n	\r\n	<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n		<FORM METHOD=\"POST\" NAME=\"background\">\r\n		<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_p.jpg\')\">\r\n		</FORM>\r\n	</div>', 1),
(6, 'Przyszłość Eksploracji Kosmicznej', '	<style>\r\n	body{\r\n		background-image: url(./img/tlo_p.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n	</style>\r\n	<header>\r\n        <h1>Przyszłość Eksploracji Kosmicznej</h1>\r\n    </header>\r\n	\r\n	<div class=\"content\">\r\n	\r\n		<section class=\"p1\">\r\n			<h2>Planowane Misje na Marsa</h2>\r\n			<p>Opis planowanych misji na Marsa, ich celów i oczekiwanych wyników, w tym plany kolonizacji Marsa przez różne agencje kosmiczne.</p>\r\n			<img src=\"./img/MarsBaza.jpg\" alt=\"Baza Mars\">\r\n		</section>\r\n		\r\n		<section class=\"p1\">\r\n			<h2>Powrót na Księżyc</h2>\r\n			<p>Omówienie przyszłych misji na Księżyc, w tym plany budowy stałych baz na jego powierzchni i dalszej eksploracji.</p>\r\n			<img src=\"./img/ksiezyc.jpg\" alt=\"ksiezyc\">\r\n		</section>\r\n		\r\n		<section class=\"p1\">\r\n			<h2>Nowe Technologie w Eksploracji Kosmicznej</h2>\r\n			<p>Przedstawienie przyszłych technologii, które mogą rewolucjonizować podróże kosmiczne, takich jak napędy jądrowe czy zaawansowane systemy życia.</p>\r\n			<img src=\"./img/Tech.png\" alt=\"Technologie\">\r\n		</section>\r\n		\r\n	</div>\r\n	\r\n	<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n		<FORM METHOD=\"POST\" NAME=\"background\">\r\n		<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n		<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n		<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_p.jpg\')\">\r\n		</FORM>\r\n	</div>', 1),
(7, 'Filmy', '<!DOCTYPE html>\r\n<html lang=\"pl\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Strona z Filmami</title>\r\n    <link rel=\"stylesheet\" href=\"./css/films.css\">\r\n</head>\r\n<body>\r\n\r\n<style>\r\n	body{\r\n		background-image: url(./img/tlo_p.jpg);\r\n		background-size: cover;\r\n        background-repeat: no-repeat;\r\n	}\r\n</style>\r\n\r\n<header>\r\n    <h1>Strona z Filmami</h1>\r\n</header>\r\n\r\n<section class=\"film-gallery\">\r\n    <div class=\"film\">\r\n        <iframe src=\"https://www.youtube.com/embed/v1RfDc9RZc0?si=X59qg7QgBmAu3j3s\"\" frameborder=\"0\" allowfullscreen></iframe>\r\n        <p>Krótka Historia Rakiet i Lotów Kosmicznych</p>\r\n    </div>\r\n    <div class=\"film\">\r\n        <iframe src=\"https://www.youtube.com/embed/Neyj2rQZxYE?si=AhvHfLjepLSDJiya\" frameborder=\"0\" allowfullscreen></iframe>\r\n        <p>Pierwsi Ludzie w Kosmosie</p>\r\n    </div>\r\n    <div class=\"film\">\r\n        <iframe src=\"https://www.youtube.com/embed/PLcE3AI9wwE?si=x682MMTQdU5kv0Mp\" frameborder=\"0\" allowfullscreen></iframe>\r\n        <p>A Quick History of Space Exploration</p>\r\n    </div>\r\n</section>\r\n\r\n<div style=\"item-align:center; position: fixed; bottom : 0; padding: 10px;\">\r\n	<FORM METHOD=\"POST\" NAME=\"background\">\r\n	<INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#FFF000\')\"> \r\n	<INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#000000\')\"> \r\n	<INPUT TYPE=\"button\" VALUE=\"biały\" ONCLICK=\"changeBackground(\'#FFFFFF\')\"> \r\n	<INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#00FF00\')\"> \r\n	<INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0000FF\')\">\r\n	<INPUT TYPE=\"button\" VALUE=\"pomarańczowy\" ONCLICK=\"changeBackground(\'#FF8000\')\"> \r\n	<INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#c0c0c0\')\"> \r\n	<INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#FF0000\')\">\r\n	<INPUT TYPE=\"button\" VALUE=\"grafika\" ONCLICK=\"changeBackgroundPicture(\'./img/tlo_p.jpg\')\">\r\n	</FORM>\r\n</div>\r\n\r\n</body>\r\n</html>\r\n', 1),
(8, 'Kontakt', '<!DOCTYPE html>\r\n<html lang=\"pl\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Kontakt</title>\r\n</head>\r\n<body>\r\n\r\n<style>\r\n	.contact {\r\n    max-width: 600px;\r\n    margin: 20px auto;\r\n    padding: 20px;\r\n    background-color: #f8f9fa;\r\n    border: 1px solid #ddd;\r\n    border-radius: 8px;\r\n	}\r\n\r\n	.contact h2 {\r\n		color: #333;\r\n	}\r\n\r\n	.contact p {\r\n		color: #333;\r\n		text-align: left;\r\n	}\r\n\r\n	.contact form {\r\n		display: flex;\r\n		flex-direction: column;\r\n		gap: 10px;\r\n	}\r\n\r\n	.contact input[type=\"text\"],\r\n\r\n	.contact textarea {\r\n		padding: 10px;\r\n		margin-top: 5px;\r\n		border: 1px solid #ccc;\r\n		border-radius: 4px;\r\n	}\r\n\r\n	.contact input[type=\"submit\"] {\r\n		padding: 10px 20px;\r\n		background-color: #007bff;\r\n		color: white;\r\n		border: none;\r\n		border-radius: 4px;\r\n		cursor: pointer;\r\n		transition: background-color 0.3s ease;\r\n	}\r\n\r\n	.contact input[type=\"submit\"]:hover {\r\n		background-color: #0056b3;\r\n	}\r\n</style>\r\n\r\n<div class=\"contact\">\r\n	<h2>Kontakt</h2>\r\n	<p>Wyslij nam maila, jeżeli masz pytania.</p>\r\n	<form action=\"167357@student.uwm.edu.pl\" method=\"post\" enctype=\"text/plain\">\r\n		Twój e-mail: <input type=\"text\" name=\"email\"><br>\r\n		Twoja wiadomość:<br>\r\n		<textarea name=\"wiadomosc\" rows=\"5\" cols=\"40\"></textarea><br>\r\n		<input type=\"submit\" value=\"Wyślij\">\r\n	</form>\r\n</div>\r\n\r\n</body>\r\n</html>', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt`
--

CREATE TABLE `produkt` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `data_utworzenia` datetime NOT NULL,
  `data_modyfikacji` datetime NOT NULL,
  `data_wygasniecia` datetime NOT NULL,
  `cena_netto` float(10,2) NOT NULL,
  `podatek_vat` float(10,2) NOT NULL,
  `ilosc_dostepnych_sztuk` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `kategoria` varchar(255) NOT NULL,
  `gabaryt` varchar(255) NOT NULL,
  `zdjecie` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkt`
--

INSERT INTO `produkt` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_dostepnych_sztuk`, `status`, `kategoria`, `gabaryt`, `zdjecie`) VALUES
(2, 'Szklanka', 'szkło', '2024-01-23 00:34:13', '2024-01-23 00:46:56', '0000-00-00 00:00:00', 5.00, 1.00, 19, 1, 'Kuchnia', 'Mały', ''),
(16, 'Zegarek', 'oo', '2024-01-24 02:03:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 200.00, 23.00, 22, 1, 'Akcesoria', 'Mały', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

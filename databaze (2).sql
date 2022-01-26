-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 25. led 2022, 14:08
-- Verze serveru: 10.4.20-MariaDB
-- Verze PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `databaze`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `pojisteni-aut`
--

CREATE TABLE `pojisteni-aut` (
  `ID` int(4) NOT NULL,
  `uzivatele_id` int(5) NOT NULL,
  `nazev_pojisteni` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `druh_auta` varchar(55) COLLATE utf8mb4_czech_ci NOT NULL,
  `cena_auta` int(10) NOT NULL,
  `delka_pojisteni` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL,
  `mesicni_splatka` int(10) NOT NULL,
  `typ_druh` text COLLATE utf8mb4_czech_ci NOT NULL,
  `datum_vytvoreni` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL,
  `obrazek` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `pojisteni-aut`
--

INSERT INTO `pojisteni-aut` (`ID`, `uzivatele_id`, `nazev_pojisteni`, `druh_auta`, `cena_auta`, `delka_pojisteni`, `mesicni_splatka`, `typ_druh`, `datum_vytvoreni`, `obrazek`) VALUES
(126, 1, 'Poj-Auto-1-687', 'osobní', 1200000, '3 roky', 4800, 'škoda fabia 1.2 htp', '25.1.2022', 'osobni');

-- --------------------------------------------------------

--
-- Struktura tabulky `pojistne_udalosti`
--

CREATE TABLE `pojistne_udalosti` (
  `ID` int(4) NOT NULL,
  `pojisteni_id` int(4) NOT NULL,
  `uzivatel_id` int(4) NOT NULL,
  `typ_udalosti` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `obsah` text COLLATE utf8mb4_czech_ci NOT NULL,
  `datum_vytvoreni` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `uzivatele_id` int(11) NOT NULL,
  `prezdivka` varchar(40) COLLATE utf8mb4_czech_ci NOT NULL,
  `jmeno` varchar(40) COLLATE utf8mb4_czech_ci NOT NULL,
  `prijmeni` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_czech_ci NOT NULL,
  `heslo` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`uzivatele_id`, `prezdivka`, `jmeno`, `prijmeni`, `email`, `heslo`, `admin`) VALUES
(1, 'Vincent', 'Vincent', 'Doležal', 'vvincent848@gmail.com', '$2y$10$KWe7ngSfJKl6zHMtjiql..bLpE7SE1A26ee3H1OM8ZnAB3w7RRZGO', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `pojisteni-aut`
--
ALTER TABLE `pojisteni-aut`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexy pro tabulku `pojistne_udalosti`
--
ALTER TABLE `pojistne_udalosti`
  ADD PRIMARY KEY (`ID`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`uzivatele_id`),
  ADD UNIQUE KEY `uzivatele_id` (`uzivatele_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `prezdivka` (`prezdivka`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `pojisteni-aut`
--
ALTER TABLE `pojisteni-aut`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT pro tabulku `pojistne_udalosti`
--
ALTER TABLE `pojistne_udalosti`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `uzivatele_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

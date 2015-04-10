-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 10 apr 2015 om 18:09
-- Serverversie: 5.5.39
-- PHP-versie: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `jackskb5_sICT`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wp_cforms`
--

CREATE TABLE IF NOT EXISTS `wp_cforms` (
`id` int(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `wp_cforms`
--

INSERT INTO `wp_cforms` (`id`, `title`, `content`) VALUES
(1, 'Klantgegevens', '<div class="aanmelden_blok">\r\n					<h3>Klantgegevens aanvrager</h3>\r\n\r\n					<div style="width: 50%; float: left;">\r\n						<table cellpadding="0" cellspacing="0">\r\n							<tr>\r\n								<td style="width:141px;">Bedrijf:</td>\r\n								<td><input type="text" name="aanmeldbedrijf" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Aanhef:</td>\r\n								<td><input type="text" name="aanmeldaanhef" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Naam:</td>\r\n								<td><input type="text" name="aanmeldnaam" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Adres + Huisnummer:</td>\r\n								<td><input type="text" name="aanmeldadres" value="" style="width:174px;" /> <input type="text" name="aanmeldhuisnr" value="" style="width:28px;" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Postcode:</td>\r\n								<td><input type="text" name="aanmeldpostc" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Woonplaats:</td>\r\n								<td><input type="text" name="aanmeldplaats" value="" /></td>\r\n							</tr>\r\n						</table>\r\n					</div>\r\n\r\n\r\n\r\n\r\n\r\n					<div style="width: 50%; float: left;">\r\n						<table cellpadding="0" cellspacing="0">\r\n							<tr>\r\n								<td style="width:141px;">Fax:</td>\r\n								<td><input type="text" name="aanmeldfax" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Telefoon:</td>\r\n								<td><input type="text" name="aanmeldtelnr" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>E-mail:</td>\r\n								<td><input type="text" name="aanmeldemail" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>KvK nummer:</td>\r\n								<td><input type="text" name="aanmeldkvknr" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>BTW nummer</td>\r\n								<td><input type="text" name="aanmeldbtwnr" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Ligitimatienummer</td>\r\n								<td><input type="text" name="aanmeldliginr" value="" /></td>\r\n							</tr>\r\n						</table>\r\n					</div>\r\n\r\n\r\n\r\n\r\n\r\n					<div style="clear:both;"></div>\r\n\r\n\r\n\r\n\r\n\r\n				</div>\r\n\r\n\r\n\r\n\r\n\r\n				<div class="aanmelden_blok">\r\n					<h3>Factuuradres aanvrager</h3>\r\n					<input type="checkbox" name="aanmeldfactuurels" value="1" class="checkbox" id="aanmelden_factuuradres" /> Factuuradres wijkt af van bovenstaande adresgegevens<br />\r\n					<div class="left" id="aanmelden_factuuradres_afwijk" style="display:none;">\r\n						<table cellpadding="0" cellspacing="0">\r\n							<tr>\r\n								<td style="width:141px;">Adres + Huisnummer:</td>\r\n								<td><input type="text" name="aanmeldfactuurelsadres" value="" style="width:174px;" /> <input type="text" name="aanmeldfactuurelshuisnr" value="" style="width:28px;" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Postcode:</td>\r\n								<td><input type="text" name="aanmeldfactuurelspostc" value="" /></td>\r\n							</tr>\r\n							<tr>\r\n								<td>Woonplaats:</td>\r\n								<td><input type="text" name="aanmeldfactuurelsplaats" value="" /></td>\r\n							</tr>\r\n						</table>\r\n					</div>\r\n					<div style="clear:both;"></div>\r\n				</div>\r\n				<script language="javascript" type="text/javascript">\r\n				$("#aanmelden_factuuradres").click(function()\r\n					{\r\n					if($(this).is(":checked"))\r\n						{\r\n						$("#aanmelden_factuuradres_afwijk").slideDown("slow");\r\n						}\r\n					else\r\n						{\r\n						$("#aanmelden_factuuradres_afwijk").slideUp("slow");\r\n						}\r\n					});\r\n				</script>\r\n\r\n\r\n\r\n\r\n<div class="aanmelden_blok">\r\n<h3>Welke van onze oplossingen wilt u aanvragen?</h3>\r\n<input style="width:20px;" type="checkbox" name="voip" value="voip"><span >VoIP telefonie</span><br />\r\n<input style="width:20px;" type="checkbox" name="internet" value="internet"><span >Internet</span><br />\r\n<input style="width:20px;" type="checkbox" name="pin" value="pin"><span >Pin over IP</span><br />\r\n<input style="width:20px;" type="checkbox" name="alarm" value="alarm"><span >Alarm over IP</span><br />\r\n</div>\r\n				\r\n<div class="aanmelden_blok">\r\n					Hierna te noemen “Gebruiker”, bevestigt dat de Algemene Voorwaarden van Service ICT, het Incassoformulier, het Bestelformulier xDSL onverbrekelijk en integraal deel uitmaken van deze overeenkomst. Service-ICT, leverancier van xDSL onder de naam Call Profit, en Gebruiker verklaren deze overeenkomst geldig en bindend met ingang van datum van ondertekening. Aan het eind van het stappenplan kunt u akkoord gaan met de voorwaarden en het formulier digitaal versturen<br /><br />\r\n					<h3>Hoe heeft u van ons gehoord?</h3>\r\n					<table cellpadding="0" cellspacing="0">\r\n						<tr>\r\n							<td style="width:141px;">Maak uw keus:</td>\r\n							<td>\r\n								<select name="aanmeldgehvankeus">\r\n									<option value="Via een kennis1">Via een kennis1</option>\r\n									<option value="Via een kennis2">Via een kennis2</option>\r\n									<option value="Via een kennis3">Via een kennis3</option>\r\n									<option value="Via een kennis4">Via een kennis4</option>\r\n									<option value="Anders namelijk:">Anders namelijk:</option>\r\n								</select>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>Anders, nl.</td>\r\n							<td><input type="text" name="aanmeldgehvananders" /></td>\r\n						</tr>\r\n					</table>\r\n				</div>\r\n<input type="submit" name="submit" value="submit">'),
(2, 'Betalingsgegevens', ''),
(3, 'VoIP gegevens', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wp_cformsettings`
--

CREATE TABLE IF NOT EXISTS `wp_cformsettings` (
`id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `sccsmsg` varchar(255) NOT NULL,
  `navtabs` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `wp_cformsettings`
--

INSERT INTO `wp_cformsettings` (`id`, `mail`, `sccsmsg`, `navtabs`) VALUES
(1, 'info@dakel.eu', 'Email is verzonden', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `wp_cforms`
--
ALTER TABLE `wp_cforms`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `wp_cformsettings`
--
ALTER TABLE `wp_cformsettings`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `wp_cforms`
--
ALTER TABLE `wp_cforms`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `wp_cformsettings`
--
ALTER TABLE `wp_cformsettings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

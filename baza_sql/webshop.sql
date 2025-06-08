-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2025 at 10:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admini`
--

CREATE TABLE `admini` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `pass_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `admini`
--

INSERT INTO `admini` (`id`, `username`, `pass_hash`) VALUES
(1, 'admin', '$2y$10$EENrbOhnrwiW3NnT47spDuFiehg675F9K3VmIHQWiDnxdnL4.Hesq');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(2, 'Knjige'),
(3, 'Mobiteli'),
(4, 'Televizori'),
(5, 'E-mobility'),
(6, 'Sniženo');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `pass_hash` varchar(255) NOT NULL,
  `ime` varchar(100) DEFAULT NULL,
  `telefon` varchar(30) DEFAULT NULL,
  `ulica` varchar(150) DEFAULT NULL,
  `postanski_broj` varchar(20) DEFAULT NULL,
  `grad` varchar(100) DEFAULT NULL,
  `drzava` varchar(100) DEFAULT NULL,
  `Dan_Uclanjenja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `email`, `pass_hash`, `ime`, `telefon`, `ulica`, `postanski_broj`, `grad`, `drzava`, `Dan_Uclanjenja`) VALUES
(2, 'luka', 'lukamrzipaulu@gmail.com', '$2y$10$.L/aOw6zJy75JdKarn0CHe2IsAMpKf00FXn5eZiPpIstAUl4Dgnr6', 'Luka Bošnjak', '0949545897', 'Ulica Josipa Jelačića 98', '10430', 'Samobor', 'Hrvatska', '2025-06-06 10:56:53'),
(6, 'Paula', 'paula@gmai.com', '$2y$10$8VJ.Ozhc51sd3Yn7nDv4CObPinxP8RneO1XP/wBfLLPSMXLsa2ESi', 'Paula Šoštarić', '0979545897', 'Ulica Ljudevita Gaja 44', '10430', 'Samobor', 'Hrvatska', '2025-06-08 19:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbe`
--

CREATE TABLE `narudzbe` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `narudzbe`
--

INSERT INTO `narudzbe` (`id`, `korisnik_id`, `status`, `created_at`) VALUES
(1, 5, 2, '2025-06-07 11:53:13'),
(2, 2, 2, '2025-06-08 19:39:57'),
(3, 2, 2, '2025-06-08 19:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `idKategorija` int(11) DEFAULT NULL,
  `naziv` varchar(150) NOT NULL,
  `opis` text DEFAULT NULL,
  `cijena` decimal(10,2) DEFAULT NULL,
  `dostupnost` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `idKategorija`, `naziv`, `opis`, `cijena`, `dostupnost`) VALUES
(7, 2, 'Čuvari', 'Fantastični strip, Napisan od strane Alana Moore i Dave Gibbons, Prevedeni na hrvatski jezik od strane Fibre, 464 stranica.', 40.00, 10),
(9, 2, 'Knight of the Seven Kingdoms', 'A KNIGHT OF THE SEVEN KINGDOMS compiles the first three official prequel novellas to George R.R. Martin’s ongoing masterwork, A SONG OF ICE AND FIRE, 368 stranica, GODINA IZDANJA 2025.', 18.00, 10),
(10, 2, 'Posljednja zelja', 'Posljednja želja prva knjiga u serijalu The Witcher, Broj stranica: 316, meki uvez.', 15.00, 10),
(11, 2, 'Čudovište iz močvare KOMPLET', 'Evo zašto je Alan Moore, iako Britanac, najbitnija ličnost suvremenog američkog stripa u sveščićima: do njega su scenaristi (pa i oni koji su stvorili najveće stripovske ikone) bili samo najamna i zamjenjiva radna snaga. Nakon njega su postali gotovo pa rock-zvijezde, kompletni serijal sa tvrdim uvezom, Godina objavljanja krenula je 2013 sa prvom knjigom i završila 2017 sa šetom knjigom', 200.00, 10),
(12, 2, 'Batman Sud sova', 'Nakon što niz brutalnih ubojstava potrese Gotham City, Batman počinje shvaćati da bi ti zločini mogli imati dublje korijene nego što se na prvi pogled čini. Kako Maskirani zaštitnik raspetljava taj smrtonosni misterij, otkriva zavjeru koja seže sve do njegove mladosti, i dalje, do postanka grada koji se zakleo štititi. Je li moguće da Sud sova, koji se nekoć smatrao pukom urbanom legendom, stoji iza zločina i korupcije? Ili Bruce Wayne gubi razum i popušta pod pritiskom svojega rata protiv zločina? Broj stranica 360, tvrdi uvez.', 30.00, 10),
(13, 5, 'HIMO Z20 MAX Folding Electric Bike', 'Prometljiv, svestran i elegantan - HIMO Z20 MAX-ov namjerni kompaktni dizajn omogućuje jednostavno preklapanje, skladištenje i transportnost. Inovativna ugrađena baterijska kutija Z20 MAX-a usko je povezana s tijelom za svemirsku učinkovitost, dok njegov lagani aluminijski okvir savršeno odgovara njegovim unutarnjim ožicima kako bi stvorio elegantan izgled. Ne želite ostaviti bateriju na biciklu? Bez brige, Z20 MAX dolazi s namjenskim ključem za bateriju, tako da ga punite gdje god želite!', 779.00, 10),
(14, 5, 'HIMO C26 MAX Commuter Electric Road Bike', 'HIMO C26 MAX je dalekometni električni bicikl s dometom do 100km i dva načina vožnje kako bi odgovarao različitim scenarijima. Kada vježbate, možete uključiti način rada mehaničke vježbe i pedalu za sagorijevanje kalorija. Kada putujete na posao vožnje na posao vožnje, putovanje je brže!', 1000.00, 10),
(15, 5, 'Električni romobil Acer ES Series 5 Advance', 'Podignite svoje iskustvo mobilnosti s najmodernijim prijevoznim sredstvom u gradu. Mase svega 18.5 kg, Acer ES serije 5 dizajniran je za jednostavno probijanje kroz suvremena urbana okruženja. Intuitivna aplikacija olakšava upravljanje. Zahvaljujući jednostavnom preklapanju i ugodnoj vožnji, ovo je novi prvak urbanih putovanja.', 450.00, 10),
(16, 3, 'Mobitel Samsung Galaxy S25 5G 12/256GB ledeno plavi SM-S931B', 'Proizvođač 	Samsung Kratki opis 	6,2\" Dynamic LTPO AMOLED 2x, 120Hz, HDR10+, Snapdragon 8 Elite, 12GB RAM, 256GB ROM, 50 MP, f/1.8, wide, 4000 mAh Maksimalni broj rata 	36 Boja 	Plava Kapacitet baterije (mAh) 	4000 NFC 	Ima Tip ekrana 	Dynamic AMOLED 2x Interna memorija 	256 GB Brzo punjenje 	Ima Prednja kamera 	12MP F2.2, FOV 80° Stražnja kamera 	50 MP OIS F1.8, FOV 85°??? Format ekrana 	19.5 : 9 Masa (gr) 	162.00 Specifikacija ekrana 	Dynamic AMOLED 2X Broj jezgri procesora 	8 Visina (mm) 	146.90 Širina (mm) 	70.50 Dubina (mm) 	7.20 Bežično punjenje 	Ima Vrsta OS-a 	Android 15 RAM (GB) 	12 GB SIM podrška 	Dual SIM Operativni sustav 	Android Proširiva memorija 	Nije podržano Kućište 	Metalno Oštrina ekrana (ppi) 	416 Jamstvo 	2 Godine', 1000.00, 10),
(17, 3, 'Mobitel Apple iPhone 16, 128GB, Black', 'iPhone 16 je izgrađen za Apple Intelligence, osobni obavještajni sustav koji vam pomaže da napišete, izražavate se i učinite stvari bez napora. S revolucionarnom zaštitom privatnosti, daje vam mir da nitko drugi ne može pristupiti vašim podacima, čak ni Appleu, ali svaka normalna osoba ne bi kupila iphone.', 900.00, 10),
(18, 3, 'Mobitel Xiaomi 15 Ultra, 6.73\" 120Hz, 16GB RAM, 512GB Memorija, 5G, Silver Chrome', 'Simetrična estetika Nastavak s vrhunskim dizajnom inspiriranim kamerom i retro kinematografskom estetikom. Potpuno novi dizajn bez luka na gornjem okviru, kao i omotani četverokutni okvir dodatno poboljšavaju njegovu pouzdanost i osjećaj u ruci. Poštujući klasike s inovacijama.  Xiaomi Čuvar Struktura Xiaomi 15 Ultra ima sljedeću generaciju Xiaomi Guardian Structure, izrađenu s izvrsnim detaljima, poput novog oblika visokog čvrstog aluminijskog okvira, Corning Gorilla Glass 7i zaštićene maske i izdržljivog leđa, što korisnicima daje ohrabrujući doživljaj.  Ultra stabilizacija slike Glavna kamera Xiaomi 15 Ultra ima 4-osnu OIS I Ulaz višeg formata EIS za poboljšanu stabilizaciju. Nudi poboljšano snimanje, s respiratornom i fokusnom kompenzacijom disanja za glatko zumiranje i stabilnu kvalitetu slike.  Profesionalna izvedba boja Xiaomi 15 Ultra ima zapanjujući All Around Liquid Display, pružajući izvanredno iskustvo prianjanja i iznimno vizualno iskustvo.', 1300.00, 10),
(19, 3, 'Mobitel Poco F7 Ultra, 6.67\" 120Hz, 16GB RAM, 512GB Memorija, 5G, Crna', 'Ultra-čvrstija grafika s visokom energetskom učinkovitošću Prvi namjenski grafički grafički prijenosnik, izgrađen na naprednom procesu proizvodnje od 12nm, pruža ultra jasnu grafiku, visoke brzine kadrova i dinamične vizuale u igrama i videozapisima.  3D Dvokanalni IceLoop sustav Prvi 3D dvokanalni IceLoop sustav POCO-a povećava kontakt između toplinske cijevi i SoC-a, smanjujući temperaturu SoC-a do 3 °C. Dizajn s dualnim kanalima pruža namjensku toplinsku petlju za SoC i kameru, što značajno poboljšava učinkovitost rasipanja topline.  Masivna baterija od 5300mAh (tip za tip) Kompaktno tijelo skriva super-veliku bateriju od 5300 mAh koja pruža nevjerojatnu snagu i izdržljivost za dnevnu uporabu bez tjeskobe.', 750.00, 10),
(20, 4, 'SAMSUNG QE50Q60DAUXXH qled, 125cm, 4k hdr, smart tv', 'QLED TV je televizor koji se temelji na kvantnim točkama, i taj materijal kvantnih točaka je ono po čemu se QLED-televizori razlikuju od onih konvencionalnih. To znači da zaslon takvog TV-a u sebi sadrži 3840 vodoravnih piksela ili točaka i 2160 okomitih piksela, što ukupno donosi 8,3 milijuna piksela.Jeste li primijetili da današnji TV sadržaj izgleda drukčije u usporedbi s onim u prošlosti? Doznajte više o HDR-u.', 400.00, 10),
(21, 4, 'LG 55QNED80T3A.AEU qned, 139cm, 4k hdr, magic, smart', 'LG QNED Televizori  Quantum Dot susreće tehnologiju NanoCell. Iskusite izvanserijsku boju uz QNED Color koju su omogućili tehnologije Quantum Dot i NanoCell. LG Magic Remote  Uzmite jedini daljinski upravljač koji vam treba. LG Magic Remote djeluje kao univerzalni daljinski upravljač s automatskim otkrivanjem većine uređaja. LG SMART TV - Novi centar vašeg pametnog doma.  Uživajte u pametnijem, osobnijem iskustvu s tehnologijom ThinQ AI i novom početnom stranicom na LG televizorima usredotočenim na sadržaj. LG webOS  U kombinaciji sa Magic Remote daljinskim upravljačem najnovija verzija hvaljene TV platforme gledateljima nudi ugodnije i intuitivnije iskustvo.', 500.00, 10),
(22, 4, 'SAMSUNG QE55Q80DATXXH qled,138cm,4k hdr,hdmi 2.1,atmos', 'Zašto QLED?  QLED odražava stvarnost. Stopostotni volumen boja s Quantum Dot tehnologijom koji omogućava prikaz sadražja točno onako kako ga je redatelj zamislio. Direct Full Array 8X/12X  Doživite snažan kontrast sa svim detaljima u najtamnijim i najsvjetlijim scenama kroz pozadinsko osvjetljenje Direct Full Array. Q-Symphony  Impresivna kvaliteta zvuka. Q Soundbar se sinkronizira s Vašim Samsung televizorom te zajedno stvaraju zadivljujući zvuk. Quantum 4K procesor  Doživite Quantum 4K procesor QLED televizora. Inteligencija poboljšava rad i prilagođuje gledanje uvjetima i sadržaju u realnom vremenu.', 700.00, 10),
(23, 4, 'LG 43NANO82T3B.AEU nanocell tv, 108cm, 4k hdr, webos', '4K Rezolucija  4K TV je televizor sa 4K rezolucijom što znači da televizor ima 3.840 horizontalnih piksela i 2.160 vertikalnih piksela, što je ukupno oko 8,3 milijuna piksela. LG NanoCell  Pogledajte slike kakve nikada ranije niste vidjeli pomoću NanoCell televizora koji kombinira oštre i živopisne boje kako bi vam pružio novi nivo zabave. a5 AI Processor 4K  Procesor uklanja videosmetnje i stvara življe boje i kontrast. Slike niske razlučivosti unaprjeđuju se u kvalitetu koja je gotovo ista kao 4K.  LG webOS 6.0  U kombinaciji sa Magic Remote daljinskim upravljačem najnovija verzija hvaljene TV platforme gledateljima nudi ugodnije i intuitivnije iskustvo.', 280.00, 10),
(24, 6, 'Nala(pas)', 'Jako Jako dobar pesek, Ženko, Stara 5 godina?, Odlična u javnosti, totalno nema puno energije i totalno voli sve druge pese', 0.00, 10),
(25, 6, 'Živi mrtvaci OMNIBUS 1 i 2', 'Omnibus Zivi Mrtvaci prvi i drugi dio na popustu, zbog oštečenja na kutu knjige, knjige su tvrdog uveza pa nije očito, šteta pokrivena crnim markerom, osim toga u odličnom stanju. Jednom pročitano.', 60.00, 10),
(26, 6, 'Punisher Fibra Komplet', 'Punisher izdavatelj FIbra Komplet za 100 eura, Razlog niske cijene je oštećenje na 3 knjige, vidljive su lagane ogrebotine i posjekotine, osim toga odlično stanje.', 100.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `recenzije`
--

CREATE TABLE `recenzije` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) DEFAULT NULL,
  `tekst` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `recenzije`
--

INSERT INTO `recenzije` (`id`, `korisnik_id`, `tekst`, `created_at`, `rating`) VALUES
(1, 2, '5/5 Kupovao bi tu opet', '2025-06-08 19:07:00', NULL),
(2, 6, '5/5 Kupila bi tu svaki dan', '2025-06-08 19:08:01', NULL),
(3, NULL, 'Lol luzeri', '2025-06-08 19:08:16', NULL),
(4, 6, 'Super', '2025-06-08 19:15:28', 1),
(5, 6, 'Odlicno', '2025-06-08 19:15:34', 5),
(6, 6, 'nula', '2025-06-08 19:15:39', 0),
(7, 6, '1', '2025-06-08 19:22:59', 4),
(8, 6, '1', '2025-06-08 19:23:02', 4),
(9, 6, '5', '2025-06-08 19:23:06', 5),
(10, 6, '1', '2025-06-08 19:23:08', 0),
(11, 6, '1', '2025-06-08 19:23:10', 1),
(12, 6, '0', '2025-06-08 19:23:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slike_proizvoda`
--

CREATE TABLE `slike_proizvoda` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `slike_proizvoda`
--

INSERT INTO `slike_proizvoda` (`id`, `product_id`, `file_path`, `alt_text`, `sort`) VALUES
(7, 7, 'slike/proizvodi/img_6845ccf39f4825.88041599.jpg', 'Čuvari', 1),
(8, 9, 'slike/proizvodi/img_6845ce6be28068.86348719.jpg', 'Knight of the Seven Kingdoms', 1),
(9, 10, 'slike/proizvodi/img_6845cec88807d1.80080394.png', 'Posljednja zelja', 1),
(10, 11, 'slike/proizvodi/img_6845cf6d06cb50.63552833.jpg', 'Čudovište iz močvare KOMPLET', 1),
(11, 12, 'slike/proizvodi/img_6845cfb457ec34.83310383.jpg', 'Batman Sud sova', 1),
(12, 13, 'slike/proizvodi/img_6845d028b12453.14353478.jpg', 'HIMO Z20 MAX Folding Electric Bike', 1),
(13, 14, 'slike/proizvodi/img_6845d063caa014.70247765.jpg', 'HIMO C26 MAX Commuter Electric Road Bike', 1),
(14, 15, 'slike/proizvodi/img_6845d0a5a71670.69611659.jpg', 'Električni romobil Acer ES Series 5 Advance', 1),
(15, 16, 'slike/proizvodi/img_6845d11dc17cc5.89826106.jpg', 'Mobitel Samsung Galaxy S25 5G 12/256GB ledeno plavi SM-S931B', 1),
(16, 17, 'slike/proizvodi/img_6845d1958d85b7.84631784.jpg', 'Mobitel Apple iPhone 16, 128GB, Black', 1),
(17, 18, 'slike/proizvodi/img_6845d1fa8ad953.94641592.jpg', 'Mobitel Xiaomi 15 Ultra, 6.73\" 120Hz, 16GB RAM, 512GB Memorija, 5G, Silver Chrome', 1),
(18, 19, 'slike/proizvodi/img_6845d23eb7d071.58151293.jpg', 'Mobitel Poco F7 Ultra, 6.67\" 120Hz, 16GB RAM, 512GB Memorija, 5G, Crna', 1),
(19, 20, 'slike/proizvodi/img_6845d2b78b8698.20402999.jpg', 'SAMSUNG QE50Q60DAUXXH qled, 125cm, 4k hdr, smart tv', 1),
(20, 21, 'slike/proizvodi/img_6845d2f70caac7.90971929.jpg', 'LG 55QNED80T3A.AEU qned, 139cm, 4k hdr, magic, smart', 1),
(21, 22, 'slike/proizvodi/img_6845d33f7d99d3.27355110.jpg', 'SAMSUNG QE55Q80DATXXH qled,138cm,4k hdr,hdmi 2.1,atmos', 1),
(22, 23, 'slike/proizvodi/img_6845d380806820.34068273.jpg', 'LG 43NANO82T3B.AEU nanocell tv, 108cm, 4k hdr, webos', 1),
(23, 24, 'slike/proizvodi/img_6845d3e0be9484.76382949.jpg', 'Nala(pas)', 1),
(24, 25, 'slike/proizvodi/img_6845d48eca8538.30872514.jpg', 'Živi mrtvaci OMNIBUS 1 i 2', 1),
(25, 26, 'slike/proizvodi/img_6845d532697f01.10824394.jpg', 'Punisher Fibra Komplet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stavke_narudzbe`
--

CREATE TABLE `stavke_narudzbe` (
  `id` int(11) NOT NULL,
  `narudzba_id` int(11) DEFAULT NULL,
  `proizvod_id` int(11) DEFAULT NULL,
  `kolicina` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `stavke_narudzbe`
--

INSERT INTO `stavke_narudzbe` (`id`, `narudzba_id`, `proizvod_id`, `kolicina`) VALUES
(1, 1, 1, 1),
(2, 1, 3, 1),
(3, 2, 14, 1),
(4, 2, 24, 1),
(5, 3, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `korisnik_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`korisnik_id`, `proizvod_id`) VALUES
(5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narudzbe`
--
ALTER TABLE `narudzbe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recenzije`
--
ALTER TABLE `recenzije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `slike_proizvoda`
--
ALTER TABLE `slike_proizvoda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stavke_narudzbe`
--
ALTER TABLE `stavke_narudzbe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`korisnik_id`,`proizvod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admini`
--
ALTER TABLE `admini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `narudzbe`
--
ALTER TABLE `narudzbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `recenzije`
--
ALTER TABLE `recenzije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `slike_proizvoda`
--
ALTER TABLE `slike_proizvoda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stavke_narudzbe`
--
ALTER TABLE `stavke_narudzbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recenzije`
--
ALTER TABLE `recenzije`
  ADD CONSTRAINT `recenzije_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

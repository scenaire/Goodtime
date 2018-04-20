-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2018 at 05:53 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goodtime`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `Status` varchar(20) CHARACTER SET utf8 NOT NULL,
  `username` varchar(20) NOT NULL,
  `trxID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(12) NOT NULL,
  `ProductName` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `ProductPrice` float NOT NULL,
  `ProductCategoryID` int(11) NOT NULL,
  `ProductStock` int(11) NOT NULL,
  `ProductDecs` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductPrice`, `ProductCategoryID`, `ProductStock`, `ProductDecs`) VALUES
(1, 'Nendoroid Sogo Osaka', 1430, 2, 20, 'Pre-painted Posable Figure<br>Size: Approx. H100mm (non-scale)<br>Material: ABS & PVC<br><br>[Set Contents]<br>Main figure<br>-Base<br><br>\r\nFrom the smartphone game IDOLiSH7 comes a Nendoroid of the considerate young idol, Sogo Osaka! He comes with three face plates including a cool and composed standard face, a smiling face with a bit of a dangerous air as well as a smiling face with closed eyes.\r\nOptional parts include a bottle of tabasco sauce as well as his screwdriver allowing you to enjoy some scenes that show various different sides of his character! Nendoroid Tamaki Yotsuba is also going up for preorder soon, so be sure to display the two of them together!'),
(3, 'Nendoroid Saitama', 1200, 2, 20, 'Pre-painted Posable Figure<br>Size: Approx. H100mm (non-scale)<br>Material: ABS & PVC<br><br>[Set Contents]<br>Main figure<br>-Base<br><br>\r\nThe hero who spent three years training to obtain his power, which now allows him to defeat even the strongest of enemies with a single punch!! Saitama is joining the Nendoroids! <br>\r\nThe rounded form of his head and completely not strong looking appearance has been faithfully shrunk down into Nendoroid size!'),
(4, 'Nendoroid Midoriya', 1690, 2, 20, 'Pre-painted Posable Figure<br>Size: Approx. H100mm (non-scale)<br>Material: ABS & PVC<br><br>[Set Contents]<br>Main figure<br>-Base<br><br>\r\nFrom the popular anime series My Hero Academia comes a fully articulated Nendoroid of the main character who dreams he will become a hero - Izuku Midoriya! He comes with three different face plates including a standard gentle expression, a hesitant crying expression as well as a combat expression for when he decides it is time to be a hero!<br>\r\nHis unique green jumpsuit has been faithfully shrunk down into Nendoroid size and he also comes with special glove parts to pose him using his One For All Quirk. A SMASH sound effect plate is also included to bring even more life to his action poses! Recreate your favorite scenes from the series!'),
(5, 'Nendoroid Geralt', 1400, 2, 20, '<strong>Geralt of Rivia is joining the Nendoroids!</strong><br><br>\r\nFrom the globally acclaimed open world RPG \"The Witcher 3: Wild Hunt\" comes a Nendoroid of the White Wolf, Geralt of Rivia! The Nendoroid is fully articulated allowing you to easily pose him in combat scenes, and he comes with both his steel and silver swords which can both be equipped to suit the situation! A hand of Gwent cards is also included to display him enjoying a round of the mini-game from the series!<br><br>\r\n\r\nAlong with his standard serious face plate, he also comes with an interchangeable face plate that captures the veins along his face when he overdoses on decoctions and potions! In addition, the iconic bathing scene at the start of the game can also be recreated with the included bath parts! Recreate all sorts of scenes from the world of the Witcher in adorable Nendoroid size!'),
(6, 'Nendoroid Kashu Kiyomitsu', 1400, 2, 20, '<strong>\"What? Are you enjoying patting me?\"</strong><br><br>\r\nFrom the popular browser and smartphone game \"Touken Ranbu -ONLINE-\" comes a rerelease of the sword that is difficult to handle but stands above the rest - Nendoroid Kashu Kiyomitsu! He comes with three expressions including his charming standard face, a fearless combat expression as well as a yawning expression based on his lines from the game.<br><br>\r\n\r\nHis sword is included and can be displayed both sheathed and drawn, and he also comes with a Sennin Dango - the item that remedies fatigue in the game. Be sure to add him to your collection!'),
(7, 'Hoomeda DIY Wood Dollhouse Miniature Piano Doll house', 600, 1, 10, '<strong>Features:</strong><br>\r\n1) Safe and non-toxic;<br>\r\n2) Pretty and interesting;<br>\r\n3) Different realistic designs & vivid color<br>\r\n4) Stimulates children\'s brain development by series of playing<br>\r\n5) Developing the thinking skill and logic sense of children<br><br>\r\n\r\n<strong>Specification:</strong><br>\r\nModel: M011 Hemiola\'s Room<br>\r\nBox size:18×8×15 cm<br>\r\nFull Assembled: 14.5×11.5×10.5 cm<br>\r\nMaterial: Wooden,frame,Cardboard Paper,Wood,Fabric,PVC<br>\r\nRecommended Age: 14 years old+<br><br>\r\n\r\n<strong>Note:</strong><br>\r\n1, Instruction(Follow the instruction step by step,It\'s easy to finish,Just need enough patience)<br>\r\n2, Choking hazard_small parts. Not for children under 6 years.<br>\r\n3, This item is a DIY product, what you get will be just kits and accessories! It means that Almost all parts are waiting to be assembled.<br>\r\n4, Need Scissor, Tweezers, Pincer or Sandpaper sometimes to support<br><br>\r\n\r\n<strong>Package Included:</strong><br>\r\n1 × DIY Doll House Kits<br>\r\nAll accessories show in pictures (furniture & foods & light & dust cover & manual)<br>'),
(8, 'Pop! Animation: Naruto - Naruto', 950, 3, 15, ''),
(9, 'Pop! Disney: Winnie the Pooh - Eeyore ', 850, 3, 10, ''),
(10, 'Pop! Heroes: Superman', 750, 3, 5, ''),
(11, 'Nendoroid Sagiri Izumi', 1400, 2, 15, '<strong>\"Big Brother, you idiot! Light novel protagonist!\"</strong><br><br>\r\nFrom the popular anime series \'Eromanga Sensei\' comes a Nendoroid of Sagiri Izumi dressed in the hoodie she wears when live-streaming. She comes with three face plates including a cute smile, an embarrassed, upset expression for when she feels helpless toward her stepbrother as well as a shouting expression to have her shouting at Izumi.<br><br>\r\n\r\nOptional accessories include a drawing tablet for her to complete her illustrations as Eromanga Sensei, a pile of manuscript paper as well as the mask and headset she uses while live-streaming. Recreate your favorite scenes from the series in Nendoroid size!'),
(12, 'Nendoroid Yuri Plisetsky: Casual Ver.', 1400, 2, 12, '<strong>\"If you retire now I\'ll make you regret it for life. Idiot.\"</strong><br><br>\r\n\r\nFrom the popular anime series \"YURI!!! on ICE\" comes a Nendoroid of the \"Russian Fairy\", Yuri Plisetsky wearing a casual outfit! He comes with two face plates including a standard sullen expression as well as the smiling face when he gave Yuri his Katsudon Pirozhki.<br><br>\r\n\r\nOptional parts include his smartphone as well as his beloved cat Potya, he also comes with an alternate lower body part to display him with his leg up in the air in a dropkick pose in order to capture the more delinquent side of his personality! Be sure to display him together with his rival Yuri Katsuki and enjoy all sorts of different situations in Nendoroid size!'),
(13, 'Nendoroid Mikasa Ackerman', 1690, 2, 6, '<strong>\"If we don\'t fight, we can\'t win.\"</strong><br><br>\r\nFrom the anime series \'Attack on Titan\' comes a Nendoroid of Mikasa Ackerman! She comes with three expressions including her standard expression, a shouting expression and a stunned expression. The Nendoroid also includes her Vertical Maneuvering Equipment and dual blades, as well as effect parts to display her soaring through the air with the equipment.<br><br>\r\n\r\nYou can even pose her as if she were striking down into a Titan\'s neck by making use of the included blood effect parts which attach to her blades. The scarf that Eren gave her is also included to create even more scenes from the series.'),
(14, 'Nendoroid Iroha Tamaki', 1790, 2, 8, '<strong>\"Hold on, Ui. Your big sister will find you.\"</strong><br><br>\r\nFrom Puella Magi Madoka Magica Side Story: Magia Record comes a Nendoroid of Iroha Tamaki, the character in search of her younger sister Ui, who disappeared in Kamihama city.<br><br>\r\n\r\nShe comes with three different face plates including her standard expression, a confident combat expression as well as a worried expression. Optional parts include her crossbow together with special effect parts to display her firing it, as well as a little Kyubey figure. Recreate all sorts of situations in Nendoroid size!'),
(15, 'Pop! Movies: Ready Player One - Perzival', 690, 3, 15, '<strong>Product Features</strong><br>\r\n• 3.75 inches (9.5cm)<br>\r\n• Made of vinyl<br>\r\n• Urban stylized design<br>\r\n• Based on the Ready Player One movie<br>\r\n• Comes in window-box packaging<br><br>\r\n\r\nFrom Ready Player One comes this series of Pop! Featuring Parzival, Aech, Art3mis, Daito, and Sho as they race to be first to the Easter Egg. Also collect Sorrento, an IOI employee Sixer, and i-R0k as he attempts to blackmail Parzival and Aech on their quest to find the keys!<br><br>\r\n\r\nPop! figures bring your favorite Ready Player One characters to life with a unique stylized design. Each vinyl figure stands 3.75 inches tall and comes in window box packaging, making them great for display!'),
(16, 'Pop! Movies: IT Pennywise', 690, 3, 6, '<strong>Product Features</strong><br>\r\n• 3.75 inches (9.5cm)<br>\r\n• Made of vinyl<br>\r\n• From the movie IT<br>\r\n• Featuring Pennywise as a non-articulated figure<br>\r\n• Comes in window-box packaging<br><br>\r\nOne of the most terrifying clowns is recreated in its vinyl format! It Pennywise Vinyl! Pop Figure is a great addition to your horror movie collection.'),
(17, 'Miniature Dollhouse With Furnitures Wooden House Toys', 1800, 1, 4, '<strong>Description:</strong><br>\r\nItem Type: Dollhouses<br>\r\nGender: Unisex<br>\r\nAge Range: 12-15 Years,8-11 Years,Grownups<br>\r\nColor: Multicolor<br>\r\nWarning: not suit for 3 years old<br>\r\nBrand Name: CUTEBEE<br>\r\nDimensions: 33.5*22.5*27.5cm<br>\r\nMaterial: Wood<br>\r\nModel Number: doll house'),
(18, 'Greenhouse DIY Dollhouse Wooden Doll Houses', 1500, 1, 3, '<strong>Description:</strong><br>\r\nItem Type: Dollhouses<br>\r\nWarning: no fire<br>\r\nGender: Unisex<br>\r\nAge Range: 12-15 Years,8-11 Years,Grownups<br>\r\nColor: Multicolor<br>\r\nDimensions: 35*22*22cm<br>\r\nBrand Name: CUTEBEE<br>\r\nMaterial: Wood<br>\r\nModel Number: doll house<br>\r\ntype: Assembled<br>\r\nneed time: 0.5-1 days<br>\r\nSuitable for the crowd: child /lover/friend<br><br>\r\n\r\n<strong>You will get:</strong><br>\r\n1.LED light<br>\r\n2.All furnitures the same as picture shown! Doll house assembly parts will be shipped,and you need to assemble them together in following English instruction!<br><br>\r\n\r\n<strong>Size:</strong><br>\r\n1.Scale: 1:24<br>\r\n2.Dollhouse Size:35(L) x22(W)x22(H) cm<br>\r\n3.Net Weight:1.5 kg<br>\r\nMaterial: wood, fabric, paper, plastic,matel<br>\r\nManual: English instruction<br><br>\r\n\r\n<strong>Note:</strong><br>\r\n1.Age:apply above 10 years old<br>\r\n2.dust cover/glue/tools/battery not include in parcel<br>\r\n3.handcraft tools needed: paper scissors, knife,hole maker,precision tweezers,screw driver , adhesive'),
(19, 'Valencia Coast with Light/Anti-dust cover', 2800, 1, 6, '<strong>Product Description:</strong><br>\r\n\r\nLuxury Valencia Coast Villa DIY Cottage, beautiful style and cool light.<br> \r\nYou need to complete the assembly by yourself, the production process is more interesting, and there is a sense <br>\r\nof accomplishment after completion <br>\r\nThe finished size is about 35.5 * 29 * 39 cm / 13.98 * 11.42 * 15.35\'\' <br>\r\nWith LED lights, better effects at night. <br>\r\nWith music movements. ');

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE `productcategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Miniature House'),
(2, 'Nendoroid'),
(3, 'Funko'),
(4, 'Metal 3D model');

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `ProductImageID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`ProductImageID`, `ProductID`, `ProductImage`) VALUES
(1, 1, 'Product_image\\N-Sogo-Osaka1.jpg'),
(2, 1, 'Product_image\\N-Sogo-Osaka2.jpg'),
(3, 1, 'Product_image\\N-Sogo-Osaka3.jpg'),
(4, 1, 'Product_image\\N-Sogo-Osaka4.jpg'),
(5, 1, 'Product_image\\N-Sogo-Osaka5.jpg'),
(6, 3, 'Product_image\\saitama01.jpg'),
(7, 3, 'Product_image\\saitama02.jpg'),
(8, 3, 'Product_image\\saitama03.jpg'),
(9, 3, 'Product_image\\saitama04.jpg'),
(10, 3, 'Product_image\\saitama05.jpg'),
(11, 4, 'Product_image\\Midoriya01.jpg'),
(12, 4, 'Product_image\\Midoriya02.jpg'),
(13, 4, 'Product_image\\Midoriya03.jpg'),
(14, 4, 'Product_image\\Midoriya04.jpg'),
(15, 4, 'Product_image\\Midoriya05.jpg'),
(16, 5, 'Product_image\\Geralt1.jpg'),
(17, 5, 'Product_image\\Geralt2.jpg'),
(18, 5, 'Product_image\\Geralt3.jpg'),
(19, 5, 'Product_image\\Geralt4.jpg'),
(20, 5, 'Product_image\\Geralt5.jpg'),
(21, 6, 'Product_image\\kashu1.jpg'),
(22, 6, 'Product_image\\kashu2.jpg'),
(23, 6, 'Product_image\\kashu3.jpg'),
(24, 6, 'Product_image\\kashu4.jpg'),
(25, 6, 'Product_image\\kashu5.jpg'),
(26, 7, 'Product_image/Room1.jpg'),
(27, 7, 'Product_image/Room2.jpg'),
(28, 7, 'Product_image/Room3.jpg'),
(29, 7, 'Product_image/Room4.jpg'),
(30, 7, 'Product_image/Room5.jpg'),
(31, 8, 'Product_image/10.jpg'),
(36, 9, 'Product_image/11.jpg'),
(37, 10, 'Product_image/7.jpg'),
(38, 11, 'Product_image/Sagiri1.jpg'),
(39, 11, 'Product_image/Sagiri2.jpg'),
(40, 11, 'Product_image/Sagiri3.jpg'),
(41, 11, 'Product_image/Sagiri4.jpg'),
(42, 11, 'Product_image/Sagiri5.jpg'),
(43, 12, 'Product_image/Yuri1.jpg'),
(44, 12, 'Product_image/Yuri2.jpg'),
(45, 12, 'Product_image/Yuri3.jpg'),
(46, 12, 'Product_image/Yuri4.jpg'),
(47, 13, 'Product_image/Mikasa1.jpg'),
(48, 13, 'Product_image/Mikasa2.jpg'),
(49, 13, 'Product_image/mikasa3.jpg'),
(50, 13, 'Product_image/Mikasa4.jpg'),
(51, 13, 'Product_image/Mikasa5.jpg'),
(52, 14, 'Product_image/Iroha1.jpg'),
(53, 14, 'Product_image/Iroha2.jpg'),
(54, 14, 'Product_image/Iroha3.jpg'),
(55, 14, 'Product_image/Iroha4.jpg'),
(56, 14, 'Product_image/Iroha5.jpg'),
(57, 15, 'Product_image/perzivalfunko.png'),
(58, 16, 'Product_image/12.jpg'),
(59, 17, 'Product_image/blue1.jpg'),
(60, 17, 'Product_image/blue2.jpg'),
(61, 17, 'Product_image/blue3.jpg'),
(62, 17, 'Product_image/blue4.jpg'),
(63, 18, 'Product_image/greenhouse1.jpg'),
(64, 18, 'Product_image/greenhouse12.jpg'),
(65, 18, 'Product_image/greenhouse3.jpg'),
(66, 18, 'Product_image/greenhouse4.jpg'),
(67, 19, 'Product_image/valencia1.jpg'),
(68, 19, 'Product_image/valencia2.jpg'),
(69, 19, 'Product_image/valencia3.jpg'),
(70, 19, 'Product_image/valencia4.jpg'),
(71, 19, 'Product_image/valencia5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `CustFName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `CustLName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `CustAddress` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `CustEmail` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CustFName`, `CustLName`, `CustAddress`, `CustEmail`, `username`, `password`) VALUES
('', '', '', '', 'admin', 'admin'),
('จิรัชญา', 'ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000', 'tempesta-psyzeoul@hotmail.com', 'scenaire', 'ttandt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD UNIQUE KEY `ProductName` (`ProductName`),
  ADD KEY `ProductCategoryID` (`ProductCategoryID`);

--
-- Indexes for table `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`ProductImageID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `CustEmail` (`CustEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `ProductImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ProductCategoryID`) REFERENCES `productcategories` (`CategoryID`);

--
-- Constraints for table `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `productimage_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

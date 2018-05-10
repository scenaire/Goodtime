-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2018 at 09:35 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `trxID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `TotalPrice` float NOT NULL,
  `TotalNetPrice` float NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `OrderDate` date NOT NULL,
  `Payment` varchar(50) NOT NULL COMMENT 'จ่ายเงินอย่างไร',
  `PaymentDate` datetime NOT NULL,
  `PromotionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`trxID`, `username`, `TotalPrice`, `TotalNetPrice`, `Status`, `OrderDate`, `Payment`, `PaymentDate`, `PromotionID`) VALUES
(36, 'scenaire', 1500, 1605, 1, '2018-05-11', 'bank', '2018-05-11 00:31:55', NULL),
(37, 'scenaire', 3000, 3210, 1, '2018-05-11', 'bank', '2018-05-11 01:28:57', NULL),
(38, 'scenaire', 4400, 4708, 1, '2018-05-11', 'paypal', '2018-05-11 01:30:23', NULL),
(39, 'scenaire', 1400, 1498, 1, '2018-05-11', 'bank', '2018-05-11 02:17:37', NULL),
(40, 'scenaire', 16090, 16355.5, 1, '2018-05-11', 'credit', '2018-05-11 02:23:52', 2),
(41, 'scenaire', 2140, 2289.8, 1, '2018-05-11', 'credit', '2018-05-11 02:32:02', NULL),
(42, 'scenaire', 950, 1016.5, 0, '2018-05-11', 'paypal', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordersproduct`
--

CREATE TABLE `ordersproduct` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `trxID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordersproduct`
--

INSERT INTO `ordersproduct` (`OrderID`, `ProductID`, `Quantity`, `trxID`) VALUES
(29, 18, 1, 36),
(30, 22, 2, 37),
(31, 35, 2, 38),
(32, 11, 1, 39),
(33, 15, 1, 40),
(34, 19, 1, 40),
(35, 7, 1, 40),
(36, 30, 1, 40),
(37, 7, 1, 41),
(38, 16, 1, 41),
(39, 9, 1, 41),
(40, 8, 1, 42);

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
(6, 'Nendoroid Kashu Kiyomitsu', 1400, 2, 20, '<strong>\"What? Are you enjoying patting me?\"</strong><br><br>\r\nFrom the popular browser and smartphone game \"Touken Ranbu -ONLINE-\" comes a rerelease of the sword that is difficult to handle but stands above the rest - Nendoroid Kashu Kiyomitsu! He comes with three expressions including his charming standard face, a fearless combat expression as well as a yawning expression based on his lines from the game.<br><br>\r\n\r\nHis sword is included and can be displayed both sheathed and drawn, and he also comes with a Sennin Dango - the item that remedies fatigue in the game. Be sure to add him to your collection!'),
(7, 'Hoomeda DIY Wood Dollhouse Miniature Piano Doll house', 600, 1, 8, '<strong>Features:</strong><br>\r\n1) Safe and non-toxic;<br>\r\n2) Pretty and interesting;<br>\r\n3) Different realistic designs & vivid color<br>\r\n4) Stimulates children\'s brain development by series of playing<br>\r\n5) Developing the thinking skill and logic sense of children<br><br>\r\n\r\n<strong>Specification:</strong><br>\r\nModel: M011 Hemiola\'s Room<br>\r\nBox size:18×8×15 cm<br>\r\nFull Assembled: 14.5×11.5×10.5 cm<br>\r\nMaterial: Wooden,frame,Cardboard Paper,Wood,Fabric,PVC<br>\r\nRecommended Age: 14 years old+<br><br>\r\n\r\n<strong>Note:</strong><br>\r\n1, Instruction(Follow the instruction step by step,It\'s easy to finish,Just need enough patience)<br>\r\n2, Choking hazard_small parts. Not for children under 6 years.<br>\r\n3, This item is a DIY product, what you get will be just kits and accessories! It means that Almost all parts are waiting to be assembled.<br>\r\n4, Need Scissor, Tweezers, Pincer or Sandpaper sometimes to support<br><br>\r\n\r\n<strong>Package Included:</strong><br>\r\n1 × DIY Doll House Kits<br>\r\nAll accessories show in pictures (furniture & foods & light & dust cover & manual)<br>'),
(8, 'Pop! Animation: Naruto - Naruto', 950, 3, 14, ''),
(9, 'Pop! Disney: Winnie the Pooh - Eeyore ', 850, 3, 9, ''),
(10, 'Pop! Heroes: Superman', 750, 3, 5, ''),
(11, 'Nendoroid Sagiri Izumi', 1400, 2, 14, '<strong>\"Big Brother, you idiot! Light novel protagonist!\"</strong><br><br>\r\nFrom the popular anime series \'Eromanga Sensei\' comes a Nendoroid of Sagiri Izumi dressed in the hoodie she wears when live-streaming. She comes with three face plates including a cute smile, an embarrassed, upset expression for when she feels helpless toward her stepbrother as well as a shouting expression to have her shouting at Izumi.<br><br>\r\n\r\nOptional accessories include a drawing tablet for her to complete her illustrations as Eromanga Sensei, a pile of manuscript paper as well as the mask and headset she uses while live-streaming. Recreate your favorite scenes from the series in Nendoroid size!'),
(12, 'Nendoroid Yuri Plisetsky: Casual Ver.', 1400, 2, 12, '<strong>\"If you retire now I\'ll make you regret it for life. Idiot.\"</strong><br><br>\r\n\r\nFrom the popular anime series \"YURI!!! on ICE\" comes a Nendoroid of the \"Russian Fairy\", Yuri Plisetsky wearing a casual outfit! He comes with two face plates including a standard sullen expression as well as the smiling face when he gave Yuri his Katsudon Pirozhki.<br><br>\r\n\r\nOptional parts include his smartphone as well as his beloved cat Potya, he also comes with an alternate lower body part to display him with his leg up in the air in a dropkick pose in order to capture the more delinquent side of his personality! Be sure to display him together with his rival Yuri Katsuki and enjoy all sorts of different situations in Nendoroid size!'),
(14, 'Nendoroid Iroha Tamaki', 1790, 2, 8, '<strong>\"Hold on, Ui. Your big sister will find you.\"</strong><br><br>\r\nFrom Puella Magi Madoka Magica Side Story: Magia Record comes a Nendoroid of Iroha Tamaki, the character in search of her younger sister Ui, who disappeared in Kamihama city.<br><br>\r\n\r\nShe comes with three different face plates including her standard expression, a confident combat expression as well as a worried expression. Optional parts include her crossbow together with special effect parts to display her firing it, as well as a little Kyubey figure. Recreate all sorts of situations in Nendoroid size!'),
(15, 'Pop! Movies: Ready Player One - Perzival', 690, 3, 14, '<strong>Product Features</strong><br>\r\n• 3.75 inches (9.5cm)<br>\r\n• Made of vinyl<br>\r\n• Urban stylized design<br>\r\n• Based on the Ready Player One movie<br>\r\n• Comes in window-box packaging<br><br>\r\n\r\nFrom Ready Player One comes this series of Pop! Featuring Parzival, Aech, Art3mis, Daito, and Sho as they race to be first to the Easter Egg. Also collect Sorrento, an IOI employee Sixer, and i-R0k as he attempts to blackmail Parzival and Aech on their quest to find the keys!<br><br>\r\n\r\nPop! figures bring your favorite Ready Player One characters to life with a unique stylized design. Each vinyl figure stands 3.75 inches tall and comes in window box packaging, making them great for display!'),
(16, 'Pop! Movies: IT Pennywise', 690, 3, 5, '<strong>Product Features</strong><br>\r\n• 3.75 inches (9.5cm)<br>\r\n• Made of vinyl<br>\r\n• From the movie IT<br>\r\n• Featuring Pennywise as a non-articulated figure<br>\r\n• Comes in window-box packaging<br><br>\r\nOne of the most terrifying clowns is recreated in its vinyl format! It Pennywise Vinyl! Pop Figure is a great addition to your horror movie collection.'),
(17, 'Miniature Dollhouse With Furnitures Wooden House Toys', 1800, 1, 6, '<p><strong>Description:</strong><br />\r\nItem Type: Dollhouses<br />\r\nGender: Unisex<br />\r\nAge Range: 12-15 Years,8-11 Years,Grownups<br />\r\nColor: Multicolor<br />\r\nWarning: not suit for 3 years old<br />\r\nBrand Name: CUTEBEE<br />\r\nDimensions: 33.5*22.5*27.5cm<br />\r\nMaterial: Wood<br />\r\nModel Number: doll house</p>\r\n'),
(18, 'Greenhouse DIY Dollhouse Wooden Doll Houses', 1500, 1, 2, '<strong>Description:</strong><br>\r\nItem Type: Dollhouses<br>\r\nWarning: no fire<br>\r\nGender: Unisex<br>\r\nAge Range: 12-15 Years,8-11 Years,Grownups<br>\r\nColor: Multicolor<br>\r\nDimensions: 35*22*22cm<br>\r\nBrand Name: CUTEBEE<br>\r\nMaterial: Wood<br>\r\nModel Number: doll house<br>\r\ntype: Assembled<br>\r\nneed time: 0.5-1 days<br>\r\nSuitable for the crowd: child /lover/friend<br><br>\r\n\r\n<strong>You will get:</strong><br>\r\n1.LED light<br>\r\n2.All furnitures the same as picture shown! Doll house assembly parts will be shipped,and you need to assemble them together in following English instruction!<br><br>\r\n\r\n<strong>Size:</strong><br>\r\n1.Scale: 1:24<br>\r\n2.Dollhouse Size:35(L) x22(W)x22(H) cm<br>\r\n3.Net Weight:1.5 kg<br>\r\nMaterial: wood, fabric, paper, plastic,matel<br>\r\nManual: English instruction<br><br>\r\n\r\n<strong>Note:</strong><br>\r\n1.Age:apply above 10 years old<br>\r\n2.dust cover/glue/tools/battery not include in parcel<br>\r\n3.handcraft tools needed: paper scissors, knife,hole maker,precision tweezers,screw driver , adhesive'),
(19, 'Valencia Coast with Light/Anti-dust cover', 2800, 1, 5, '<strong>Product Description:</strong><br>\r\n\r\nLuxury Valencia Coast Villa DIY Cottage, beautiful style and cool light.<br> \r\nYou need to complete the assembly by yourself, the production process is more interesting, and there is a sense <br>\r\nof accomplishment after completion <br>\r\nThe finished size is about 35.5 * 29 * 39 cm / 13.98 * 11.42 * 15.35\'\' <br>\r\nWith LED lights, better effects at night. <br>\r\nWith music movements. '),
(20, 'Nendoroid Lyria & Vee', 1600, 2, 15, '<strong>&quot;I bestow my power... unto you!&quot;</strong><br><br>\r\n\r\n<p>From the anime &#39;GRANBLUE FANTASY&#39; comes a Nendoroid of the mysterious girl who has the power to command primal beasts, Lyria! She comes complete with a Nendoroid version of Vee to fly by her side.</p>\r\n\r\n<p>Lyria comes with three face plates including an innocent smile, a gentle blushing smile with closed eyes as well as a more serious expression for combat scenes. Vee comes with both a standard lower body as well as an alternate version that can be used to display him being held by Lyria. Pose the two of them together to recreate all sorts of different situations in Nendoroid size!</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(21, 'Nendoroid Snow Miku: Twinkle Snow Ver.', 2500, 2, 10, '<p><strong>This Winter, Snow Miku will be descending from the starry night sky!</strong></p>\r\n\r\n<p>2017 marks the 8th anniversary of Snow Miku, and the 2017 design was once again selected by fans through online votes between a selection of outfits all submitted to piapro by fans! This year the theme is &#39;Stars and Constellations of the Winter Hokkaido&#39;, and the winning Snow Miku design was illustrated by Nishina which has now been converted into this cute Nendoroid!</p>\r\n\r\n<p>She comes with three expressions including a cute smiling expression, a winking expression with sparkles in her eyes as well as a sleepy expression! She also comes with constellation and snow cloud effect parts, a baton and an icy music stand allowing you to display her conducting a performance for the stars! Other optional accessories include a table with a starry tablecloth, a snow chair as well as some tea in a tea cup for her to sit down and have a tea party with Rabbit Yukine who is also of course included!</p>\r\n\r\n<p>She also comes with icy effect parts to place at her feet, as well as a soft-looking star shaped cushion for her to hold - so many different accessories that incorporate both the &#39;stars&#39; and &#39;snow&#39;! Snow Miku has descended from the starry sky once again and is ready to join your collection!</p>\r\n'),
(22, 'Nendoroid Homura Akemi: Haregi Ver.', 1500, 2, 8, '<p><strong>Homura Akemi wearing a brilliant yellow Haregi in Nendoroid size!</strong></p>\r\n\r\n<p>From &#39;Puella Magi Madoka Magica&#39; comes a Nendoroid of Homura Akemi wearing a lovely yellow Haregi! She comes with two face plates including a smiling face as well as a gentle expression with closed eyes.</p>\r\n\r\n<p>The Nendoroid can be posed rubbing her hands together as if warming them up for the cold Winter season, and she also comes with sitting parts which can be used together with the expression with closed eyes to recreate a traditional bowing pose. Enjoy Homura in a stunning kimono in your Nendoroid collection!</p>\r\n'),
(29, 'Nendoroid Kizuna AI', 1400, 2, 10, '<p><strong>&quot;Hai Domo!&quot;</strong></p>\r\n\r\n<p>Kizuna AI, the world&#39;s first virtual YouTuber and a self-proclaimed super intelligent AI is joining the Nendoroids! She comes with four face plates including a smiling expression, a shouting expression, a proud expression with a bit of a mischievous look in her eyes as well as the installing expression that fans will remember from her videos!</p>\r\n\r\n<p>Optional parts include a pink laptop, a special sheet to display her as if in a video, a cardboard box as well as interchangeable lower body parts to display her sitting down allowing for all sorts of different situations in Nendoroid size! Be sure to add her to your collection and enjoy the virtual idol in the real world!</p>\r\n'),
(30, 'Milk Nana', 12000, 4, 1, '<pre>\r\n<strong>Brand - [Raccoon Doll]</strong></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Body size</strong></p>\r\n\r\n<p>Height : 44.5 cm</p>\r\n\r\n<p>Head circumference : 14.8 cm (5.8 inch)</p>\r\n\r\n<p>Eyes : 6mm</p>\r\n\r\n<p>Neck circumference : 6.7 cm</p>\r\n\r\n<p>Shoulder width : 9 cm</p>\r\n\r\n<p>Breast size : Large 20.2 cm / Small 19.1 cm</p>\r\n\r\n<p>Arm length: 13.6 cm</p>\r\n\r\n<p>Arm circumference : 5.5 cm</p>\r\n\r\n<p>Wrist circumference : 3.8 cm</p>\r\n\r\n<p>Waist circumference : Glamorous 13 cm / Slim 13.5 cm</p>\r\n\r\n<p>Thigh circumference : Glamorous 14 cm / Slim 12.5 cm</p>\r\n\r\n<p>Hip circumference : Glamorous 23 cm / Slim 21.6 cm</p>\r\n\r\n<p>Waist to toe length : 29 cm</p>\r\n\r\n<p>Ankle circumference : 5 cm</p>\r\n\r\n<p>Foot length : 4.7 cm</p>\r\n'),
(31, 'My guard - Juno', 12000, 4, 3, '<pre>\r\nBrand - [Raccoon Doll]</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Body size</strong></p>\r\n\r\n<p>Height : 44.5 cm</p>\r\n\r\n<p>Head circumference : 14.8 cm (5.8 inch)</p>\r\n\r\n<p>Eyes : 6mm</p>\r\n\r\n<p>Neck circumference : 6.7 cm</p>\r\n\r\n<p>Shoulder width : 9 cm</p>\r\n\r\n<p>Breast size : Large 20.2 cm / Small 19.1 cm</p>\r\n\r\n<p>Arm length: 13.6 cm</p>\r\n\r\n<p>Arm circumference : 5.5 cm</p>\r\n\r\n<p>Wrist circumference : 3.8 cm</p>\r\n\r\n<p>Waist circumference : Glamorous 13 cm / Slim 13.5 cm</p>\r\n\r\n<p>Thigh circumference : Glamorous 14 cm / Slim 12.5 cm</p>\r\n\r\n<p>Hip circumference : Glamorous 23 cm / Slim 21.6 cm</p>\r\n\r\n<p>Waist to toe length : 29 cm</p>\r\n\r\n<p>Ankle circumference : 5 cm</p>\r\n\r\n<p>Foot length : 4.7 cm</p>\r\n'),
(32, 'Winter Rose - Juno', 12000, 4, 3, '<pre>\r\nBrand - [Raccoon Doll]</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Body size</strong></p>\r\n\r\n<p>Height : 44.5 cm</p>\r\n\r\n<p>Head circumference : 14.8 cm (5.8 inch)</p>\r\n\r\n<p>Eyes : 6mm</p>\r\n\r\n<p>Neck circumference : 6.7 cm</p>\r\n\r\n<p>Shoulder width : 9 cm</p>\r\n\r\n<p>Breast size : Large 20.2 cm / Small 19.1 cm</p>\r\n\r\n<p>Arm length: 13.6 cm</p>\r\n\r\n<p>Arm circumference : 5.5 cm</p>\r\n\r\n<p>Wrist circumference : 3.8 cm</p>\r\n\r\n<p>Waist circumference : Glamorous 13 cm / Slim 13.5 cm</p>\r\n\r\n<p>Thigh circumference : Glamorous 14 cm / Slim 12.5 cm</p>\r\n\r\n<p>Hip circumference : Glamorous 23 cm / Slim 21.6 cm</p>\r\n\r\n<p>Waist to toe length : 29 cm</p>\r\n\r\n<p>Ankle circumference : 5 cm</p>\r\n\r\n<p>Foot length : 4.7 cm</p>\r\n'),
(33, 'Milk Mocha Gene', 14000, 4, 3, '<pre>\r\nBrand - [Raccoon Doll]</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Body size</strong></p>\r\n\r\n<p>Height : 44.5 cm</p>\r\n\r\n<p>Head circumference : 14.8 cm (5.8 inch)</p>\r\n\r\n<p>Eyes : 6mm</p>\r\n\r\n<p>Neck circumference : 6.7 cm</p>\r\n\r\n<p>Shoulder width : 9 cm</p>\r\n\r\n<p>Breast size : Large 20.2 cm / Small 19.1 cm</p>\r\n\r\n<p>Arm length: 13.6 cm</p>\r\n\r\n<p>Arm circumference : 5.5 cm</p>\r\n\r\n<p>Wrist circumference : 3.8 cm</p>\r\n\r\n<p>Waist circumference : Glamorous 13 cm / Slim 13.5 cm</p>\r\n\r\n<p>Thigh circumference : Glamorous 14 cm / Slim 12.5 cm</p>\r\n\r\n<p>Hip circumference : Glamorous 23 cm / Slim 21.6 cm</p>\r\n\r\n<p>Waist to toe length : 29 cm</p>\r\n\r\n<p>Ankle circumference : 5 cm</p>\r\n\r\n<p>Foot length : 4.7 cm</p>\r\n'),
(35, 'Nendoroid Northern Princess', 2200, 2, 13, '<p><strong>&quot;I said... don&#39;t... come any... closer...&quot;</strong></p>\r\n\r\n<p>From the popular browser game &#39;Kantai Collection -KanColle-&#39; comes a Nendoroid of the Abyssal warship, &#39;Northern Princess&#39;! The enemy ship looks as adorable as ever, but don&#39;t be fooled by her appearance - she is equipped with all sorts of highly dangerous weaponry which has all been faithfully recreated in Nendoroid size! the batteries on her main turret can even be moved by rotating the runway on the side!</p>\r\n\r\n<p>Optional parts include two of the rather peculiar aircraft that fly by her side, as well as the &#39;Zero&#39; plane that she hold in her hands. Additionally, she also comes with parts that allow you recreate certain parts of her special Christmas version that was seen during the Christmas event in December 2014.</p>\r\n\r\n<p>Three expression parts are also included - her standard expression, a shouting expression and a cute expression with upturned eyes. Various different parts and expressions to create the Northern Princess you want by your side!</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE `productcategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `CatagoryHeader` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`CategoryID`, `CategoryName`, `CatagoryHeader`) VALUES
(1, 'Miniature House', 'Product_image/housebanner.jpg'),
(2, 'Nendoroid', 'Product_image/0.jpg'),
(3, 'Funko', 'Product_image/funkobanner.jpg'),
(4, 'BJD', 'Product_image/bjd_header.jpg');

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
(21, 6, 'Product_image\\kashu1.jpg'),
(22, 6, 'Product_image\\kashu2.jpg'),
(23, 6, 'Product_image\\kashu3.jpg'),
(24, 6, 'Product_image\\kashu4.jpg'),
(25, 6, 'Product_image\\kashu5.jpg'),
(26, 7, 'Product_image/Room2.jpg'),
(27, 7, 'Product_image/Room1.jpg'),
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
(52, 14, 'Product_image/Iroha1.jpg'),
(53, 14, 'Product_image/Iroha2.jpg'),
(54, 14, 'Product_image/Iroha3.jpg'),
(55, 14, 'Product_image/Iroha4.jpg'),
(56, 14, 'Product_image/Iroha5.jpg'),
(57, 15, 'Product_image/perzivalfunko.png'),
(58, 16, 'Product_image/12.jpg'),
(63, 18, 'Product_image/greenhouse1.jpg'),
(64, 18, 'Product_image/greenhouse12.jpg'),
(65, 18, 'Product_image/greenhouse3.jpg'),
(66, 18, 'Product_image/greenhouse4.jpg'),
(67, 19, 'Product_image/valencia2.jpg'),
(68, 19, 'Product_image/valencia1.jpg'),
(69, 19, 'Product_image/valencia3.jpg'),
(70, 19, 'Product_image/valencia4.jpg'),
(71, 19, 'Product_image/valencia5.jpg'),
(72, 20, 'Product_image/lyria1.jpg'),
(73, 20, 'Product_image/lyria2.jpg'),
(74, 20, 'Product_image/lyria3.jpg'),
(75, 20, 'Product_image/lyria4.jpg'),
(76, 21, 'Product_image/mikusnow1.jpg'),
(77, 21, 'Product_image/mikusnow2.jpg'),
(78, 21, 'Product_image/mikusnow3.jpg'),
(79, 21, 'Product_image/mikusnow4.jpg'),
(80, 21, 'Product_image/mikusnow5.jpg'),
(81, 22, 'Product_image/homu1.jpg'),
(82, 22, 'Product_image/homu2.jpg'),
(83, 22, 'Product_image/homu3.jpg'),
(84, 22, 'Product_image/homu4.jpg'),
(85, 22, 'Product_image/homu5.jpg'),
(140, 17, 'Product_image/blue1.jpg'),
(141, 17, 'Product_image/blue2.jpg'),
(142, 17, 'Product_image/blue3.jpg'),
(143, 17, 'Product_image/blue4.jpg'),
(144, 17, ''),
(145, 29, 'Product_image/ai1.jpg'),
(146, 29, 'Product_image/ai2.jpg'),
(147, 29, 'Product_image/ai3.jpg'),
(148, 29, 'Product_image/ai4.jpg'),
(149, 29, 'Product_image/ai5.jpg'),
(165, 30, 'Product_image/milk_nana_01.jpg'),
(166, 30, 'Product_image/milk_nana_02.jpg'),
(167, 30, 'Product_image/milk_nana_03.jpg'),
(168, 30, 'Product_image/milk_nana_04.jpg'),
(169, 30, 'Product_image/milk_nana_05.jpg'),
(170, 31, 'Product_image/myguard_juno_01.jpg'),
(171, 31, 'Product_image/myguard_juno_02.jpg'),
(172, 31, 'Product_image/myguard_juno_03.jpg'),
(173, 31, 'Product_image/myguard_juno_04.jpg'),
(174, 31, 'Product_image/myguard_juno_05.jpg'),
(175, 32, 'Product_image/winterrose_juno_01.jpg'),
(176, 32, 'Product_image/winterrose_juno_02.jpg'),
(177, 32, 'Product_image/winterrose_juno_03.jpg'),
(178, 32, 'Product_image/winterrose_juno_04.jpg'),
(179, 32, 'Product_image/winterrose_juno_05.jpg'),
(180, 33, 'Product_image/gene_meetspringday_01.jpg'),
(181, 33, 'Product_image/gene_meetspringday_02.jpg'),
(182, 33, 'Product_image/gene_meetspringday_03.jpg'),
(183, 33, 'Product_image/gene_meetspringday_04.jpg'),
(184, 33, 'Product_image/gene_meetspringday_05.jpg'),
(270, 35, 'Product_image/northern1.jpg'),
(271, 35, 'Product_image/northern2.jpg'),
(272, 35, 'Product_image/northern3.jpg'),
(273, 35, 'Product_image/northern4.jpg'),
(274, 35, 'Product_image/northern5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `PromotionID` int(11) NOT NULL,
  `PromotionName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `PromotionDiscount` int(11) NOT NULL,
  `PromotionType` varchar(60) NOT NULL COMMENT 'fix or percent',
  `PromotionCode` varchar(15) NOT NULL,
  `PromotionCondition` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`PromotionID`, `PromotionName`, `PromotionDiscount`, `PromotionType`, `PromotionCode`, `PromotionCondition`) VALUES
(1, 'ต้อนรับฤดูฝน', 500, 'fix', 'rainny', 0),
(2, 'เมดสาวเจ้าเสน่ห์', 5, 'percent', 'maid5000', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingID` int(11) NOT NULL,
  `trxID` int(11) NOT NULL,
  `ShippingStatus` tinyint(1) NOT NULL,
  `Posttrack` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shippingID`, `trxID`, `ShippingStatus`, `Posttrack`, `Name`, `Address`) VALUES
(13, 36, 1, 'EE123546876RH', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000'),
(14, 37, 0, '', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000'),
(15, 38, 0, '', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000'),
(16, 39, 0, '', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000'),
(17, 40, 0, '', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000'),
(18, 41, 0, '', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000'),
(19, 42, 0, '', 'จิรัชญา ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000');

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
  `password` varchar(15) NOT NULL,
  `sendpromotion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CustFName`, `CustLName`, `CustAddress`, `CustEmail`, `username`, `password`, `sendpromotion`) VALUES
('', '', '', '', 'admin', 'admin', 0),
('frame', 'ff', '221B baker street', 'Wannisa1940@hotmail.com', 'frame', 'ttandt', 1),
('จิรัชญา', 'ยี่โต๊ะ', '36/20 ถนน มลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000', 'tempesta-psyzeoul@hotmail.com', 'scenaire', 'ttandt', 1),
('Sherlock', 'Holmes', '221B baker street', 'sherlock@BBC.com', 'sherlock', 'ttandt', 0),
('John', 'Watson', '221B baker street', 'Watson@BBC.com', 'Watson', 'ttandt', 0),
('โย๊ะ', 'เยาะแยะ', '221B baker street', 'pran.pornprom@gmail.com', 'yoyo', 'ttandt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(20) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `Username`, `ProductID`) VALUES
(4, 'Watson', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`trxID`),
  ADD KEY `username` (`username`),
  ADD KEY `PromotionID` (`PromotionID`);

--
-- Indexes for table `ordersproduct`
--
ALTER TABLE `ordersproduct`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `trxID` (`trxID`);

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
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`PromotionID`) USING BTREE;

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingID`),
  ADD KEY `trxID` (`trxID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `CustEmail` (`CustEmail`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `trxID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ordersproduct`
--
ALTER TABLE `ordersproduct`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `ProductImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `PromotionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `users` (`username`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`PromotionID`) REFERENCES `promotion` (`PromotionID`);

--
-- Constraints for table `ordersproduct`
--
ALTER TABLE `ordersproduct`
  ADD CONSTRAINT `ordersproduct_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `ordersproduct_ibfk_3` FOREIGN KEY (`trxID`) REFERENCES `orders` (`trxID`);

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

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`trxID`) REFERENCES `orders` (`trxID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

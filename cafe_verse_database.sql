SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `cafe_verse` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cafe_verse`;

CREATE TABLE `cafes` (
  `id` int(11) NOT NULL,
  `osm_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `overall_rating` int(2) DEFAULT NULL,
  `lat` decimal(10,7) DEFAULT NULL,
  `lng` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `cafes`;
INSERT INTO `cafes` VALUES(1, '51529ca38e8ec95ec059204bcaf44ba24840f00103f90139e116ee000000009203064e5554544541', 'NUTTEA', '1958 West 4th Avenue, Vancouver, BC V6J 1M5, Canada', 5, 49.2679430, -123.1493260, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(2, '513e9e3205f8c45ec05901d0f3f7d29d4840f00102f901f3eb42090000000092030f44756666696e277320446f6e757473', 'Duffin\'s Donuts', '1391 East 41st Avenue, Vancouver, BC V5W, Canada', 5, 49.2330007, -123.0776380, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(3, '5156a851eb79c95ec0590217bdc59ea24840f00102f901a74b430c0000000092030f4265204672657368204d61726b6574', 'Be Fresh Market', '1900 West 1st Avenue, Vancouver, BC V6J, Canada', 4, 49.2704703, -123.1480664, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(4, '51d6b5acb17ac45ec059e1381d296ca24840f00102f90109ea67110000000092030d436166652043616c6162726961', 'Cafe Calabria', '1745 Commercial Drive, Vancouver, BC V5N, Canada', 3, 49.2689258, -123.0699887, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(5, '5163ced83c73c65ec05910ff087f2ba14840f00102f90115ef6c110000000092031d3439746820506172616c6c656c20436f', '49th Parallel Coffee Roasters', '2902 Main Street, Vancouver, BC V5T 3G3, Canada', 2, 49.2591399, -123.1007836, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(6, '517dfa28c727c45ec059badb8e2c05a44840f00102f901651823120000000092030c45646765204b69746368656e', 'Edge Kitchen', '1927 East Hastings Street, Vancouver, BC V5L, Canada', 2, 49.2814079, -123.0649279, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(7, '5135ebea0304c75ec0592edd037a97a04840f00102f901827f4e150000000092030d546865204d69676879204f616b', 'The Mighty Oak', '198 West 18th Avenue, Vancouver, BC V5Y, Canada', 3, 49.2546227, -123.1096201, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(8, '51f4dbd78173ca5ec059bd5569a2cfa14840f00103f90104e167260000000092031654686f6d617320486161732043686f63', 'Thomas Haas Chocolates', '2539 West Broadway, Vancouver, BC V6K 2E9, Canada', 5, 49.2641490, -123.1633000, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(9, '51906ad8ef89cf5ec059335510bf07a24840f00103f90130bf7a2600000000920309537461726275636b73', 'Starbucks', '5761 Dalhousie Road, Electoral Area A, BC V6T 2H9, Canada', 5, 49.2658614, -123.2427940, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(10, '511590f63fc0c75ec0590d8c49f14ca34840f00103f901664eeb260000000092030d416e616c6f6720436f66666565', 'Analog Coffee', '338 Helmcken Street, Vancouver, BC V6B 6C5, Canada', 2, 49.2757856, -123.1211090, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(11, '5185b2f0f5b5c85ec059f74e6ee70c964840f00103f9013f83d52d00000000920309537461726275636b73', 'Starbucks', '8111 Ackroyd Road, Richmond, BC V6X 3J9, Canada', 1, 49.1722688, -123.1361060, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(12, '5125b616c15ac55ec0597118679599984840f00103f901cb5c692e00000000920309537461726275636b73', 'Starbucks', '12571 Bridgeport Road, Richmond, BC V6V 1J4, Canada', 5, 49.1921870, -123.0836642, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(13, '51b8b3af3c48c85ec0596cbf84387b984840f00103f901d35c692e00000000920309537461726275636b73', 'Starbucks', '8525 Sea Island Way, Richmond, BC V6X 0A8, Canada', 1, 49.1912604, -123.1294090, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(14, '51f9d577d98aca5ec0593b36962254a24840f00103f901975f18300000000092030a43616665204c6f6b616c', 'Cafe Lokal', '2610 West 4th Avenue, Vancouver, BC V6K 1P8, Canada', 4, 49.2681926, -123.1647247, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(15, '51fcfb8c0b07c85ec05924fd57d9e3a34840f00103f901a255f7350000000092030c57616c6c20466c6f77657273', 'Wall Flowers', 'Hornby Street, Vancouver, BC V6Z, Canada', 2, 49.2803909, -123.1254300, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(16, '51f2bd75b4e0cf5ec059b025f8ac21a14840f00103f90136a09c42000000009203154265616e2041726f756e642054686520', 'Bean Around The World', '6308 Thunderbird Boulevard, Vancouver, BC V6T 1Z4, Canada', 2, 49.2588402, -123.2480899, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(17, '51c1e09a3b7ac65ec05903e00f4537a04840f00103f901886047430000000092030c436f636f2026204f6c697665', 'Coco & Olive', '307 Main Street, Vancouver, BC V5V 3N8, Canada', 5, 49.2516867, -123.1012105, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(18, '514a83914da8c85ec0599df54d67dda24840f00103f901927d9f440000000092030f53696567656c277320426167656c73', 'Siegel\'s Bagels', '1689 Johnston Street, Vancouver, BC V6H, Canada', 3, 49.2723817, -123.1352724, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(19, '5143075dc2a1c85ec059316c8a83f0a24840f00103f901b5af9f440000000092031654686520426c756520506172726f7420', 'The Blue Parrot Coffee', '1689 Johnston Street, Vancouver, BC V6H, Canada', 3, 49.2729649, -123.1348730, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(20, '51040b71f618ca5ec05968896f010d8f4840f00103f9018615e54a0000000092030f4469706c6f6d61742042616b657279', 'Diplomat Bakery', '6168 London Road, Richmond, BC V7E 0C1, Canada', 3, 49.1175844, -123.1577736, '2025-10-05 07:08:40');
INSERT INTO `cafes` VALUES(28, '5163ced83c73c65ec05910ff087f2ba14840f00102f90115ef6c110000000092031d3439746820506172616c6c656c20436f6666656520526f617374657273', '49th Parallel Coffee Roasters', '2902 Main Street, Vancouver, BC V5T 3G3, Canada', 4, 49.2591399, -123.1007836, '2025-10-05 07:14:42');
INSERT INTO `cafes` VALUES(31, '51f4dbd78173ca5ec059bd5569a2cfa14840f00103f90104e167260000000092031654686f6d617320486161732043686f636f6c61746573', 'Thomas Haas Chocolates', '2539 West Broadway, Vancouver, BC V6K 2E9, Canada', 1, 49.2641490, -123.1633000, '2025-10-05 07:14:42');
INSERT INTO `cafes` VALUES(39, '51f2bd75b4e0cf5ec059b025f8ac21a14840f00103f90136a09c42000000009203154265616e2041726f756e642054686520576f726c64', 'Bean Around The World', '6308 Thunderbird Boulevard, Vancouver, BC V6T 1Z4, Canada', 1, 49.2588402, -123.2480899, '2025-10-05 07:14:42');
INSERT INTO `cafes` VALUES(42, '5143075dc2a1c85ec059316c8a83f0a24840f00103f901b5af9f440000000092031654686520426c756520506172726f7420436f66666565', 'The Blue Parrot Coffee', '1689 Johnston Street, Vancouver, BC V6H, Canada', 3, 49.2729649, -123.1348730, '2025-10-05 07:14:42');
INSERT INTO `cafes` VALUES(564, '5113c7702b73c95ec05944573c0cada24840f00103f901ff2c3b4f0000000092031050616e652046726f6d2048656176656e', 'Pane From Heaven', '1670 Cypress Street, Vancouver, BC V6J, Canada', NULL, 49.2709060, -123.1476544, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(565, '5105b309302cc35ec0597d4d144905a44840f00103f9013a14eb53000000009203184c61756768696e67204265616e20436f6666656520436f2e', 'Laughing Bean Coffee Co.', '2695 East Hastings Street, Vancouver, BC V5K, Canada', NULL, 49.2814113, -123.0495720, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(566, '511ce38a8ba3c85ec0598e836f7e1e9a4840f00103f9014b252e550000000092030b5769636b27732043616665', 'Wick\'s Cafe', '1300 West 73rd Avenue, Vancouver, BC V6P 3E7, Canada', NULL, 49.2040556, -123.1349820, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(567, '513dd00a0c59c65ec059343dadb9a3a34840f00103f9016c3ba25f0000000092030746696f72696e6f', 'Fiorino', '212 East Georgia Street, Vancouver, BC V6A, Canada', NULL, 49.2784340, -123.0991850, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(568, '515d424f14b2c75ec0595395e832eba04840f00103f9013ae86e630000000092030e56656c6f20537461722043616665', 'Velo Star Cafe', '3195 Heather Street, Vancouver, BC V5Z 3K2, Canada', NULL, 49.2571777, -123.1202441, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(569, '517293516518cb5ec0592aff6f4dcba14840f00103f901d1deac66000000009203134e657665726c616e64205465612053616c6f6e', 'Neverland Tea Salon', '3066 West Broadway, Vancouver, BC V6K, Canada', NULL, 49.2640168, -123.1733640, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(570, '513eaf78ea91c75ec059ac68855b99a44840f00103f901743c6c6a0000000092030c426c656e7a20436f66666565', 'Blenz Coffee', '550 Burrard Street, Vancouver, BC V6C 2B5, Canada', NULL, 49.2859301, -123.1182810, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(571, '51bce3b963d6c65ec059642d8568bea24840f00103f901457ef76c0000000092030c546572726120427265616473', 'Terra Breads', '1605 Manitoba Street, Vancouver, BC V5Y, Canada', NULL, 49.2714358, -123.1068353, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(572, '518109dcba9bcb5ec0593a2e5b3002904840f00103f9014bd6fc7000000000920318526f63616e696e6920436f6666656520526f617374657273', 'Rocanini Coffee Roasters', '3900 Moncton Street, Richmond, BC V7E 3A6, Canada', NULL, 49.1250668, -123.1813800, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(573, '51c6bc337f71c45ec0591a88c16e33a24840f00103f9015df70e740000000092030a507261646f2043616665', 'Prado Cafe', '1938 Commercial Drive, Vancouver, BC V5N, Canada', NULL, 49.2671946, -123.0694273, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(574, '51539b9372d2c55ec059fd3bd560d09c4840f00103f9018126d975000000009203144272656b612042616b657279202620436166c3a9', 'Breka Bakery & Café', '6533 Fraser Street, Vancouver, BC V5X, Canada', NULL, 49.2251092, -123.0909697, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(575, '512350fd8348c05ec0591c1f7eba26a24840f00103f9015825ff7600000000920316436f436f204672657368205465612026204a75696365', 'CoCo Fresh Tea & Juice', '4461 Lougheed Highway, Burnaby, BC V5C 0J4, Canada', NULL, 49.2668069, -123.0044260, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(576, '512f50526001c75ec0596fc48bf73ea44840f00103f9017ada3d81000000009203085265766f6c766572', 'Revolver', '325 Cambie Street, Vancouver, BC V6B 1H7, Canada', NULL, 49.2831716, -123.1094590, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(577, '5184f6459d94c85ec0590024cc261ba44840f00103f90111d3578a00000000920312486f20486f27732059756d6d7920466f6f64', 'Ho Ho\'s Yummy Food', '1224 Davie Street, Vancouver, BC V6E, Canada', NULL, 49.2820786, -123.1340707, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(578, '51d1730b5d89c85ec059d8c5446117a44840f00103f901a36a598a0000000092030c426c656e7a20436f66666565', 'Blenz Coffee', '1203 Davie Street, Vancouver, BC V6E 1N4, Canada', NULL, 49.2819635, -123.1333840, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(579, '518862f20698c75ec059260f99bff8a34840f00103f9019a82ad8f0000000092030c426c656e7a20436f66666565', 'Blenz Coffee', '767 Seymour Street, Vancouver, BC V6B 5J3, Canada', NULL, 49.2810287, -123.1186540, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(580, '511b4e999b6fc65ec0594918bfce4da84840f00103f901144f9a950000000092031654686f6d617320486161732043686f636f6c61746573', 'Thomas Haas Chocolates', '998 Harbourside Drive, North Vancouver, BC V7P 3T2, Canada', NULL, 49.3148745, -123.1005620, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(581, '51b399f9c470c45ec0594cf5f9f5f9a24840f00103f901c7e0a1a1000000009203065475726b2773', 'Turk\'s', '1276 Commercial Drive, Vancouver, BC V5L, Canada', NULL, 49.2732532, -123.0693829, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(582, '511626530523c95ec0595db9f46805a84840f00103f901d6595ea40000000092031350726f737065637420506f696e742043616665', 'Prospect Point Cafe', '5601 Stanley Park Drive, Vancouver, BC V6G, Canada', NULL, 49.3126651, -123.1427625, '2025-10-05 19:34:41');
INSERT INTO `cafes` VALUES(583, '5115128b732fc85ec059ed90e711a3a34840f00103f901244c8dad000000009203144272656b612042616b657279202620436166c3a9', 'Breka Bakery & Café', '855 Davie Street, Vancouver, BC V6Z 1B7, Canada', NULL, 49.2784140, -123.1278962, '2025-10-05 19:34:41');

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `followers`;
INSERT INTO `followers` VALUES(1, 3, 2, '2025-10-05 16:02:10');

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `cafe_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `title` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `reviews`;
INSERT INTO `reviews` VALUES(1, 1, 1, 5, 'Amazing coffee and cozy atmosphere!', 'The ambiance was really nice, and the barista was super friendly. I will definitely come back next week!', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(2, 1, 2, 4, 'Really enjoyed the vibes, coffee was good.', 'Coffee tasted great, but the seating area was a bit crowded. Still, a lovely spot to relax.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(3, 2, 1, 4, 'Donuts were fresh and tasty.', 'Loved the variety of flavors. The staff were welcoming, and the coffee paired perfectly.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(4, 2, 2, 5, 'Best donuts in town!', 'A cozy little cafe with amazing pastries. Highly recommend the chocolate glazed donut!', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(5, 3, 1, 5, 'Fresh and organic products, loved it!', 'So many fresh options available. Shopping here felt really healthy and enjoyable.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(6, 3, 2, 4, 'Good selection, nice place to shop.', 'Friendly staff and great selection. Perfect for a quick organic snack run.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(7, 4, 1, 3, 'Coffee was okay, service slow.', 'The coffee was average but the place was charming. Waiting time was a bit long though.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(8, 4, 2, 4, 'Nice ambiance, coffee was decent.', 'The vibe of this cafe is lovely, makes it worth visiting. Coffee could be a bit stronger.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(9, 5, 1, 5, 'Best latte in the city!', 'The latte art was gorgeous and coffee tasted amazing. Will definitely recommend this place to friends.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(10, 5, 2, 5, 'Love this coffee spot!', 'Cozy place with excellent service. The coffee quality is top notch and worth every penny.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(11, 6, 1, 4, 'Great breakfast menu.', 'Food was delicious and portions were generous. Loved the pancake stack!', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(12, 6, 2, 3, 'Coffee was okay, food was good.', 'Breakfast menu had lots of choices. Coffee could be stronger, but overall a decent experience.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(13, 7, 1, 5, 'Cozy and welcoming place.', 'Really comfortable seating and friendly staff. A perfect spot for studying or meeting friends.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(14, 7, 2, 4, 'Really liked the atmosphere.', 'Lovely cafe with great lighting and vibe. Drinks were tasty and service good.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(15, 8, 1, 5, 'Chocolates are heavenly!', 'Every chocolate treat was amazing. Definitely coming back for more, can\'t resist!', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(16, 8, 2, 4, 'Delicious treats, perfect for gifts.', 'The chocolates are high quality and beautifully packaged. Perfect for gifting someone special.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(17, 9, 1, 4, 'Standard Starbucks experience.', 'Coffee tasted consistent as expected. A good place to grab your usual coffee.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(18, 9, 2, 3, 'Coffee was fine but busy.', 'The place was crowded and noisy, but coffee quality was okay. Suitable for a quick stop.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(19, 10, 1, 5, 'Loved the analog vibe and coffee!', 'Cozy cafe with excellent coffee. Staff were attentive and friendly.', '2025-10-05 07:44:45', 'img/review-placeholder1.jpg');
INSERT INTO `reviews` VALUES(20, 10, 2, 5, 'Great spot to work and drink coffee.', 'Perfect atmosphere for working or relaxing. Drinks were flavorful and service great.', '2025-10-05 07:44:45', 'img/review-placeholder2.jpg');
INSERT INTO `reviews` VALUES(21, 1, 2, 5, 'Great Coffee', 'Loved the ambiance and coffee taste.', '2025-10-05 09:03:23', 'img/review1.jpg');
INSERT INTO `reviews` VALUES(22, 1, 1, 3, 'Nice Spot', 'Cozy place to chill with friends.', '2025-10-05 09:03:23', 'img/review2.jpg');
INSERT INTO `reviews` VALUES(23, 1, 2, 1, 'Friendly Staff', 'Staff were really welcoming and attentive.', '2025-10-05 09:03:23', 'img/review3.jpg');
INSERT INTO `reviews` VALUES(24, 1, 2, 2, 'Good Vibes', 'Music and atmosphere were perfect for working.', '2025-10-05 09:03:23', 'img/review4.jpg');
INSERT INTO `reviews` VALUES(25, 1, 2, 2, 'Awesome Coffee', 'Espresso was top-notch, will come again.', '2025-10-05 09:03:23', 'img/review5.jpg');
INSERT INTO `reviews` VALUES(26, 1, 1, 2, 'Cozy Corner', 'Small but very comfortable seating.', '2025-10-05 09:03:23', 'img/review6.jpg');
INSERT INTO `reviews` VALUES(27, 1, 1, 1, 'Quick Service', 'Orders were prepared very fast.', '2025-10-05 09:03:23', 'img/review7.jpg');
INSERT INTO `reviews` VALUES(28, 1, 1, 1, 'Loved It', 'Great coffee, nice desserts, friendly staff.', '2025-10-05 09:03:23', 'img/review8.jpg');
INSERT INTO `reviews` VALUES(29, 1, 1, 5, 'Weekend Hangout', 'Perfect place to relax on weekends.', '2025-10-05 09:03:23', 'img/review9.jpg');
INSERT INTO `reviews` VALUES(30, 1, 2, 4, 'Hidden Gem', 'Found this cafe randomly, absolutely love it.', '2025-10-05 09:03:23', 'img/review10.jpg');
INSERT INTO `reviews` VALUES(31, 1, 3, 3, 'Nuttea: A Warm Hug in a Cup – Where Rich Flavors and Comfort Blend Perfectly', 'Hi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc GaidaHi this is a test subject review from Acc Gaida', '2025-10-05 15:49:18', 'uploads/reviews/review_68e2937e657be.heic,uploads/reviews/review_68e2937e65d2f.png');
INSERT INTO `reviews` VALUES(32, 7, 4, 5, 'The Mighty Oak Café: A Cozy Retreat Where Nature Meets Community', 'The Mighty Oak Café is a charming, rustic haven nestled in the heart of the town, where nature\'s beauty meets the warmth of community. As you step inside, the inviting aroma of freshly ground coffee greets you, a gentle hint of roasted beans blending perfectly with the earthy scent of oak wood that lines the walls. The café\'s interior is a cozy blend of vintage and contemporary, with deep wooden tables, mismatched chairs, and an array of plants hanging from the ceiling, creating a vibrant yet calming atmosphere. Large windows allow sunlight to pour in, casting soft rays across the room, while the sound of soft indie music adds to the café’s relaxed vibe.', '2025-10-05 17:13:08', 'uploads/reviews/review_68e2a7244e076.jpeg,uploads/reviews/review_68e2a7244e4b0.jpeg');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `followers` int(11) NOT NULL DEFAULT 0,
  `ratings_count` int(11) NOT NULL DEFAULT 0,
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `users`;
INSERT INTO `users` VALUES(1, '', 'Alice Johnson', 'alice@example.com', '$2y$10$e0NRXjP0kL5A5dZpF2tOcu7aXHjS1rPz4Z1YvF0zU3fYJtPqQmXkG', 0, 0, 0, '2025-10-05 07:41:28');
INSERT INTO `users` VALUES(2, '', 'Bob Smith', 'bob@example.com', '$2y$10$7G3wFhP0uT1qR9ZcDkL8vO/J2S1eYxR3zA4K9pV5tQ0H2rF1mY6yC', 1, 0, 0, '2025-10-05 07:41:28');


ALTER TABLE `cafes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `osm_id` (`osm_id`),
  ADD UNIQUE KEY `osm_id_2` (`osm_id`),
  ADD UNIQUE KEY `osm_id_3` (`osm_id`);

ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cafe_id` (`cafe_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `cafes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`cafe_id`) REFERENCES `cafes` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `shop_db`;
CREATE DATABASE IF NOT EXISTS `shop_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `shop_db`;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` varchar(36) NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

TRUNCATE TABLE `client`;

INSERT INTO `client` (`id`, `email`, `password`, `name`, `address`, `phone`) VALUES
('95d2b90a-1b60-4321-b5d5-16e18e1d0616', 'jlopez@gmail.com', 'j', 'José Lopez', 'Av. vascongadas 2 1B', '123456789'),
('97269e70-2705-4a89-9346-5d384be9d232', 'mgarcia@gmail.com', 'm', 'María', NULL, NULL),
('5d0254aa-c1a8-4b83-8c1e-54340e499268', 'jfernandez@gmail.com', '1234', 'Juanito', NULL, NULL);

-- --------------------------------------------------------

DROP TABLE IF EXISTS `order_line`;
CREATE TABLE `order_line` (
  `order_id` varchar(36) NOT NULL,
  `product_id` varchar(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



TRUNCATE TABLE `order_line`;

INSERT INTO `order_line` (`order_id`, `product_id`, `quantity`, `unit_price`) VALUES
('e2d9f777-9b80-4f24-9773-ba7e249dfa41', '4cfc2907-db21-419e-abe9-becceb124e31', 3, NULL),
('e2d9f777-9b80-4f24-9773-ba7e249dfa41', '8f66a6d8-5d6a-41ca-a0b0-0955d1ad5852', 1, NULL);

-- --------------------------------------------------------

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` varchar(36) NOT NULL,
  `client_id` varchar(36) NOT NULL,
  `ship_address` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


TRUNCATE TABLE `order`;

INSERT INTO `order` (`id`, `client_id`, `ship_address`, `confirm_date`) VALUES
('e2d9f777-9b80-4f24-9773-ba7e249dfa41', '95d2b90a-1b60-4321-b5d5-16e18e1d0616', NULL, NULL);

-- --------------------------------------------------------

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


TRUNCATE TABLE `product`;

INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
('4cfc2907-db21-419e-abe9-becceb124e31', 'Cafetera', 'Modelo 5000, con doble filtro de partículas.', '9.87'),
('8f66a6d8-5d6a-41ca-a0b0-0955d1ad5852', 'Roomba', 'Suba y baja escaleras, último modelo.', '11.67');


ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_line_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2020 年 01 月 07 日 06:16
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shop`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`name`, `password`) VALUES
('112233', '112233'),
('admin', 'admin'),
('test', 'abc123'),
('test1', 'abc123'),
('test122', 'test122'),
('ZZZ123', 'ZZZ123');

-- --------------------------------------------------------

--
-- 資料表結構 `item`
--

CREATE TABLE `item` (
  `item_id` int(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` int(20) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  `item_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_price`, `item_type`, `item_user`) VALUES
(0, 'Predator', 20000, 'C3', 'admin'),
(1, 'Predator', 20000, 'C3', 'admin'),
(2, '奶油曲奇餅', 199, 'food', 'admin'),
(3, '蛋黃派', 95, 'food', 'test'),
(4, 'HITACHI吸塵器', 4235, 'home', 'test1'),
(5, '重磅連帽T恤', 950, 'clothes', '112233'),
(6, 'Acer AN715-51-534T', 1231, 'C3', '112233'),
(7, 'BAG', 123, 'clothes', 'test1'),
(8, 'WD My Cloud Pro PR2100', 25640, 'C3', 'admin'),
(9, '龍蝦鮑魚干貝佛跳牆', 2108, 'food', 'admin'),
(10, '好運蝦', 888, 'food', 'admin'),
(11, 'R9-3900X', 188888, 'C3', 'admin'),
(12, '微積分1', 100, 'home', 'ZZZ123'),
(13, '米家掃拖機器人', 6666, 'home', 'ZZZ123'),
(14, 'chair', 200, 'C3', 'test122');

-- --------------------------------------------------------

--
-- 資料表結構 `item_order`
--

CREATE TABLE `item_order` (
  `order_id` int(20) NOT NULL,
  `order_seller` varchar(20) NOT NULL,
  `order_user` varchar(20) NOT NULL,
  `order_product` int(20) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `item_order`
--

INSERT INTO `item_order` (`order_id`, `order_seller`, `order_user`, `order_product`, `order_status`) VALUES
(0, '112233', 'admin', 6, '未出貨'),
(1, '112233', 'admin', 6, '未出貨'),
(2, 'admin', 'test', 1, '已出貨'),
(3, 'admin', 'test', 1, '未出貨'),
(4, 'admin', 'test', 1, '已出貨'),
(5, 'admin', 'test', 1, '未出貨'),
(6, 'admin', 'test', 1, '未出貨'),
(7, 'admin', 'admin', 8, '未出貨'),
(8, 'admin', 'admin', 9, '未出貨'),
(9, 'admin', 'admin', 9, '未出貨'),
(10, 'admin', 'admin', 9, '未出貨'),
(11, '112233', 'admin', 6, '未出貨'),
(12, 'test122', 'test122', 14, '已出貨');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_name` varchar(20) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_home` varchar(50) NOT NULL,
  `user_account` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_name`, `user_phone`, `user_home`, `user_account`) VALUES
('test100', '09333333333', '113331', '112233'),
('王曉明', '0987654321', '台中市北屯區市政北七路一段87號五樓之一', 'admin'),
('活動專區', '0985245612', 'eeeee', 'test'),
('葉大雄', '0258746931', '台中市北屯區市政北七路一段875號五樓之一', 'test1'),
('王曉', '0987654321', '台中市北屯區市政北七路一段87號五樓之一', 'test122'),
('張勝麟', '0987654456', '台南市永康區南台街一號', 'ZZZ123');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`name`);

--
-- 資料表索引 `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- 資料表索引 `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`order_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

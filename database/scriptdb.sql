-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th8 11, 2021 lúc 01:06 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.6
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
  time_zone = "+00:00";
  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;
--
  -- Cơ sở dữ liệu: `Shopping`
  --
  -- --------------------------------------------------------
  --
  -- Cấu trúc bảng cho bảng `Cart`
  --
  CREATE TABLE `Cart` (
    `cart_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `product_price` int(11) NOT NULL,
    `quantity` int(11) DEFAULT NULL,
    `cart_price` int(11) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
  --
  -- Cấu trúc bảng cho bảng `Invoice`
  --
  CREATE TABLE `Invoice` (
    `invoiceID` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `address` varchar(400) NOT NULL,
    `phone` varchar(15) NOT NULL,
    `dateOfBill` datetime NOT NULL,
    `totalPrice` int(11) NOT NULL,
    `status` varchar(50) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Đang đổ dữ liệu cho bảng `Invoice`
  --
INSERT INTO
  `Invoice` (
    `invoiceID`,
    `user_id`,
    `address`,
    `phone`,
    `dateOfBill`,
    `totalPrice`,
    `status`
  )
VALUES
  (
    8,
    10,
    '135B Trần Hưng Đạo',
    '73984729834',
    '2021-08-03 14:33:49',
    537000,
    'Canceled'
  ),
  (
    9,
    19,
    '227 Nguyễn Văn Cừ',
    '456456456',
    '2021-08-04 09:49:58',
    9000000,
    'In delivery'
  ),
  (
    10,
    18,
    '27 Nguyễn Thị Minh Khai',
    '123123123',
    '2021-08-04 09:50:38',
    379000,
    'Confirmed'
  ),
  (
    11,
    10,
    '135B Tran Hung Dao',
    '73984729834',
    '2021-08-04 11:41:58',
    120000,
    'Waiting'
  );
-- --------------------------------------------------------
  --
  -- Cấu trúc bảng cho bảng `InvoiceLine`
  --
  CREATE TABLE `InvoiceLine` (
    `invoiceID` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `product_price` int(11) NOT NULL,
    `quantity` int(11) NOT NULL,
    `price` int(11) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Đang đổ dữ liệu cho bảng `InvoiceLine`
  --
INSERT INTO
  `InvoiceLine` (
    `invoiceID`,
    `product_id`,
    `product_price`,
    `quantity`,
    `price`
  )
VALUES
  (8, 2, 139000, 2, 278000),
  (8, 4, 120000, 1, 120000),
  (8, 1, 139000, 1, 139000),
  (9, 9, 1000000, 2, 2000000),
  (9, 5, 120000, 2, 240000),
  (9, 17, 8000000, 1, 8000000),
  (10, 5, 120000, 2, 240000),
  (10, 2, 139000, 1, 139000),
  (11, 7, 120000, 1, 120000);
-- --------------------------------------------------------
  --
  -- Cấu trúc bảng cho bảng `Product`
  --
  CREATE TABLE `Product` (
    `product_id` int(11) NOT NULL,
    `product_brand` varchar(100) NOT NULL,
    `product_name` varchar(100) NOT NULL,
    `product_description` varchar(3000) DEFAULT NULL,
    `product_image` varchar(200) NOT NULL,
    `product_price` int(11) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Đang đổ dữ liệu cho bảng `Product`
  --
INSERT INTO
  `Product` (
    `product_id`,
    `product_brand`,
    `product_name`,
    `product_description`,
    `product_image`,
    `product_price`
  )
VALUES
  (
    1,
    'Tú Stationary',
    'Sổ tay ghi chép - xám',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book1.jpeg',
    139000
  ),
  (
    2,
    'Tú Stationary',
    'Sổ tay ghi chép - xanh',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book2.jpeg',
    139000
  ),
  (
    3,
    'Tú Stationary',
    'Sổ da',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book3.jpeg',
    95000
  ),
  (
    4,
    'Tú Stationary',
    'Sổ da bìa cứng',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book4.jpeg',
    120000
  ),
  (
    5,
    'Tú Stationary',
    'Sổ da bìa cứng - nâu sáng',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book5.jpeg',
    120000
  ),
  (
    6,
    'Tú Stationary',
    'Sổ da bìa cứng - xanh trời',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book6.jpeg',
    120000
  ),
  (
    7,
    'Tú Stationary',
    'Sổ da bìa cứng - nâu đậm',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book7.jpeg',
    120000
  ),
  (
    8,
    'Tú Stationary',
    'Sổ da bìa cứng - hồng',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Books/book9.png',
    120000
  ),
  (
    9,
    'The Min\'s',
    'Banned Low',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/bannedlow.jpeg',
    1000000
  ),
  (
    10,
    'The Min\'s',
    'Carbon FB',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/CarbonFb.jpeg',
    1500000
  ),
  (
    11,
    'The Min\'s',
    'JD1 High beetroot',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/JD1HighBeetroot.jpeg',
    1000000
  ),
  (
    12,
    'The Min\'s',
    'Jordan 1 Low - Siren Red',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/Jordan1Low-SirenRed.jpeg',
    2000000
  ),
  (
    13,
    'The Min\'s',
    'Jordan 1 Low',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/Jordan1Low.jpeg',
    900000
  ),
  (
    14,
    'The Min\'s',
    'Jordan 1 Mid - Chile Red',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/Jordan1Mid-ChileRed.jpeg',
    1200000
  ),
  (
    15,
    'The Min\'s',
    'Nothing But Net',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/NothingButNet.jpeg',
    1000000
  ),
  (
    16,
    'The Min\'s',
    'Shadow Mid',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/bannedlow.jpeg',
    500000
  ),
  (
    17,
    'The Min\'s',
    'UNC Blue',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati deleniti, fugit eligendi eos deserunt ea perspiciatis soluta quis aperiam minima officia saepe id laborum rerum quam eum harum, magni asperiores!',
    '../img/Shoes/UNCBlue.jpeg',
    8000000
  );
-- --------------------------------------------------------
  --
  -- Cấu trúc bảng cho bảng `User_DB`
  --
  CREATE TABLE `User_DB` (
    `user_id` int(11) NOT NULL,
    `fullname` varchar(100) NOT NULL,
    `username` varchar(100) NOT NULL,
    `phone` varchar(100) NOT NULL,
    `user_password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `isAdmin` tinyint(1) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Đang đổ dữ liệu cho bảng `User_DB`
  --
INSERT INTO
  `User_DB` (
    `user_id`,
    `fullname`,
    `username`,
    `phone`,
    `user_password`,
    `email`,
    `isAdmin`
  )
VALUES
  (
    10,
    'Hoàng Nam',
    'hoangnam',
    '73984729834',
    '$2y$10$z9wUpzj7eUBqNiBgkBkwWe8qsRL/uRXCI95UCC.4lwOB8ZQ0OqEVC',
    'hoangnam@gmail.com',
    0
  ),
  (
    18,
    'John Doe',
    'JohnDoe',
    '123123123',
    '$2y$10$DTAumNXEIN/ghw4S54PB2OFstZ53KtUHwP4l3XrTEjOF1Q2h/Mr3i',
    'JohnDoe@gmail.com',
    0
  ),
  (
    19,
    'Nguyen Le Hoang Nam',
    'nguyennam',
    '456456456',
    '$2y$10$rTCcFkyDe8j2jEFLmETf0.lZwuusFAtg9pKzMG1uKAaKqxyjodI7O',
    'nguyennam@gmail.com',
    0
  ),
  (
    20,
    'Admin',
    'Admin',
    '0000000000',
    '$2y$10$L1nMDcQ6swjFk7a4yBT5.O0lIK5T6aOiJRl0omK77yqS/paA9C2x6',
    'admin@email.com',
    1
  );
-- --------------------------------------------------------
  --
  -- Cấu trúc bảng cho bảng `Wishlist`
  --
  CREATE TABLE `Wishlist` (
    `cart_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `product_price` int(11) NOT NULL,
    `quantity` int(11) DEFAULT NULL,
    `cart_price` int(11) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Chỉ mục cho các bảng đã đổ
  --
  --
  -- Chỉ mục cho bảng `Cart`
  --
ALTER TABLE
  `Cart`
ADD
  PRIMARY KEY (`cart_id`);
--
  -- Chỉ mục cho bảng `Invoice`
  --
ALTER TABLE
  `Invoice`
ADD
  PRIMARY KEY (`invoiceID`);
--
  -- Chỉ mục cho bảng `Product`
  --
ALTER TABLE
  `Product`
ADD
  PRIMARY KEY (`product_id`);
--
  -- Chỉ mục cho bảng `User_DB`
  --
ALTER TABLE
  `User_DB`
ADD
  PRIMARY KEY (`user_id`);
--
  -- AUTO_INCREMENT cho các bảng đã đổ
  --
  --
  -- AUTO_INCREMENT cho bảng `Cart`
  --
ALTER TABLE
  `Cart`
MODIFY
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 111;
--
  -- AUTO_INCREMENT cho bảng `Invoice`
  --
ALTER TABLE
  `Invoice`
MODIFY
  `invoiceID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 12;
--
  -- AUTO_INCREMENT cho bảng `Product`
  --
ALTER TABLE
  `Product`
MODIFY
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;
--
  -- AUTO_INCREMENT cho bảng `User_DB`
  --
ALTER TABLE
  `User_DB`
MODIFY
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 21;
COMMIT;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
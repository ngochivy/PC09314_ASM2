-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th6 10, 2024 lúc 05:25 PM
-- Phiên bản máy phục vụ: 8.0.36
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php1_wd19303`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pc09314_departments`
--

CREATE TABLE `pc09314_departments` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `pc09314_departments`
--

INSERT INTO `pc09314_departments` (`id`, `name`, `status`) VALUES
(1, 'Human Resources', 1),
(2, 'Finance', 1),
(3, 'Infomation Technology', 1),
(4, 'Marketing', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pc09314_employees`
--

CREATE TABLE `pc09314_employees` (
  `id` int NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `code` varchar(7) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `department_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `pc09314_employees`
--

INSERT INTO `pc09314_employees` (`id`, `firstname`, `lastname`, `code`, `department_id`) VALUES
(1, 'John', 'Doe', 'PC09310', 1),
(2, 'Jane', 'Smith', 'PC09311', 2),
(3, 'John', 'Doe', 'PC09312', 1),
(4, 'Emily', 'Davis', 'PC09313', 4),
(5, 'David', 'Wilson', 'PC09314', 3),
(6, 'Emma', 'Garcia', 'PC09315', 2),
(7, 'Daniel', 'Martinez', 'PC09316', 4),
(8, 'Sophia', 'Hernandez', 'PC09317', 3),
(9, 'James', 'Lopez', 'PC09318', 3),
(10, 'Olivia', 'Gonzalez', 'PC09319', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pc09314_users`
--

CREATE TABLE `pc09314_users` (
  `id` int NOT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `pc09314_users`
--

INSERT INTO `pc09314_users` (`id`, `name`, `password`, `email`, `avatar`) VALUES
(1, 'Kylian Mbappe', '$2y$10$DmIrlZK6aHp6.FaNk3dsWuhL8Bqymd/vOOgA7ZV1F7LmdY/YsK6L.', 'chivyngo3@gmail.com', 'avatar.jpg'),
(3, 'chi vy ngo', '$2y$10$SkfJZyq6oDzU.o88LBFP5ORXb3LJIlRt/8jLNdMtuC548aD0J8T7m', 'michaelteo199@gmail.com', 'uploads/monkey d luffy.jpg'),
(4, 'nguyen van a', '$2y$10$vBmXlrW0dqv2GqeX9FQ7QegqkP3NpdoUvcu4e.Nq6DvoQ3JB/kU0W', 'a@gmail.com', 'uploads/tải xuống (17).jpg'),
(5, 'le thi d', '$2y$10$e/vGddydgEjcOH/8tTcii.Q2ZYY9rVItm3o21S42q/Beo4f2uHhCG', 'c@gmail.com', 'uploads/tải xuống (17).jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pc09314_departments`
--
ALTER TABLE `pc09314_departments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pc09314_employees`
--
ALTER TABLE `pc09314_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Chỉ mục cho bảng `pc09314_users`
--
ALTER TABLE `pc09314_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `pc09314_departments`
--
ALTER TABLE `pc09314_departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `pc09314_employees`
--
ALTER TABLE `pc09314_employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `pc09314_users`
--
ALTER TABLE `pc09314_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

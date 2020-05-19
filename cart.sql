-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2019 at 05:56 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

set SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
set AUTOCOMMIT = 0;
start transaction;
set time_zone = "+00:00";


/*!40101 set @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 set @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 set @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 set names utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

create table `tbl_product`
(
    `id`    BIGINT(20) unsigned    not null auto_increment,
    `name`  VARCHAR(255)           not null default '' collate 'utf8mb4_unicode_ci',
    `code`  VARCHAR(255)           not null default '' collate 'utf8mb4_unicode_ci',
    `image` VARCHAR(255)           not null default '' collate 'utf8mb4_unicode_ci',
    `price` DOUBLE(10, 2) unsigned not null default '0.00',
    primary key (`id`) using btree,
    unique index `code` (`code`) using btree,
    fulltext index `name` (`name`, `code`)
) collate = 'utf8mb4_unicode_ci'
  engine = InnoDB;

--
-- Dumping data for table `tbl_product`
--

insert into `tbl_product` (`id`, `name`, `image`, `price`, `code`)
values (2, 'Iphone X Max', 'app.jpg', 1099.00, '1'),
       (1, 'Samsung Galaxy S10 Plus', 'sam.jpg', 999.00, '2'),
       (3, 'Huawei P30 Pro', 'hua.jpg', 1350.00, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_product`
--
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_product`
--
alter table `tbl_product`
    modify `id` BIGINT(20) unsigned not null auto_increment,
    auto_increment = 4;
commit;

/*!40101 set CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 set CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 set COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;

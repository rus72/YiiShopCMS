-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: mysql0.db.koding.com
-- Generation Time: Aug 17, 2012 at 06:07 AM
-- Server version: 5.1.61-log
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enchikiben_fbfde`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `Level` smallint(5) unsigned NOT NULL,
  `Status` int(1) NOT NULL COMMENT 'Тип категории',
  `Alias` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Категории' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`ID`, `root`, `lft`, `rgt`, `Level`, `Status`, `Alias`, `Name`, `Description`) VALUES
(1, 1, 1, 10, 1, 1, 'shiny', 'Шины', 'Шины'),
(2, 2, 1, 2, 1, 1, 'diski', 'Диски', 'Диски'),
(3, 1, 2, 9, 2, 1, 'letnie', 'Летние', 'Летние'),
(4, 1, 3, 8, 3, 1, 'zimnie', 'Зимние', 'Зимние'),
(5, 1, 4, 5, 4, 1, 'vsesezonnye', 'Всесезонные', 'Всесезонные'),
(6, 1, 6, 7, 4, 0, '123', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `disk`
--

CREATE TABLE IF NOT EXISTS `disk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Alias` varchar(255) DEFAULT NULL,
  `Title` text,
  `Keywords` text,
  `Description` text,
  `Name` varchar(255) DEFAULT NULL,
  `Size` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `disk`
--

INSERT INTO `disk` (`ID`, `Alias`, `Title`, `Keywords`, `Description`, `Name`, `Size`) VALUES
(1, '', '', '', '', 'Диск 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `IntegerFields`
--

CREATE TABLE IF NOT EXISTS `IntegerFields` (
  `FieldID` int(11) NOT NULL,
  `MinValue` int(11) NOT NULL COMMENT 'От',
  `MaxValue` int(11) NOT NULL COMMENT 'Да',
  PRIMARY KEY (`FieldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Числовые поля';

--
-- Dumping data for table `IntegerFields`
--

INSERT INTO `IntegerFields` (`FieldID`, `MinValue`, `MaxValue`) VALUES
(2, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ListFields`
--

CREATE TABLE IF NOT EXISTS `ListFields` (
  `FieldID` int(11) NOT NULL AUTO_INCREMENT,
  `ListID` int(11) NOT NULL,
  `IsMultipleSelect` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Множественный выбор списка',
  PRIMARY KEY (`FieldID`),
  KEY `ListID` (`ListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `ListFields`
--

INSERT INTO `ListFields` (`FieldID`, `ListID`, `IsMultipleSelect`) VALUES
(42, 2, 1),
(43, 3, 0),
(45, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Lists`
--

CREATE TABLE IF NOT EXISTS `Lists` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Списки' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Lists`
--

INSERT INTO `Lists` (`ID`, `Name`) VALUES
(2, 'Размер'),
(3, 'Тип');

-- --------------------------------------------------------

--
-- Table structure for table `ListsItems`
--

CREATE TABLE IF NOT EXISTS `ListsItems` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ListID` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `Priority` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ListID` (`ListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Списки' AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ListsItems`
--

INSERT INTO `ListsItems` (`ID`, `ListID`, `Status`, `Priority`, `Name`) VALUES
(1, 2, 1, 0, '10'),
(4, 2, 1, 0, '12\r'),
(5, 2, 1, 0, '13\r'),
(6, 2, 1, 0, '15\r'),
(7, 2, 1, 0, '16\r'),
(8, 2, 1, 0, '17'),
(9, 3, 1, 0, 'Зима\r'),
(10, 3, 1, 0, 'Дето\r'),
(11, 3, 1, 0, 'фвфыв');

-- --------------------------------------------------------

--
-- Table structure for table `Manufacturers`
--

CREATE TABLE IF NOT EXISTS `Manufacturers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `Alias` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Производители' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Manufacturers`
--

INSERT INTO `Manufacturers` (`ID`, `Status`, `Alias`, `Name`, `Description`) VALUES
(1, 1, 'p1', 'Производитель 1', 'Производитель 1');

-- --------------------------------------------------------

--
-- Table structure for table `PriceFields`
--

CREATE TABLE IF NOT EXISTS `PriceFields` (
  `FieldID` int(11) NOT NULL,
  `MaxValue` int(11) NOT NULL COMMENT 'Да',
  PRIMARY KEY (`FieldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ценовые поля';

--
-- Dumping data for table `PriceFields`
--

INSERT INTO `PriceFields` (`FieldID`, `MaxValue`) VALUES
(4, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `Name` varchar(255) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `Title` text NOT NULL,
  `Keywords` text NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица продуктов магазина' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ID`, `Status`, `Name`, `Alias`, `Title`, `Keywords`, `Description`) VALUES
(1, 1, 'Шины', 'tires', '', '', ''),
(2, 1, 'Диски', 'disk', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ProductsFields`
--

CREATE TABLE IF NOT EXISTS `ProductsFields` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Position` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `FieldType` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Alias` varchar(50) NOT NULL,
  `IsMandatory` tinyint(1) NOT NULL DEFAULT '0',
  `IsFilter` tinyint(1) NOT NULL DEFAULT '0',
  `IsColumnTable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'используется в заголовке таблицы',
  `UnitName` varchar(255) NOT NULL COMMENT 'Единицы измерения',
  `Hint` varchar(255) NOT NULL COMMENT 'Подсказка',
  PRIMARY KEY (`ID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `ProductsFields`
--

INSERT INTO `ProductsFields` (`ID`, `Position`, `ProductID`, `FieldType`, `Name`, `Alias`, `IsMandatory`, `IsFilter`, `IsColumnTable`, `UnitName`, `Hint`) VALUES
(1, 0, 1, 2, 'Наименование товара', 'Name', 1, 1, 1, '', ''),
(2, 0, 1, 1, 'Количество', 'Col', 0, 1, 1, '', ''),
(3, 0, 1, 4, 'Описание', 'decs', 0, 0, 0, '', ''),
(4, 0, 1, 3, 'Цена', 'Price', 1, 1, 1, '', ''),
(42, 0, 1, 5, 'Размер', 'Size', 0, 0, 1, '', ''),
(43, 0, 1, 5, 'Type', 'Type', 0, 0, 1, '', ''),
(44, 0, 2, 2, 'Заголовок', 'Name', 1, 0, 1, '', ''),
(45, 0, 2, 5, 'Размер', 'Size', 0, 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `RecordsCategories`
--

CREATE TABLE IF NOT EXISTS `RecordsCategories` (
  `ProductID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL,
  `CategoryID` int(11) unsigned NOT NULL,
  KEY `ProductID` (`ProductID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь товаров со множественными списками';

-- --------------------------------------------------------

--
-- Table structure for table `RecordsLists`
--

CREATE TABLE IF NOT EXISTS `RecordsLists` (
  `ProductID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL,
  `ListItemID` int(11) NOT NULL,
  KEY `ProductID` (`ProductID`),
  KEY `ListItemID` (`ListItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь товаров со множественными списками';

--
-- Dumping data for table `RecordsLists`
--

INSERT INTO `RecordsLists` (`ProductID`, `RecordID`, `ListItemID`) VALUES
(1, 1, 1),
(1, 1, 7),
(1, 1, 8),
(1, 3, 5),
(2, 1, 1),
(2, 1, 5),
(1, 4, 6),
(1, 6, 6),
(1, 8, 6),
(1, 9, 4),
(1, 9, 5),
(1, 9, 6),
(1, 9, 8),
(1, 10, 5),
(1, 10, 6),
(1, 11, 1),
(1, 12, 4),
(1, 17, 4),
(1, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `StringFields`
--

CREATE TABLE IF NOT EXISTS `StringFields` (
  `FieldID` int(11) NOT NULL,
  `MinLength` int(3) NOT NULL DEFAULT '0' COMMENT 'Минимальная длинна',
  `MaxLength` int(3) NOT NULL DEFAULT '255' COMMENT 'Максимальная длинна',
  PRIMARY KEY (`FieldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Строковые поля';

--
-- Dumping data for table `StringFields`
--

INSERT INTO `StringFields` (`FieldID`, `MinLength`, `MaxLength`) VALUES
(1, 0, 255),
(44, 0, 255);

-- --------------------------------------------------------

--
-- Table structure for table `TextFields`
--

CREATE TABLE IF NOT EXISTS `TextFields` (
  `FieldID` int(11) NOT NULL,
  `MinLength` int(11) NOT NULL DEFAULT '0' COMMENT 'Минимальная длинна',
  `MaxLength` int(11) NOT NULL DEFAULT '10000' COMMENT 'Максимальная длинна',
  `Rows` int(11) NOT NULL DEFAULT '5' COMMENT 'Строк',
  PRIMARY KEY (`FieldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Текстовые поля';

--
-- Dumping data for table `TextFields`
--

INSERT INTO `TextFields` (`FieldID`, `MinLength`, `MaxLength`, `Rows`) VALUES
(3, 0, 10000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tires`
--

CREATE TABLE IF NOT EXISTS `tires` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Alias` varchar(255) DEFAULT NULL,
  `Title` text,
  `Keywords` text,
  `Description` text,
  `Name` varchar(255) DEFAULT NULL,
  `Col` int(11) DEFAULT NULL,
  `decs` text,
  `Price` decimal(9,2) DEFAULT NULL,
  `sadas` int(11) DEFAULT NULL,
  `Size` int(11) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `sadas` (`sadas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tires`
--

INSERT INTO `tires` (`ID`, `Alias`, `Title`, `Keywords`, `Description`, `Name`, `Col`, `decs`, `Price`, `sadas`, `Size`, `Type`) VALUES
(1, '', '', '', '', 'Шина 1', 3, '', '234.30', 5, NULL, 10),
(2, '', '', '', '', 'Шина 2', NULL, 'asd', '213.00', 4, NULL, NULL),
(3, '', '', '', '', 'Шина 3', NULL, '', '323.00', 6, NULL, 11),
(4, '', '', '', '', 'Шина 4', 23, '234', '12.50', 4, 1, 10),
(5, '', '', '', '', 'Шина 5', NULL, '', '3.00', NULL, NULL, NULL),
(6, '', '', '', '', 'Шина 6', NULL, '', '6.00', NULL, 1, NULL),
(7, '', '', '', '', 'Шина 7', NULL, '', '7.00', NULL, NULL, 9),
(8, '', '', '', '', 'Шина 8', NULL, 'dfg', '8.00', NULL, 1, NULL),
(9, '', '', '', '', 'Шина 9', NULL, '', '9.00', NULL, 1, 10),
(10, '', '', '', '', 'Шина 10', NULL, '', '5.00', NULL, 1, 10),
(11, '', '', '', '', 'Шина 11', 34, '343', '11.00', NULL, 1, 9),
(12, '', '', '', '', 'Шина 12', NULL, '123', '12.00', NULL, 1, NULL),
(13, '', '', '', '', 'Шина 13', NULL, '123', '13.00', NULL, NULL, 11),
(14, '', '', '', '', 'Шина 14', 1, '123', '14.00', NULL, NULL, NULL),
(15, '', '', '', '', 'Шина 15', 15, '', '15.00', NULL, NULL, NULL),
(16, '', '', '', '', 'Шина 16', NULL, '', '16.00', NULL, NULL, NULL),
(17, '', '', '', '', 'Шина 17', NULL, '', '17.00', NULL, 1, 9),
(18, '', '', '', '', 'Шина 18', NULL, '', '17.00', NULL, NULL, 9),
(19, '', '', '', '', 'Шина 18', NULL, '', '18.00', NULL, NULL, NULL),
(20, '', '', '', '', 'Шина 19', NULL, '', '19.00', NULL, NULL, NULL),
(21, '', '', '', '', 'Шина 20', NULL, '', '20.00', NULL, NULL, NULL),
(22, '', '', '', '', 'Шина 21', 21, '', '21.00', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Включен/Выключен',
  `RoleID` int(5) DEFAULT '1' COMMENT 'Номер роли',
  `RegistrationDateTime` datetime DEFAULT NULL COMMENT 'Дата и время регистрации',
  `ServiceID` int(5) DEFAULT '1' COMMENT 'Идентификатор сервиса (1 - локальный пользователь)',
  `ServiceUserID` varchar(255) DEFAULT NULL COMMENT 'Идентификатор пользователя в сервисе',
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `Status`, `RoleID`, `RegistrationDateTime`, `ServiceID`, `ServiceUserID`, `Email`, `Password`, `UserName`) VALUES
(1, 0, 2, '2012-06-30 20:17:00', 1, '', 'enchikiben@gmail.com', 'a37e9e0ada9d5eef566727a9a8ea36e8', NULL),
(2, 0, 1, '2012-07-04 00:41:25', 3, 'http://openid.yandex.ru/EnChikiben/', NULL, NULL, 'EnChikiben');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `IntegerFields`
--
ALTER TABLE `IntegerFields`
  ADD CONSTRAINT `IntegerFields_ibfk_1` FOREIGN KEY (`FieldID`) REFERENCES `ProductsFields` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ListFields`
--
ALTER TABLE `ListFields`
  ADD CONSTRAINT `ListFields_ibfk_1` FOREIGN KEY (`FieldID`) REFERENCES `ProductsFields` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ListFields_ibfk_2` FOREIGN KEY (`ListID`) REFERENCES `Lists` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PriceFields`
--
ALTER TABLE `PriceFields`
  ADD CONSTRAINT `PriceFields_ibfk_1` FOREIGN KEY (`FieldID`) REFERENCES `ProductsFields` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ProductsFields`
--
ALTER TABLE `ProductsFields`
  ADD CONSTRAINT `ProductsFields_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RecordsCategories`
--
ALTER TABLE `RecordsCategories`
  ADD CONSTRAINT `RecordsCategories_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `Categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RecordsLists`
--
ALTER TABLE `RecordsLists`
  ADD CONSTRAINT `RecordsLists_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RecordsLists_ibfk_3` FOREIGN KEY (`ListItemID`) REFERENCES `ListsItems` (`ID`);

--
-- Constraints for table `StringFields`
--
ALTER TABLE `StringFields`
  ADD CONSTRAINT `StringFields_ibfk_1` FOREIGN KEY (`FieldID`) REFERENCES `ProductsFields` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TextFields`
--
ALTER TABLE `TextFields`
  ADD CONSTRAINT `TextFields_ibfk_1` FOREIGN KEY (`FieldID`) REFERENCES `ProductsFields` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tires`
--
ALTER TABLE `tires`
  ADD CONSTRAINT `tires_ibfk_1` FOREIGN KEY (`sadas`) REFERENCES `ListsItems` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- @manasseh152
-- Voer elk @BLOCK afzonderlijk uit in de database
-- LET OP: de @BLOCK's zijn afhankelijk van elkaar, dus uitvoeren in volgorde
-- @BLOCK
DROP DATABASE IF EXISTS `project`;
CREATE DATABASE `project`;
USE `project`;
-- Table: pictures
-- Columns: id: BINARY(16), description: varchar(255), path: varchar(255), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` BINARY(16) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: categories
-- Columns: id: BINARY(16), name: varchar(255), description: varchar(255), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` BINARY(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu_items
-- Columns: id: int(11), name: varchar(255), description: varchar(255), price: decimal(10,2), amount: int(11), unit: varchar(10), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu_item_pictures
-- Columns: id: int(11), menu_item_id: int(11), picture_id: BINARY(16), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu_item_pictures`;
CREATE TABLE `menu_item_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_item_id` int(11) NOT NULL,
  `picture_id` BINARY(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `menu_item_id` (`menu_item_id`),
  KEY `picture_id` (`picture_id`),
  CONSTRAINT `menu_item_pictures_ibfk_1` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`),
  CONSTRAINT `menu_item_pictures_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu_item_categories
-- Columns: id: int(11), menu_item_id: int(11), category_id: BINARY(16), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu_item_categories`;
CREATE TABLE `menu_item_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_item_id` int(11) NOT NULL,
  `category_id` BINARY(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `menu_item_id` (`menu_item_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `menu_item_categories_ibfk_1` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`),
  CONSTRAINT `menu_item_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu
-- Columns: id: int(11), name: varchar(255), description: varchar(255), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu_pictures
-- Columns: id: int(11), menu_id: int(11), picture_id: BINARY(16), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu_pictures`;
CREATE TABLE `menu_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `picture_id` BINARY(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `picture_id` (`picture_id`),
  CONSTRAINT `menu_pictures_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_pictures_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu_categories
-- Columns: id: int(11), menu_id: int(11), category_id: BINARY(16), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu_categories`;
CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `category_id` BINARY(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `menu_categories_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: menu_connectors
-- Columns: id: int(11), menu_id: int(11), menu_item_id: int(11), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `menu_connectors`;
CREATE TABLE `menu_connectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `menu_connectors_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_connectors_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: addresses
-- Columns: id: int(11), street: varchar(255), city: varchar(255), state: varchar(255), zip: varchar(255), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: locations
-- Columns: id: int(11), address_id: int(11), name: varchar(255), description: varchar(255), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: location_pictures
-- Columns: id: int(11), location_id: int(11), picture_id: BINARY(16), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `location_pictures`;
CREATE TABLE `location_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `picture_id` BINARY(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `picture_id` (`picture_id`),
  CONSTRAINT `location_pictures_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `location_pictures_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: location_categories
-- Columns: id: int(11), location_id: int(11), category_id: BINARY(16), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `location_categories`;
CREATE TABLE `location_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `category_id` BINARY(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `location_categories_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `location_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: roles
-- Columns: id: int(11), name: varchar(255), description: varchar(255), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: users
-- Columns: id: int(11), email: varchar(255), password: varchar(255), access_token: varchar(255), is_active: tinyint(1), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: user_roles
-- Columns: id: int(11), user_id: int(11), role_id: int(11), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: opening_hours
-- Columns: id: int(11), location_id: int(11), day: int(11), open: time, close: time, date?: date, created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `opening_hours`;
CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `opening_hours_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: location_reviews
-- Columns: id: int(11), location_id: int(11), user_id: int(11), rating: int(11), data: json, created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `location_reviews`;
CREATE TABLE `location_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `location_reviews_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `location_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: customers
-- Columns: id: int(11), user_id?: int(11), first_name: varchar(255), last_name: varchar(255), email: varchar(255), phone: varchar(255), is_active: tinyint(1), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: seating
-- Columns: id: int(11), location_id: int(11), name: varchar(255), regular_seats: int(11), child_seats: int(11), data: json, created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `seating`;
CREATE TABLE `seating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `regular_seats` int(11) NOT NULL,
  `child_seats` int(11) NOT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `seating_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table: reservations
-- Columns: id: int(11), location_id: int(11), customer_id: int(11), seating_id: int(11), date: date, from: time, to: time, discount: decimal(10,2), total: decimal(10,2), created_at: timestamp, updated_at: timestamp
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seating_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `customer_id` (`customer_id`),
  KEY `seating_id` (`seating_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`seating_id`) REFERENCES `seating` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
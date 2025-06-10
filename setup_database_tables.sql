-- Database Tables Setup for TAPA About Page
-- Run this script to create the necessary tables

-- Team Members Table
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `position_order` int(11) DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zones Table
CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `zone_coordinator` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Messages Table (for contact form)
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data for team members
INSERT INTO `team_members` (`name`, `position`, `position_order`) VALUES
('Dr. John Doe', 'President', 1),
('Dr. Jane Smith', 'Vice President', 2),
('Dr. Michael Johnson', 'Secretary General', 3),
('Dr. Sarah Wilson', 'Treasurer', 4);

-- Sample data for zones
INSERT INTO `zones` (`zone_name`, `description`, `contact_info`) VALUES
('Dar es Salaam Zone', 'Main zone covering Dar es Salaam region', '+255 679 256 256'),
('Arusha Zone', 'Northern zone covering Arusha region', '+255 679 256 257'),
('Mwanza Zone', 'Lake zone covering Mwanza region', '+255 679 256 258'),
('Mbeya Zone', 'Southern highlands zone', '+255 679 256 259'); 
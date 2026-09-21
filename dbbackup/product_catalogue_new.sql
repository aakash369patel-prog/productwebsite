-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2026 at 03:14 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_catalogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `badge` varchar(150) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `secondary_button_text` varchar(100) DEFAULT NULL,
  `secondary_button_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `badge`, `title`, `description`, `image`, `button_text`, `button_url`, `secondary_button_text`, `secondary_button_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Trusted B2B Exporter', 'Premium Natural Products for Global Markets', 'We manufacture and export high-quality organic powders, essential oils, cold pressed oils and tea ingredients with export-grade documentation and reliable bulk supply.', NULL, 'Explore Products', 'products', 'Send Enquiry', 'enquiry', 1, 'active', '2026-09-21 12:00:07', '2026-09-21 12:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-01-01-000001', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1788763184, 1),
(2, '2024-01-01-000002', 'App\\Database\\Migrations\\CreateProductCategoriesTable', 'default', 'App', 1788763184, 1),
(3, '2024-01-01-000003', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', 1788763184, 1),
(4, '2024-01-01-000004', 'App\\Database\\Migrations\\CreateProductSpecificationsTable', 'default', 'App', 1788763184, 1),
(5, '2024-01-01-000005', 'App\\Database\\Migrations\\CreateProductImagesTable', 'default', 'App', 1788763184, 1),
(6, '2024-01-01-000006', 'App\\Database\\Migrations\\CreateProductEnquiriesTable', 'default', 'App', 1788763184, 1),
(7, '2024-01-01-000007', 'App\\Database\\Migrations\\CreateHomeBannersTable', 'default', 'App', 1789992007, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `moq` varchar(100) DEFAULT NULL,
  `moq_unit` varchar(50) DEFAULT NULL,
  `applications` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `packaging_information` text DEFAULT NULL,
  `availability_information` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `short_description`, `description`, `main_image`, `moq`, `moq_unit`, `applications`, `benefits`, `packaging_information`, `availability_information`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Organic Turmeric Powder', 'organic-turmeric-powder', 'Bright golden turmeric powder with high curcumin content.', '<p>Bright golden turmeric powder with high curcumin content. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '100 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Organic Turmeric Powder - Bulk Supplier', 'Bright golden turmeric powder with high curcumin content.', 'organic turmeric powder, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(2, 1, 'Organic Ashwagandha Powder', 'organic-ashwagandha-powder', 'Premium adaptogenic herb powder for wellness formulations.', '<p>Premium adaptogenic herb powder for wellness formulations. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '50 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Organic Ashwagandha Powder - Bulk Supplier', 'Premium adaptogenic herb powder for wellness formulations.', 'organic ashwagandha powder, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(3, 1, 'Organic Moringa Leaf Powder', 'organic-moringa-leaf-powder', 'Nutrient-dense green superfood powder for supplements.', '<p>Nutrient-dense green superfood powder for supplements. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '100 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Organic Moringa Leaf Powder - Bulk Supplier', 'Nutrient-dense green superfood powder for supplements.', 'organic moringa leaf powder, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(4, 1, 'Organic Amla Powder', 'organic-amla-powder', 'Vitamin C rich amla powder for food and cosmetic use.', '<p>Vitamin C rich amla powder for food and cosmetic use. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '100 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Organic Amla Powder - Bulk Supplier', 'Vitamin C rich amla powder for food and cosmetic use.', 'organic amla powder, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(5, 2, 'Lemongrass Essential Oil', 'lemongrass-essential-oil', 'Fresh citrus aroma oil for aromatherapy and cleaning products.', '<p>Fresh citrus aroma oil for aromatherapy and cleaning products. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '25 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Lemongrass Essential Oil - Bulk Supplier', 'Fresh citrus aroma oil for aromatherapy and cleaning products.', 'lemongrass essential oil, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(6, 2, 'Eucalyptus Essential Oil', 'eucalyptus-essential-oil', 'Clear, camphoraceous oil widely used in wellness products.', '<p>Clear, camphoraceous oil widely used in wellness products. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '25 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Eucalyptus Essential Oil - Bulk Supplier', 'Clear, camphoraceous oil widely used in wellness products.', 'eucalyptus essential oil, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(7, 2, 'Peppermint Essential Oil', 'peppermint-essential-oil', 'Cooling menthol-rich oil for personal care applications.', '<p>Cooling menthol-rich oil for personal care applications. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '10 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Peppermint Essential Oil - Bulk Supplier', 'Cooling menthol-rich oil for personal care applications.', 'peppermint essential oil, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(8, 2, 'Tea Tree Essential Oil', 'tea-tree-essential-oil', 'Antiseptic grade oil for cosmetic and hygiene formulations.', '<p>Antiseptic grade oil for cosmetic and hygiene formulations. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '25 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Tea Tree Essential Oil - Bulk Supplier', 'Antiseptic grade oil for cosmetic and hygiene formulations.', 'tea tree essential oil, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(9, 3, 'Cold Pressed Coconut Oil', 'cold-pressed-coconut-oil', 'Virgin coconut oil with natural aroma and medium chain triglycerides.', '<p>Virgin coconut oil with natural aroma and medium chain triglycerides. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '200 L', 'Litre', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Cold Pressed Coconut Oil - Bulk Supplier', 'Virgin coconut oil with natural aroma and medium chain triglycerides.', 'cold pressed coconut oil, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(10, 3, 'Cold Pressed Almond Oil', 'cold-pressed-almond-oil', 'Light, nourishing oil ideal for skincare and massage products.', '<p>Light, nourishing oil ideal for skincare and massage products. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '100 L', 'Litre', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Cold Pressed Almond Oil - Bulk Supplier', 'Light, nourishing oil ideal for skincare and massage products.', 'cold pressed almond oil, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(11, 3, 'Cold Pressed Sesame Oil', 'cold-pressed-sesame-oil', 'Traditional edible and cosmetic grade sesame oil.', '<p>Traditional edible and cosmetic grade sesame oil. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '200 L', 'Litre', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Cold Pressed Sesame Oil - Bulk Supplier', 'Traditional edible and cosmetic grade sesame oil.', 'cold pressed sesame oil, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(12, 3, 'Cold Pressed Castor Oil', 'cold-pressed-castor-oil', 'Thick carrier oil used in hair care and industrial applications.', '<p>Thick carrier oil used in hair care and industrial applications. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '200 L', 'Litre', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Cold Pressed Castor Oil - Bulk Supplier', 'Thick carrier oil used in hair care and industrial applications.', 'cold pressed castor oil, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(13, 4, 'Chamomile Flower Cut', 'chamomile-flower-cut', 'Premium chamomile flowers for calming herbal tea blends.', '<p>Premium chamomile flowers for calming herbal tea blends. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '500 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Chamomile Flower Cut - Bulk Supplier', 'Premium chamomile flowers for calming herbal tea blends.', 'chamomile flower cut, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(14, 4, 'Peppermint Leaf Cut', 'peppermint-leaf-cut', 'Refreshing peppermint leaves for tea and functional beverages.', '<p>Refreshing peppermint leaves for tea and functional beverages. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '500 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Peppermint Leaf Cut - Bulk Supplier', 'Refreshing peppermint leaves for tea and functional beverages.', 'peppermint leaf cut, bulk, B2B, exporter', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(15, 4, 'Hibiscus Flower Cut', 'hibiscus-flower-cut', 'Vibrant hibiscus petals for tart, antioxidant-rich infusions.', '<p>Vibrant hibiscus petals for tart, antioxidant-rich infusions. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '500 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Hibiscus Flower Cut - Bulk Supplier', 'Vibrant hibiscus petals for tart, antioxidant-rich infusions.', 'hibiscus flower cut, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(16, 4, 'Green Tea Fanning', 'green-tea-fanning', 'High quality green tea fanning for bulk tea bag production.', '<p>High quality green tea fanning for bulk tea bag production. Manufactured under strict quality controls with full export documentation support including COA, MSDS and phytosanitary certificates where applicable.</p>', NULL, '1000 Kg', 'Kg', 'Food & Beverage, Nutraceuticals, Cosmetics, Ayurvedic Formulations', 'Export quality, consistent batch quality, bulk supply capability, custom packaging available', 'Available in 25 Kg bags, 50 Kg drums and custom packaging on request.', 'Ready stock available. Lead time 7-15 days for large export orders.', 'Green Tea Fanning - Bulk Supplier', 'High quality green tea fanning for bulk tea bag production.', 'green tea fanning, bulk, B2B, exporter', 0, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(17, 4, 'New Product', 'new-product', 'dfgdfgf', 'gdfgdfgdf', 'products/20260918_04bf0ae388852f31.png', '2', '', '', '', '', '', 'test', 'test', 'test', 0, 'active', '2026-09-18 09:48:14', '2026-09-18 09:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `short_description`, `description`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Organic & Herbal Powder', 'organic-herbal-powder', 'Premium quality organic and herbal powders for food, nutraceutical and cosmetic applications.', '<p>Our organic and herbal powder range includes carefully processed botanical ingredients sourced from certified farms. Ideal for bulk B2B supply with consistent quality and export documentation.</p>', NULL, 'Organic & Herbal Powder - Bulk Supplier', 'Export quality organic and herbal powders for global B2B buyers.', 'organic powder, herbal powder, bulk supplier', 1, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(2, 'Essential Oils', 'essential-oils', 'Pure steam-distilled essential oils for aromatherapy, cosmetics and wellness industries.', '<p>We manufacture and export a wide range of essential oils using advanced distillation processes to preserve natural properties and aroma profiles.</p>', NULL, 'Essential Oils - Manufacturer & Exporter', 'Bulk essential oils with export quality standards.', 'essential oils, aromatherapy, bulk oils', 2, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(3, 'Cold Pressed Oils', 'cold-pressed-oils', 'Nutrient-rich cold pressed carrier oils for food, skincare and pharmaceutical use.', '<p>Our cold pressed oils retain natural vitamins and antioxidants, making them ideal for premium product formulations and bulk industrial applications.</p>', NULL, 'Cold Pressed Oils - Bulk Exporter', 'High quality cold pressed oils for global distribution.', 'cold pressed oil, carrier oil, bulk export', 3, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(4, 'Tea Bag Ingredients', 'tea-bag-ingredients', 'Specialty tea ingredients and blends for tea bag manufacturers and private label brands.', '<p>Supplying premium tea ingredients including herbs, flowers and functional blends tailored for tea bag production and wellness beverage brands.</p>', NULL, 'Tea Bag Ingredients - B2B Supplier', 'Bulk tea ingredients for manufacturers and blenders.', 'tea ingredients, herbal tea, bulk tea', 4, 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_enquiries`
--

CREATE TABLE `product_enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied','closed') NOT NULL DEFAULT 'new',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_enquiries`
--

INSERT INTO `product_enquiries` (`id`, `product_id`, `name`, `company_name`, `email`, `phone`, `country`, `quantity`, `unit`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 17, 'bcvbhfg', 'dghfgh', 'ghfg@gmail.com', '546456', '5657', '567', '', 'fhghfyfutyutyutyutyutyu', 'read', '2026-09-18 09:50:14', '2026-09-18 09:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 17, 'products/gallery/20260918_36b82bbdde2f2e87.png', 0, '2026-09-18 09:48:14', '2026-09-18 09:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_specifications`
--

CREATE TABLE `product_specifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `specification_name` varchar(200) NOT NULL,
  `specification_value` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_specifications`
--

INSERT INTO `product_specifications` (`id`, `product_id`, `specification_name`, `specification_value`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(2, 1, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(3, 1, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(4, 1, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(5, 1, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(6, 1, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(7, 1, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(8, 1, 'MOQ', '100 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(9, 2, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(10, 2, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(11, 2, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(12, 2, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(13, 2, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(14, 2, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(15, 2, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(16, 2, 'MOQ', '50 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(17, 3, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(18, 3, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(19, 3, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(20, 3, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(21, 3, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(22, 3, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(23, 3, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(24, 3, 'MOQ', '100 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(25, 4, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(26, 4, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(27, 4, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(28, 4, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(29, 4, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(30, 4, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(31, 4, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(32, 4, 'MOQ', '100 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(33, 5, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(34, 5, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(35, 5, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(36, 5, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(37, 5, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(38, 5, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(39, 5, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(40, 5, 'MOQ', '25 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(41, 6, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(42, 6, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(43, 6, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(44, 6, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(45, 6, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(46, 6, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(47, 6, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(48, 6, 'MOQ', '25 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(49, 7, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(50, 7, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(51, 7, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(52, 7, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(53, 7, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(54, 7, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(55, 7, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(56, 7, 'MOQ', '10 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(57, 8, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(58, 8, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(59, 8, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(60, 8, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(61, 8, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(62, 8, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(63, 8, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(64, 8, 'MOQ', '25 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(65, 9, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(66, 9, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(67, 9, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(68, 9, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(69, 9, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(70, 9, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(71, 9, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(72, 9, 'MOQ', '200 L', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(73, 10, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(74, 10, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(75, 10, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(76, 10, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(77, 10, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(78, 10, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(79, 10, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(80, 10, 'MOQ', '100 L', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(81, 11, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(82, 11, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(83, 11, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(84, 11, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(85, 11, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(86, 11, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(87, 11, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(88, 11, 'MOQ', '200 L', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(89, 12, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(90, 12, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(91, 12, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(92, 12, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(93, 12, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(94, 12, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(95, 12, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(96, 12, 'MOQ', '200 L', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(97, 13, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(98, 13, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(99, 13, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(100, 13, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(101, 13, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(102, 13, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(103, 13, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(104, 13, 'MOQ', '500 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(105, 14, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(106, 14, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(107, 14, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(108, 14, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(109, 14, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(110, 14, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(111, 14, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(112, 14, 'MOQ', '500 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(113, 15, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(114, 15, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(115, 15, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(116, 15, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(117, 15, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(118, 15, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(119, 15, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(120, 15, 'MOQ', '500 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(121, 16, 'Form', 'Fine Powder', 0, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(122, 16, 'Color', 'Natural', 1, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(123, 16, 'Purity', '100% Natural', 2, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(124, 16, 'Shelf Life', '12-24 Months', 3, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(125, 16, 'Packaging Type', 'HDPE Drum / PP Bag', 4, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(126, 16, 'Processing Method', 'Hygienic Processing', 5, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(127, 16, 'Product Type', 'B2B Bulk', 6, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(128, 16, 'MOQ', '1000 Kg', 7, '2026-09-07 06:39:45', '2026-09-07 06:39:45'),
(129, 17, 'ghfgh', 'fghfgh', 0, '2026-09-18 09:48:14', '2026-09-18 09:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', '$2y$10$C.UGbP6okV1H87Mwug/1ZOeSOLyK1ar2y06iXVZHBlFY8seQ0CbYW', 'active', '2026-09-07 06:39:45', '2026-09-07 06:39:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status` (`status`),
  ADD KEY `is_featured` (`is_featured`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `product_enquiries`
--
ALTER TABLE `product_enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_specifications`
--
ALTER TABLE `product_specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_enquiries`
--
ALTER TABLE `product_enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_specifications`
--
ALTER TABLE `product_specifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_enquiries`
--
ALTER TABLE `product_enquiries`
  ADD CONSTRAINT `product_enquiries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_specifications`
--
ALTER TABLE `product_specifications`
  ADD CONSTRAINT `product_specifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

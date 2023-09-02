-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 09:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ventory2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Food'),
(2, 'Drink'),
(3, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(100) DEFAULT NULL,
  `cus_email` varchar(100) DEFAULT NULL,
  `cus_phone` varchar(20) DEFAULT NULL,
  `cus_address` varchar(200) DEFAULT NULL,
  `cus_dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `cus_email`, `cus_phone`, `cus_address`, `cus_dob`) VALUES
(1, 'John Smith', 'johnsmith@example.com', '1234567890', '123 Main St', '1980-05-15'),
(2, 'Jane Doe', 'janedoe@example.com', '9876543210', '456 Elm St', '1992-09-30'),
(3, 'Michael Johnson', 'michaeljohnson@example.com', '5551234567', '789 Oak St', '1975-07-10'),
(4, 'Emily Wilson', 'emilywilson@example.com', '4445678901', '321 Pine St', '1988-12-05'),
(5, 'David Brown', 'davidbrown@example.com', '1119876543', '654 Maple St', '1995-03-20'),
(6, 'Sarah Taylor', 'sarahtaylor@example.com', '2223456789', '987 Cedar St', '1982-11-18'),
(7, 'Robert Lee', 'robertlee@example.com', '9998765432', '741 Birch St', '1990-06-25'),
(8, 'Jennifer Davis', 'jenniferdavis@example.com', '7772345678', '963 Spruce St', '1987-04-12'),
(9, 'Christopher Anderson', 'christopheranderson@example.com', '8887654321', '852 Walnut St', '1998-08-08'),
(10, 'Amanda Martinez', 'amandamartinez@example.com', '3334567890', '159 Fir St', '1984-02-27'),
(11, 'Daniel Wilson', 'danielwilson@example.com', '2225678901', '357 Oak St', '1993-10-15'),
(12, 'Rachel Johnson', 'racheljohnson@example.com', '5559876543', '753 Elm St', '1981-08-22'),
(13, 'Matthew Thompson', 'matthewthompson@example.com', '4441234567', '951 Pine St', '1996-05-07'),
(14, 'Lauren Garcia', 'laurengarcia@example.com', '1113456789', '258 Maple St', '1989-01-02'),
(15, 'Joshua Davis', 'joshuadavis@example.com', '9992345678', '456 Cedar St', '1997-07-28'),
(16, 'Olivia Rodriguez', 'oliviarodriguez@example.com', '7774567890', '753 Birch St', '1986-03-15'),
(17, 'Andrew Martinez', 'andrewmartinez@example.com', '8888765432', '951 Spruce St', '1994-09-10'),
(18, 'Samantha Anderson', 'samanthaanderson@example.com', '3339876543', '258 Walnut St', '1983-05-25'),
(19, 'William Taylor', 'williamtaylor@example.com', '2222345678', '456 Fir St', '1991-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ing_id` int(11) NOT NULL,
  `ing_name` varchar(255) NOT NULL,
  `ing_imagepath` varchar(255) DEFAULT 'food_default.png',
  `ing_desc` text DEFAULT NULL,
  `ing_quantity` decimal(10,2) DEFAULT NULL,
  `ing_uom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ing_id`, `ing_name`, `ing_imagepath`, `ing_desc`, `ing_quantity`, `ing_uom`) VALUES
(1, 'Sugary', '1_647b8cbe6d343.jpeg', 'Common sweetener used in cooking and baking', 500.00, 'grams'),
(2, 'Salt', 'food_default.png', 'Essential seasoning for enhancing flavor', 250.00, 'grams'),
(3, 'Flour', 'food_default.png', 'Versatile ingredient for baking and cooking', 1000.00, 'grams'),
(4, 'Butter', 'food_default.png', 'Dairy product used for cooking and baking', 200.00, 'grams'),
(5, 'Olive Oil', 'food_default.png', 'Healthy cooking oil with a distinct flavor', 250.00, 'milliliters'),
(6, 'Onion', 'food_default.png', 'A versatile vegetable used as a flavor base', 3.00, 'pieces'),
(7, 'Garlic', 'food_default.png', 'A pungent bulb used to add flavor to dishes', 5.00, 'cloves'),
(8, 'Chicken Breast', 'food_default.png', 'Lean and versatile meat for various dishes', 500.00, 'grams'),
(9, 'Beef Steak', 'food_default.png', 'Tender and flavorful cut of beef', 2.00, 'pieces'),
(10, 'Pasta', 'food_default.png', 'Versatile staple ingredient for many Italian dishes', 500.00, 'grams'),
(11, 'Rice', 'food_default.png', 'A staple grain consumed worldwide', 1.00, 'kilogram'),
(12, 'Tomato', 'food_default.png', 'Commonly used in salads, sauces, and soups', 4.00, 'pieces'),
(13, 'Eggs', 'food_default.png', 'Versatile ingredient used in various recipes', 12.00, 'pieces'),
(14, 'Milk', 'food_default.png', 'Nutritious liquid used in cooking and baking', 1.00, 'liter'),
(15, 'Cheese', 'food_default.png', 'Dairy product with a wide range of flavors and textures', 250.00, 'grams'),
(16, 'Cucumber', 'food_default.png', 'Cool and refreshing vegetable used in salads', 3.00, 'pieces'),
(17, 'Lemon', 'food_default.png', 'Citrus fruit with a tangy flavor used in cooking and beverages', 2.00, 'pieces'),
(18, 'Honey', 'food_default.png', 'Natural sweetener with various culinary uses', 250.00, 'milliliters'),
(19, 'Vanilla Extract', 'food_default.png', 'Common flavoring agent used in baking', 1.00, 'teaspoon'),
(20, 'Baking Powder', 'food_default.png', 'Leavening agent used in baking', 1.00, 'tablespoon');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_paymentmethod` varchar(50) DEFAULT NULL,
  `order_details` varchar(255) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_status` enum('pending','completed','canceled') DEFAULT 'pending',
  `total_price` decimal(10,2) DEFAULT 0.00,
  `cus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_paymentmethod`, `order_details`, `order_date`, `order_status`, `total_price`, `cus_id`) VALUES
(17, 'Cash', 'Dine in', '2023-06-04', 'completed', 21.98, 4),
(18, 'Cash', 'Dine in', '2023-06-04', 'completed', 13.98, 6),
(19, 'Cash', 'Dine in', '2023-06-04', 'completed', 20.97, 4),
(20, 'Cash', 'Dine in', '2023-06-04', 'completed', 22.97, 4),
(21, 'Cash', 'Dine in', '2023-06-04', 'pending', 20.96, 3),
(23, 'Cash', 'Dine in', '2023-01-04', 'pending', 24.97, 8),
(24, 'Cash', 'Dine in', '2023-02-04', 'completed', 21.97, 16),
(25, 'Cash', 'Dine in', '2023-03-04', 'completed', 22.97, 13),
(26, 'Cash', 'Dine in', '2023-04-04', 'completed', 147.80, 3),
(27, 'Cash', 'Dine in', '2023-05-04', 'completed', 40.94, 9),
(28, 'Credit Card', 'Dine in', '2023-06-04', 'pending', 16.97, 16),
(29, 'eWallet', 'Dine in', '2023-06-04', 'pending', 21.97, 10),
(30, 'Credit Card', 'Dine in', '2023-01-04', 'pending', 34.97, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) DEFAULT NULL,
  `prod_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `prod_name`) VALUES
(17, 'Strawberry Cheesecake'),
(17, 'BBQ Ribs'),
(18, 'Chicken Noodle Soup'),
(18, 'Creme Brulee'),
(19, 'Cheeseburger'),
(19, 'Apple Pie'),
(19, 'Fruit Smoothie'),
(20, 'Apple Pie'),
(20, 'Fruit Smoothie'),
(20, 'Beef Stir-Fry'),
(21, 'Orange Juice'),
(21, 'Mango Smoothie'),
(21, 'Apple Pie'),
(21, 'Chicken Noodle Soup'),
(23, 'Orange Juice'),
(23, 'BBQ Ribs'),
(23, 'Creme Brulee'),
(24, 'Fish and Chips'),
(24, 'Mango Smoothie'),
(24, 'Apple Pie'),
(25, 'Strawberry Cheesecake'),
(25, 'Beef Stir-Fry'),
(25, 'Hot Chocolate'),
(26, 'Cheeseburger'),
(26, 'Iced Coffee'),
(26, 'Chocolate Cake'),
(26, 'Spaghetti Bolognese'),
(26, 'Orange Juice'),
(26, 'Strawberry Cheesecake'),
(26, 'Fish and Chips'),
(26, 'Mango Smoothie'),
(26, 'Apple Pie'),
(26, 'Chicken Caesar Salad'),
(26, 'Iced Tea'),
(26, 'Vanilla Ice Cream'),
(26, 'BBQ Ribs'),
(26, 'Mint Mojito'),
(26, 'Tiramisu'),
(26, 'Chicken Noodle Soup'),
(26, 'Fruit Smoothie'),
(26, 'Creme Brulee'),
(26, 'Beef Stir-Fry'),
(26, 'Hot Chocolate'),
(27, 'Spaghetti Bolognese'),
(27, 'Orange Juice'),
(27, 'Strawberry Cheesecake'),
(27, 'Chicken Noodle Soup'),
(27, 'Fruit Smoothie'),
(27, 'Creme Brulee'),
(28, 'Apple Pie'),
(28, 'Chicken Noodle Soup'),
(28, 'Hot Chocolate'),
(29, 'Apple Pie'),
(29, 'Beef Stir-Fry'),
(29, 'Hot Chocolate'),
(30, 'Cheeseburger'),
(30, 'Apple Pie'),
(30, 'BBQ Ribs'),
(30, 'Fruit Smoothie');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_imgpath` varchar(255) DEFAULT 'food_default.png',
  `prod_desc` varchar(255) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_imgpath`, `prod_desc`, `prod_price`, `cat_id`) VALUES
(21, 'Cheeseburger', '21_647cb0e1538a4.jpeg', 'Delicious beef patty topped with melted cheese', 9.00, 1),
(22, 'Iced Coffee', 'food_default.png', 'Chilled coffee beverage with milk and ice', 3.99, 2),
(23, 'Chocolate Cake', 'food_default.png', 'Moist and decadent chocolate cake', 7.99, 3),
(24, 'Spaghetti Bolognese', 'food_default.png', 'Pasta with meaty tomato sauce', 11.99, 1),
(25, 'Orange Juice', 'food_default.png', 'Freshly squeezed orange juice', 2.99, 2),
(26, 'Strawberry Cheesecake', 'food_default.png', 'Creamy cheesecake with strawberry topping', 6.99, 3),
(27, 'Fish and Chips', 'food_default.png', 'Crispy battered fish with fries', 10.99, 1),
(28, 'Mango Smoothie', 'food_default.png', 'Refreshing smoothie made with ripe mangoes', 4.99, 2),
(29, 'Apple Pie', 'food_default.png', 'Classic homemade apple pie with flaky crust', 5.99, 3),
(30, 'Chicken Caesar Salad', 'food_default.png', 'Romaine lettuce, grilled chicken, and Caesar dressing', 8.99, 1),
(31, 'Iced Tea', 'food_default.png', 'Cold brewed tea infused with flavors', 2.99, 2),
(32, 'Vanilla Ice Cream', 'food_default.png', 'Creamy vanilla-flavored ice cream', 4.99, 3),
(33, 'BBQ Ribs', 'food_default.png', 'Tender pork ribs glazed with barbecue sauce', 14.99, 1),
(34, 'Mint Mojito', 'food_default.png', 'Refreshing cocktail with mint, lime, and soda', 6.99, 2),
(35, 'Tiramisu', 'food_default.png', 'Italian dessert made with layers of coffee-soaked ladyfingers and mascarpone cream', 7.99, 3),
(36, 'Chicken Noodle Soup', 'food_default.png', 'Hearty soup with chicken, noodles, and vegetables', 6.99, 1),
(37, 'Fruit Smoothie', 'food_default.png', 'Blended mix of assorted fruits', 4.99, 2),
(38, 'Creme Brulee', 'food_default.png', 'Classic French dessert with a caramelized sugar crust', 6.99, 3),
(39, 'Beef Stir-Fry', 'food_default.png', 'Sliced beef with mixed vegetables in a savory sauce', 11.99, 1),
(40, 'Hot Chocolate', 'food_default.png', 'Rich and creamy chocolate beverage', 3.99, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Manager','Cashier','Chef','Waiter') NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `age` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `joined_date` date NOT NULL,
  `status` enum('Active','Not active') NOT NULL,
  `picture_path` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `email`, `password`, `role`, `fullname`, `address`, `phone_num`, `gender`, `age`, `birth_date`, `joined_date`, `status`, `picture_path`) VALUES
(1, 'admin@example.com', 'admin123', 'Admin', 'Admin User', 'Admin Address', '1234567890', 'Male', 30, '1993-01-01', '2020-01-01', 'Active', '1_647ce0374f33c.jpeg'),
(2, 'manager1@example.com', 'manager123', 'Manager', 'Manager 1', 'Manager 1 Address', '1111111111', 'Female', 35, '1988-05-15', '2020-02-01', 'Active', '2_647653762cd2b.jpg'),
(3, 'manager2@example.com', 'manager456', 'Manager', 'Manager 2', 'Manager 2 Address', '2222222222', 'Male', 40, '1983-09-20', '2021-03-01', 'Active', 'default.png'),
(4, 'manager3@example.com', 'manager789', 'Manager', 'Manager 3', 'Manager 3 Address', '3333333333', 'Female', 37, '1986-11-10', '2022-04-01', 'Active', 'default.png'),
(5, 'manager4@example.com', 'manager012', 'Manager', 'Manager 4', 'Manager 4 Address', '4444444444', 'Male', 32, '1989-07-25', '2022-05-01', 'Active', 'default.png'),
(6, 'manager5@example.com', 'manager345', 'Manager', 'Manager 5', 'Manager 5 Address', '5555555555', 'Female', 36, '1987-03-05', '2023-01-01', 'Active', 'default.png'),
(7, 'cashier1@example.com', 'cashier123', 'Cashier', 'Cashier 1', 'Cashier 1 Address', '1111111111', 'Male', 25, '1998-08-10', '2020-02-01', 'Active', 'default.png'),
(8, 'cashier2@example.com', 'cashier456', 'Cashier', 'Cashier 2', 'Cashier 2 Address', '2222222222', 'Female', 22, '2001-04-15', '2021-03-01', 'Active', 'default.png'),
(9, 'cashier3@example.com', 'cashier789', 'Cashier', 'Cashier 3', 'Cashier 3 Address', '3333333333', 'Male', 27, '1996-02-20', '2022-04-01', 'Active', 'default.png'),
(10, 'cashier4@example.com', 'cashier012', 'Cashier', 'Cashier 4', 'Cashier 4 Address', '4444444444', 'Female', 24, '1999-09-25', '2022-05-01', 'Active', 'default.png'),
(11, 'cashier5@example.com', 'cashier345', 'Cashier', 'Cashier 5', 'Cashier 5 Address', '5555555555', 'Male', 26, '1997-05-05', '2023-01-01', 'Active', 'default.png'),
(12, 'chef1@example.com', 'chef123', 'Chef', 'Chef 1', 'Chef 1 Address', '1111111111', 'Female', 28, '1995-10-10', '2020-02-01', 'Active', 'default.png'),
(13, 'chef2@example.com', 'chef456', 'Chef', 'Chef 2', 'Chef 2 Address', '2222222222', 'Male', 33, '1990-04-15', '2021-03-01', 'Active', 'default.png'),
(14, 'chef3@example.com', 'chef789', 'Chef', 'Chef 3', 'Chef 3 Address', '3333333333', 'Female', 30, '1993-02-20', '2022-04-01', 'Active', 'default.png'),
(15, 'chef4@example.com', 'chef012', 'Chef', 'Chef 4', 'Chef 4 Address', '4444444444', 'Male', 35, '1988-09-25', '2022-05-01', 'Active', 'default.png'),
(16, 'chef5@example.com', 'chef345', 'Chef', 'Chef 5', 'Chef 5 Address', '5555555555', 'Female', 32, '1991-05-05', '2023-01-01', 'Active', 'default.png'),
(17, 'waiter1@example.com', 'waiter123', 'Waiter', 'Waiter 1', 'Waiter 1 Address', '1111111111', 'Male', 23, '2000-11-10', '2020-02-01', 'Active', '17_647cdd533fe1c.jpeg'),
(18, 'waiter2@example.com', 'waiter456', 'Waiter', 'Waiter 2', 'Waiter 2 Address', '2222222222', 'Female', 20, '2003-06-15', '2021-03-01', 'Active', 'default.png'),
(19, 'waiter3@example.com', 'waiter789', 'Waiter', 'Waiter 3', 'Waiter 3 Address', '3333333333', 'Male', 25, '1998-04-20', '2022-04-01', 'Active', 'default.png'),
(20, 'waiter4@example.com', 'waiter012', 'Waiter', 'Waiter 4', 'Waiter 4 Address', '4444444444', 'Female', 22, '2001-11-25', '2022-05-01', 'Active', 'default.png'),
(21, 'waiter5@example.com', 'waiter345', 'Waiter', 'Waiter 5', 'Waiter 5 Address', '5555555555', 'Male', 24, '1999-07-05', '2023-01-01', 'Active', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ing_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

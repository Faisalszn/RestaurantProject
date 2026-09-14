-- Restaurant Project database schema
-- Import with: mysql -u root -p < database.sql

CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Default admin login: username "admin", password "admin123"
-- Change this password after first login.
INSERT INTO admins (username, password_hash) VALUES
    ('admin', '$2y$12$NNcGaDz09KDs795Tf83JfOpl2EFUxmsFE8WMFSnuXDnigGzVKkwN6')
ON DUPLICATE KEY UPDATE username = username;

CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) DEFAULT NULL
);

INSERT INTO menu_items (item_name, category, price, image) VALUES
    ('Salad', 'Appetizer', 5.00, 'photos/salad.jpg'),
    ('Soup', 'Appetizer', 4.00, 'photos/soup.jpg'),
    ('Garlic Bread', 'Appetizer', 3.00, 'photos/garlic_bread.jpg'),
    ('Steak', 'Main Course', 15.00, 'photos/steak.jpg'),
    ('Pasta', 'Main Course', 12.00, 'photos/pasta.jpg'),
    ('Burger', 'Main Course', 10.00, 'photos/burger.jpg'),
    ('Cake', 'Dessert', 6.00, 'photos/cake.jpg'),
    ('Ice Cream', 'Dessert', 4.00, 'photos/ice_cream.jpg'),
    ('Fruit Salad', 'Dessert', 5.00, 'photos/fruit_salad.jpg'),
    ('Tea', 'Drinks', 2.00, 'photos/tea.jpg'),
    ('Juice', 'Drinks', 3.00, 'photos/juice.jpg'),
    ('Water', 'Drinks', 1.00, 'photos/water.jpg');

-- JobYaari Portal - Hosting Setup (No Create Database)

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    module_type ENUM('job','admit_card','result','blog') NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE UNIQUE INDEX idx_categories_module_name ON categories(module_type, name);

CREATE TABLE IF NOT EXISTS content_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    module_type ENUM('job','admit_card','result','blog') NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    short_description TEXT NOT NULL,
    content LONGTEXT NOT NULL,
    category_id INT NOT NULL,
    featured_image VARCHAR(255) DEFAULT '',
    publish_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_items_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Initial Admin (Password: password)
INSERT INTO admins (name, email, password) VALUES 
('Admin', 'admin@jobyaari.com', '$2y$10$S9r00a/K.2k7L4kX9CqLDeM1hGf1fR.q8s.V7j0W1e2r3t4y5u6i7');

-- Sample Categories
INSERT IGNORE INTO categories (module_type, name) VALUES 
('blog', 'Admit Card'),
('blog', 'Answer Key'),
('blog', 'Calender'),
('blog', 'EXAM DATE'),
('blog', 'Information'),
('blog', 'Jobs'),
('blog', 'Result'),
('job', 'Engineering'),
('job', 'Banking');

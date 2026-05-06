CREATE DATABASE IF NOT EXISTS jobyaari_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jobyaari_portal;

-- Structure
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    module_type ENUM('job','admit_card','result','blog') NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

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
);

-- Seed Data
INSERT INTO admins (name, email, password) VALUES
('Super Admin', 'admin@jobyaari.com', '$2y$10$mA0gy2WnH70oxdVb9toonuwXANmvWswz1n4peBbwB0feIQavznDl2');

INSERT INTO categories (module_type, name) VALUES
('job', 'Graduate'),
('job', 'Engineering'),
('job', 'Banking'),
('admit_card', 'Exam Admit Card'),
('admit_card', 'Hall Ticket'),
('result', 'Board Result'),
('result', 'Exam Result'),
('blog', 'News'),
('blog', 'Technology');

INSERT INTO content_items (module_type, title, slug, short_description, content, category_id, featured_image, publish_date) VALUES
('job', 'UP Cooperative Bank Manager Recruitment 2026', 'up-cooperative-bank-manager-recruitment-2026', 'Apply for latest UP Cooperative Bank Manager vacancies with full eligibility details.', 'UP Cooperative Bank has released manager vacancies. Check education, age limit, fee, and apply dates before submission. Keep documents ready for verification.', 3, '', '2026-05-01'),
('job', 'SSC Stenographer Grade C D 2026', 'ssc-stenographer-grade-c-d-2026', 'Latest SSC Stenographer notification with important dates and exam pattern.', 'This notification includes exam schedule, syllabus, and category-wise eligibility. Candidates should verify region details and submit application early to avoid server rush.', 2, '', '2026-05-04'),
('admit_card', 'BPSC 71st Mains Admit Card 2026 Out', 'bpsc-71st-mains-admit-card-2026-out', 'BPSC mains admit card download link is now active.', 'Candidates can log in through official portal and download hall ticket using registration number and date of birth. Check center details carefully.', 4, '', '2026-05-03'),
('admit_card', 'NTA NCHM JEE Admit Card 2026', 'nta-nchm-jee-admit-card-2026', 'Download NCHM JEE hall ticket and verify exam instructions.', 'Students must carry valid photo ID and printed admit card. Reporting time and prohibited items are mentioned in official instructions.', 5, '', '2026-05-02'),
('result', 'UP Board Class 12th Result 2026 OUT', 'up-board-class-12th-result-2026-out', 'UP Board has declared class 12th results for all streams.', 'Students can check marksheet using roll number on official board website. Rechecking and compartment details will be announced shortly.', 6, '', '2026-05-05'),
('result', 'SSC CGL Final Result 2026', 'ssc-cgl-final-result-2026', 'SSC CGL final result released with merit list PDF.', 'Candidates can download merit list and check post allocation details. Document verification schedule will be notified in the coming weeks.', 7, '', '2026-05-04'),
('blog', 'NIELIT CCC Admit Card 2026 Out', 'nielit-ccc-admit-card-2026-out', 'Official update for NIELIT CCC May exam hall ticket.', 'The National Institute of Electronics and Information Technology has enabled admit card access for eligible candidates. Verify exam city and timing before print.', 8, '', '2026-05-06'),
('blog', 'Top 7 Tech Skills for Freshers', 'top-7-tech-skills-for-freshers', 'Most in-demand technology skills for internship and job applicants.', 'Employers prefer candidates with project-based understanding of frontend, backend, SQL, API integration, deployment, and Git workflows.', 9, '', '2026-05-05');

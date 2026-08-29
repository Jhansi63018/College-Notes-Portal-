CREATE DATABASE IF NOT EXISTS college_notes_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE college_notes_portal;

CREATE TABLE IF NOT EXISTS users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 username VARCHAR(60) NOT NULL UNIQUE,
 email VARCHAR(120) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 role ENUM('student','faculty','admin') NOT NULL DEFAULT 'student',
 status ENUM('active','inactive') NOT NULL DEFAULT 'active'
);

CREATE TABLE IF NOT EXISTS subjects (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(150) NOT NULL,
 course VARCHAR(80) NOT NULL,
 year VARCHAR(50) NOT NULL,
 semester VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS units (
 id INT AUTO_INCREMENT PRIMARY KEY,
 subject_id INT NOT NULL,
 unit_no INT NOT NULL,
 unit_name VARCHAR(180) NOT NULL,
 FOREIGN KEY(subject_id) REFERENCES subjects(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS materials (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(200) NOT NULL,
 subject_id INT NOT NULL,
 unit_id INT NULL,
 material_type ENUM('unit_notes','question_paper','important_questions','lab_material','reference_material') NOT NULL,
 description TEXT,
 file_name VARCHAR(255) NOT NULL,
 file_path VARCHAR(255) NOT NULL,
 uploaded_by INT NOT NULL,
 status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'approved',
 uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
 FOREIGN KEY(unit_id) REFERENCES units(id) ON DELETE SET NULL,
 FOREIGN KEY(uploaded_by) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS downloads (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 material_id INT NOT NULL,
 downloaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(material_id) REFERENCES materials(id) ON DELETE CASCADE
);

-- Demo accounts. Password for all three: password
-- These hashes are bcrypt hashes of "password".
INSERT IGNORE INTO users(name,username,email,password,role,status) VALUES
('Jhansi','student','student@example.com','$2y$12$Tv/r6wV.bDa28sc.dA642eoI0Mi3ve821FvaiYCAnCZHL3KPFIHDm','student','active'),
('Mr. Kumar','faculty','faculty@example.com','$2y$12$Tv/r6wV.bDa28sc.dA642eoI0Mi3ve821FvaiYCAnCZHL3KPFIHDm','faculty','active'),
('Admin','admin','admin@example.com','$2y$12$Tv/r6wV.bDa28sc.dA642eoI0Mi3ve821FvaiYCAnCZHL3KPFIHDm','admin','active');

INSERT INTO subjects(name,course,year,semester) SELECT 'Web Technologies','MCA','1st Year','1st Semester' WHERE NOT EXISTS (SELECT 1 FROM subjects WHERE name='Web Technologies');
SET @sid=(SELECT id FROM subjects WHERE name='Web Technologies' LIMIT 1);
INSERT INTO units(subject_id,unit_no,unit_name) SELECT @sid,1,'Introduction to HTML & CSS' WHERE NOT EXISTS (SELECT 1 FROM units WHERE subject_id=@sid AND unit_no=1);
INSERT INTO units(subject_id,unit_no,unit_name) SELECT @sid,2,'PHP Basics' WHERE NOT EXISTS (SELECT 1 FROM units WHERE subject_id=@sid AND unit_no=2);
INSERT INTO units(subject_id,unit_no,unit_name) SELECT @sid,3,'PHP Functions' WHERE NOT EXISTS (SELECT 1 FROM units WHERE subject_id=@sid AND unit_no=3);
INSERT INTO units(subject_id,unit_no,unit_name) SELECT @sid,4,'File Handling in PHP' WHERE NOT EXISTS (SELECT 1 FROM units WHERE subject_id=@sid AND unit_no=4);
INSERT INTO units(subject_id,unit_no,unit_name) SELECT @sid,5,'Forms & Validation' WHERE NOT EXISTS (SELECT 1 FROM units WHERE subject_id=@sid AND unit_no=5);

CREATE DATABASE IF NOT EXISTS learning_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE learning_system;

DROP TABLE IF EXISTS registrations;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(150) NOT NULL,
    role ENUM('student','teacher','admin') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    credits INT NOT NULL DEFAULT 3,
    capacity INT NOT NULL DEFAULT 40,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_registration (user_id, course_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

INSERT INTO users (username,password,name,role) VALUES
('student', '$2y$12$78ps/QTvd2XFWofUIDENvexqaZpWeTAZGJhEq4C7VhQ2k9yn2XX1a', 'ศุภนัฐ จันทร์เปรม', 'student'),
('teacher', '$2y$12$78ps/QTvd2XFWofUIDENvexqaZpWeTAZGJhEq4C7VhQ2k9yn2XX1a', 'อาจารย์ผู้สอน', 'teacher'),
('admin', '$2y$12$78ps/QTvd2XFWofUIDENvexqaZpWeTAZGJhEq4C7VhQ2k9yn2XX1a', 'ผู้ดูแลระบบ', 'admin');

INSERT INTO courses (code,name,description,credits,capacity) VALUES
('7203306','การพัฒนาเว็บ','พื้นฐาน HTML CSS JavaScript และ PHP',3,40),
('7203307','ฐานข้อมูล','การออกแบบฐานข้อมูลและการใช้งาน MySQL',3,40),
('7203308','การเขียนโปรแกรม','แนวคิดการเขียนโปรแกรมและการแก้ปัญหา',3,40),
('7203309','ความปลอดภัยคอมพิวเตอร์','พื้นฐานความปลอดภัยของระบบสารสนเทศ',3,35);

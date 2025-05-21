-- Create database
CREATE DATABASE IF NOT EXISTS `college`;
USE `college`;

-- Create tables
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `professors` (
  `professor_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`professor_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `professor_dept_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `credits` int(11) NOT NULL DEFAULT 3,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `department_id` (`department_id`),
  KEY `professor_id` (`professor_id`),
  CONSTRAINT `course_dept_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `course_prof_fk` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data
INSERT INTO `departments` (`name`, `location`, `description`) VALUES
('Computer Science', 'Building A, Floor 3', 'Department of Computer Science and Informatics'),
('Mathematics', 'Building B, Floor 2', 'Department of Mathematical Sciences'),
('Physics', 'Building C, Floor 1', 'Department of Physics and Astronomy');

INSERT INTO `professors` (`department_id`, `name`, `email`, `specialty`) VALUES
(1, 'Dr. John Smith', 'john.smith@college.edu', 'Software Engineering'),
(1, 'Dr. Sarah Johnson', 'sarah.johnson@college.edu', 'Artificial Intelligence'),
(2, 'Dr. Michael Brown', 'michael.brown@college.edu', 'Applied Mathematics'),
(3, 'Dr. Emily Davis', 'emily.davis@college.edu', 'Quantum Physics');

INSERT INTO `courses` (`department_id`, `professor_id`, `title`, `code`, `credits`, `description`) VALUES
(1, 1, 'Introduction to Programming', 'CS101', 3, 'Basic programming concepts and problem solving'),
(1, 2, 'Artificial Intelligence', 'CS401', 4, 'Machine learning and AI systems'),
(2, 3, 'Calculus I', 'MATH201', 3, 'Limits, derivatives and integrals'),
(3, 4, 'Physics for Engineers', 'PHYS301', 4, 'Applied physics for engineering students');
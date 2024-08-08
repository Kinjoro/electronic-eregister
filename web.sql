/* create the database*/
CREATE DATABASE studentdb

/* create the students table*/

CREATE TABLE students (
  id INT AUTO_INCREMENT,
  registration_number VARCHAR(20) NOT NULL,
  school_email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  confirm_password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY (registration_number),
  UNIQUE KEY (school_email)
);

/*insert students credentials*/
INSERT INTO `students` (`id`, `registration_number`, `school_email`, `phone_number`, `password`, `confirm_password`, `role`, `created_at`, `updated_at`) 
VALUES ('1', 'INTE/MG/3073/09/20', 'snnjoroge@kabarak.ac.ke', '0719788013', 'student@123', 'student@123', 'student', current_timestamp(), current_timestamp());


CREATE TABLE admins (
  id INT AUTO_INCREMENT,
  school_email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role BOOLEAN (5) DEFAULT ADMIN NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY (school_email)
)

ALTER TABLE `admins` ADD `role` VARCHAR(5) NOT NULL DEFAULT 'admin' AFTER `password`;

/*insert an admin credentials*/
INSERT INTO `admins` (`id`, `school_email`, `phone_number`, `password`, `role`, `created_at`, `updated_at`) 
VALUES ('1', 'admin@kabarak.ac.ke', '0719788013', 'admin@123', 'admin', current_timestamp(), current_timestamp());


/* create the laptops table*/
CREATE TABLE laptops (
  id INT AUTO_INCREMENT,
  laptop_name VARCHAR(50) NOT NULL,
  laptop_model VARCHAR(50) NOT NULL,
  laptop_serial_number VARCHAR(50) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

/* create the laptops_signouts table*/

CREATE TABLE laptop_signouts (
  id INT AUTO_INCREMENT,
  student_id INT NOT NULL,
  laptop_id INT NOT NULL,
  signout_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  signin_timestamp TIMESTAMP NULL,
  `signout_status` enum('out', 'in') NOT NULL DEFAULT 'out',
  PRIMARY KEY (id),
  FOREIGN KEY (student_id) REFERENCES students(id),
  FOREIGN KEY (laptop_id) REFERENCES laptops(id)
);

/*insert data*/
INSERT INTO `laptop_signouts` (`id`, `student_id`, `laptop_id`, `signout_timestamp`, `signin_timestamp`, `signout_status`)
 VALUES (NULL, '1', '2', current_timestamp(), NULL, 'in');
/* create the laptops_signins table*/

CREATE TABLE laptop_signouts (
  id INT AUTO_INCREMENT,
  student_id INT NOT NULL,
  laptop_id INT NOT NULL,
  signout_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  signin_timestamp TIMESTAMP NULL,
  signin BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (id),
  FOREIGN KEY (student_id) REFERENCES students(id),
  FOREIGN KEY (laptop_id) REFERENCES laptops(id)
);

INSERT INTO `laptop_signins` (`id`, `student_id`, `laptop_id`, `signout_timestamp`, `signin_timestamp`, `signin`)
 VALUES (NULL, '1', '6', current_timestamp(), NULL, '0');
/* insert sample data into the laptops table*/

INSERT INTO laptops (laptop_name, laptop_model, laptop_serial_number) VALUES
  ('Laptop 1', 'Dell Inspiron', 'ABC123'),
  ('Laptop 2', 'HP Envy', 'DEF456'),
  ('Laptop 3', 'Apple MacBook', 'GHI789');


/* insert sample data into the laptop_signouts table*/
INSERT INTO laptop_signouts (student_id, laptop_id) VALUES
  (1, 1),  // John Doe signs out Laptop 1
  (2, 2),  // Jane Smith signs out Laptop 2
  (3, 3);  // Bob Johnson signs out Laptop 3






  /*additional tables*/
CREATE TABLE `laptops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `status` enum('in', 'out') NOT NULL DEFAULT 'out',
  PRIMARY KEY (`id`),
  UNIQUE KEY `serial_number` (`serial_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `school_email` varchar(100) NOT NULL,
  `role` enum('admin', 'student') NOT NULL DEFAULT 'student',
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_number` (`registration_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `laptop_checkouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laptop_serial_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkout_date` datetime NOT NULL,
  `checkin_date` datetime DEFAULT NULL,
  `checkout_status` enum('out', 'in') NOT NULL DEFAULT 'out',
  PRIMARY KEY (`id`),
  KEY `laptop_serial_number` (`laptop_serial_number`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_laptop_checkout_laptop` FOREIGN KEY (`laptop_serial_number`) REFERENCES `laptops` (`serial_number`),
  CONSTRAINT `fk_laptop_checkout_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `laptop_checkins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laptop_serial_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime DEFAULT NULL,
  `checkout_status` enum('out', 'in') NOT NULL DEFAULT 'in',
  PRIMARY KEY (`id`),
  KEY `laptop_serial_number` (`laptop_serial_number`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_laptop_checkin_laptop` FOREIGN KEY (`laptop_serial_number`) REFERENCES `laptops` (`serial_number`),
  CONSTRAINT `fk_laptop_checkin_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `users` (`id`, `registration_number`, `password`, `name`, `school_email`, `role`)
 VALUES (NULL, 'INTE/MG/3073/09/20', 'student@123', 'Stephen', 'snnjoroge@kabarak.ac.ke', 'student');


 CREATE TABLE library_log (
  id INT AUTO_INCREMENT,
  student_id INT,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  action enum('enter', 'exit') NOT NULL DEFAULT 'enter',
  PRIMARY KEY (id),
  FOREIGN KEY (student_id) REFERENCES students(id)
);





/*additional tables*/

CREATE TABLE students (
    id INT PRIMARY KEY,
    registration_number VARCHAR(255),
    school_email VARCHAR(255),
    password VARCHAR(255)
    confirm_password VARCHAR(255)
);

CREATE TABLE laptop_signouts (
    id INT PRIMARY KEY,
    student_id INT,
    laptop_serial_number INT,
    checkin_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    signin_date TIMESTAMP DEFAULT NULL,
    signout_status ENUM('out', 'in') DEFAULT 'out',
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (laptop_serial_number) REFERENCES laptops(laptop_serial_number)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
);
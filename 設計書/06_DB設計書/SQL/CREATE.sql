CREATE TABLE `user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `name_read` VARCHAR(150) NOT NULL, 
    `nick_name` VARCHAR(50) NOT NULL,
    `mail` VARCHAR(50) NOT NULL UNIQUE,
    `pass` CHAR(60) NOT NULL, 
    `tel` VARCHAR(50) NOT NULL,
    `post` VARCHAR(50),
    `address` VARCHAR(80),
    `sale_count` INT DEFAULT 0,
    `penalty` INT DEFAULT 0,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME
);

CREATE TABLE `card` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `code` VARCHAR(19) NOT NULL UNIQUE,
    `month` CHAR(2) NOT NULL, 
    `year` CHAR(2) NOT NULL,
    `security` VARCHAR(19) NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) 
);

CREATE TABLE `item` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `name` VARCHAR(50),
    `image` CHAR(17) NOT NULL,
    `price` INT,
    `quality` INT(1),
    `delivery_fee` INT(1) NOT NULL,
    `delivery_days` INT(1) NOT NULL,
    `description` TEXT,
    `comment_count` INT DEFAULT 0,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    `start` DATETIME,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `order` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `item_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `card_id` INT,
    `post` VARCHAR(50) NOT NULL,
    `address` VARCHAR(80) NOT NULL,
    `send` DATETIME,
    `recived` DATETIME,
    `completion` DATETIME,
    `stop` DATETIME,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`item_id`) REFERENCES `item`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `item_comment` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `item_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `contents` TEXT NOT NULL,
    `passive` BOOLEAN NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

CREATE TABLE `order_comment` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `order_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `contents` TEXT NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    FOREIGN KEY (`order_id`) REFERENCES `order`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `item_comment_report` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
   	`item_comment_id` INT NOT NULL,
	`user_id` INT NOT NULL,
    `reason` VARCHAR(50),
    `contents` VARCHAR(255) NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    FOREIGN KEY (`item_comment_id`) REFERENCES `item_comment` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

CREATE TABLE `order_comment_report` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
   	`order_comment_id` INT NOT NULL,
	`user_id` INT NOT NULL,
    `reason` VARCHAR(50),
    `contents` VARCHAR(255) NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    FOREIGN KEY (`order_comment_id`) REFERENCES `order_comment`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

CREATE TABLE `item_report` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
   	`item_id` INT NOT NULL,
	`user_id` INT NOT NULL,
    `reason` VARCHAR(50),
    `contents` VARCHAR(255) NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    FOREIGN KEY (`item_id`) REFERENCES `item`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `info` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
   	`user_id` INT NOT NULL,
	`name` VARCHAR(50) NOT NULL,
    `contents` VARCHAR(200),
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);


CREATE TABLE `penalty` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
   	`user_id` INT NOT NULL,
	`add_points` INT DEFAULT 0,
    `all_points` INT DEFAULT 0,
    `name` VARCHAR(50) NOT NULL,
    `contents` VARCHAR(200) NOT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

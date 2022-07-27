CREATE DATABASE IF NOT EXISTS `partnerships` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'treend' IDENTIFIED BY 'secret_treend';
GRANT ALL PRIVILEGES ON partnerships.* TO 'treend'@'%';
FLUSH PRIVILEGES;


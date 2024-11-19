CREATE DATABASE borisov;
USE borisov;

CREATE TABLE accounts ( -- Создание таблицы, для которой будут отслеживаться изменения.
	login NVARCHAR(16) PRIMARY KEY CHECK(login != ''),
	password_hash_md5 CHAR(32) NOT NULL,
	email VARCHAR(255),
	phone VARCHAR(15),
	last_ipv4 VARCHAR(15) NOT NULL,
	last_seen DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE accounts_insert_log ( -- Создание таблицы для хранения записей изменений после использования INSERT.
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    login NVARCHAR(16),
	password_hash_md5 CHAR(32),
    email VARCHAR(255),
    phone VARCHAR(15),
    last_ipv4 VARCHAR(15),
    last_seen DATETIME,
    operation_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //
CREATE TRIGGER accounts_insert AFTER INSERT ON accounts FOR EACH ROW BEGIN -- Создание триггера INSERT.
    INSERT INTO accounts_insert_log (
		login,
		password_hash_md5,
		email,
		phone,
		last_ipv4,
		last_seen
	)
    VALUES (
		NEW.login,
		NEW.password_hash_md5,
		NEW.email,
		NEW.phone,
		NEW.last_ipv4,
		NEW.last_seen
	);
END;//
DELIMITER ;

CREATE TABLE accounts_update_log (  -- Создание таблицы для хранения записей изменений после использования UPDATE.
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    login NVARCHAR(16),
	old_password_hash_md5 CHAR(32),
	new_password_hash_md5 CHAR(32),
    old_email VARCHAR(255),
    new_email VARCHAR(255),
    old_phone VARCHAR(15),
    new_phone VARCHAR(15),
    old_last_ipv4 VARCHAR(15),
    new_last_ipv4 VARCHAR(15),
    old_last_seen DATETIME,
    new_last_seen DATETIME,
    operation_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //
CREATE TRIGGER accounts_update AFTER UPDATE ON accounts FOR EACH ROW BEGIN -- Создание триггера UPDATE.
    INSERT INTO accounts_update_log (
        login,
		old_password_hash_md5, 
        old_email, new_email, new_password_hash_md5,
        old_phone, new_phone,
        old_last_ipv4, new_last_ipv4,
        old_last_seen, new_last_seen
    )
    VALUES (
        OLD.login,
		OLD.password_hash_md5, NEW.password_hash_md5,
		OLD.email, NEW.email,
        OLD.phone, NEW.phone,
        OLD.last_ipv4, NEW.last_ipv4,
        OLD.last_seen, NEW.last_seen
    );
END;//
DELIMITER ;

CREATE TABLE accounts_delete_log ( -- Создание таблицы для хранения записей изменений после использования DELETE.
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    login NVARCHAR(16),
	password_hash_md5 CHAR(32),
    email VARCHAR(255),
    phone VARCHAR(15),
    last_ipv4 VARCHAR(15),
    last_seen DATETIME,
    operation_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //
CREATE TRIGGER accounts_delete AFTER DELETE ON accounts FOR EACH ROW BEGIN -- Создание триггера DELETE.
    INSERT INTO accounts_delete_log (
		login,
		password_hash_md5,
		email,
		phone,
		last_ipv4,
		last_seen
	)
    VALUES (
		OLD.login,
		OLD.password_hash_md5,
		OLD.email,
		OLD.phone,
		OLD.last_ipv4,
		OLD.last_seen
	);
END;//
DELIMITER ;
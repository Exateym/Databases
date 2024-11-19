USE tolbridan_database;

CREATE TABLE data_about_users
(
	nickname NVARCHAR(16) PRIMARY KEY CHECK(nickname != '' AND LENGTH(nickname) > 2 AND nickname REGEXP '^[A-Za-z0-9 _]+$'),
	password_hash CHAR(32) NOT NULL, -- MD5 хэш состоит из 32 символов
	email VARCHAR(255) CHECK(email REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$'),
	phone VARCHAR(15) CHECK(phone REGEXP '^\\+?[0-9]{10,15}$'),
	last_ipv4 VARCHAR(15) CHECK(last_ipv4 REGEXP '^(\\d{1,3}\\.){3}\\d{1,3}$') NOT NULL,
	last_seen DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE position_of_players
(
	nickname NVARCHAR(16) PRIMARY KEY,
	FOREIGN KEY (nickname) REFERENCES data_about_users(nickname) ON DELETE CASCADE,
	dimention VARCHAR(33) NOT NULL CHECK(LOCATE(':', dimention) > 0 AND LENGTH(dimention) - LENGTH(REPLACE(dimention, ':', '')) = 1),
	x REAL NOT NULL,
	y REAL NOT NULL,
	z REAL NOT NULL,
	rotation_one FLOAT CHECK(rotation_one >= -180 AND rotation_one <= 180) DEFAULT 0,
	rotation_two FLOAT CHECK(rotation_two >= -90 AND rotation_two <= 90) DEFAULT 0
);
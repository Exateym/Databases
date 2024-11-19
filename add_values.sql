USE tolbridan_database;

INSERT INTO data_about_users (nickname, password_hash, last_ipv4)
VALUES ('Gaukologic', MD5('eblan228'), '178.91.98.132');

INSERT INTO position_of_players (nickname, dimention, x, y, z)
VALUES ('Gaukologic', 'minecraft:overworld', 6.5, 69, 23.5);
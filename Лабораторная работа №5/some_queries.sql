USE borisov;

INSERT INTO accounts (login, password_hash_md5, last_ipv4) VALUES
('Exateym', MD5('12345'), '10.242.58.193'),
('Тубрик', MD5('54321'), '192.168.0.1');

INSERT INTO accounts (login, password_hash_md5, email, phone, last_ipv4) VALUES
('Gaukologic', MD5('password'), 'gaukologic@email.post', '100200300', '178.89.243.66'),
('Егор', MD5('пароль'), 'bibub@parrot.dox', '400500600', '10.242.200.120');

UPDATE accounts SET email = 'exateym@newmail.com', phone = '987654321' WHERE login = 'Exateym'; -- Изменение email и phone.

UPDATE accounts SET last_ipv4 = '255.255.255.0' WHERE login = 'Gaukologic'; -- Изменение last_ipv4.

UPDATE accounts SET last_seen = NOW(), phone = '123456789' WHERE login = 'Егор'; -- Изменение last_seen и phone.

DELETE FROM accounts WHERE login = 'Тубрик';

DELETE FROM accounts WHERE login = 'Gaukologic';
CREATE DATABASE IF NOT EXISTS lemming;
-- DROP DATABASE lemming;
SHOW DATABASES;
SHOW TABLES;

USE lemming;

CREATE TABLE IF NOT EXISTS `admin` (
idAdmin INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
admin_name VARCHAR(20) NOT NULL,
admin_second_name VARCHAR(20) NOT NULL,
admin_surname VARCHAR(25) NOT NULL,
admin_login VARCHAR(20) NOT NULL,
admin_pwd VARCHAR(250) NOT NULL
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

-- DROP TABLE `admin`;

INSERT INTO `admin` (admin_name, admin_second_name, admin_surname, admin_login, admin_pwd) 
VALUES ("Иван", "Николаевич", "Гороховский", "admin", "$2y$10$K4irzVXuFo8LAFCWJARyvugCjIDScKFUlcGbOt4oavyjkirPSz6xu");
-- DELETE FROM `admin` WHERE idAdmin > 0;
SELECT * FROM `admin`;

CREATE TABLE IF NOT EXISTS users (
idUser INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_name VARCHAR(20) NOT NULL,
user_second_name VARCHAR(20) NOT NULL,
user_surname VARCHAR(25) NOT NULL,
user_birthdate DATETIME,
user_city VARCHAR(50) NOT NULL,
user_phone VARCHAR(20) NOT NULL,
user_contract VARCHAR(50),
user_spec VARCHAR(50) NOT NULL,
user_spec_level INT,
user_postion VARCHAR(50) NOT NULL,
user_contract_begin DATETIME,
user_contract_end DATETIME,
user_login VARCHAR(20) NOT NULL,
user_pwd VARCHAR(250) NOT NULL
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

INSERT INTO users (user_name, user_second_name, user_surname, user_birthdate, user_city, user_phone, user_contract, user_spec, user_spec_level, user_postion, user_contract_begin, user_login, user_pwd)
VALUES ("Антон", "Борисович", "Вьюгин", "1986-03-19", "Калуга", "89110357845", "ЛГ-001", "Сварщик", 3, "рабочий", "2020-01-19", "a.vugin", "$2y$10$.qFt6ksDn5Nq5zHvdTcLuuV60YcBnyHKbLC1HX9F.2MsbaB15rDxq");
INSERT INTO users (user_name, user_second_name, user_surname, user_birthdate, user_city, user_phone, user_contract, user_spec, user_spec_level, user_postion, user_contract_begin, user_login, user_pwd)
VALUES ("Борис", "Викторович", "Греков", "1987-04-20", "Санкт-Петербург", "8411078781", "ЛГ-002", "Монтажник", 5, "бригадир", "2020-01-15", "b.grekov", "$2y$10$0rv5BriSys47IgR2SsJ3pOgr2K/S9b0HEWu/tvpNrWOoJis7azcyK");

-- DELETE FROM users WHERE idUser > 0;

SELECT * FROM users;
UPDATE users SET user_contract_end = '2021-01-19'  WHERE idUser=1;
UPDATE users SET user_contract_end = '2021-01-15'  WHERE idUser=2;
SELECT * FROM users WHERE user_login = 'b.grekov';
-- DROP TABLE user_trip;

CREATE TABLE IF NOT EXISTS user_trip (
idUserTrip INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idUser INT NOT NULL,
idProject INT NOT NULL,
city VARCHAR(250),
ticket_date DATETIME,
ticket VARCHAR(250),
CONSTRAINT trip_user
FOREIGN KEY (idUser)
REFERENCES users(idUser)
ON DELETE CASCADE,
CONSTRAINT trip_proj
FOREIGN KEY (idProject)
REFERENCES projects(idProject)
ON DELETE CASCADE
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';



INSERT INTO user_trip (idUser, idProject, city, ticket_date) VALUES (1, 1, "Липецк", "2020-01-25");
INSERT INTO user_trip (idUser, idProject, city, ticket_date) VALUES (2, 1, "Липецк", "2020-01-25");
INSERT INTO user_trip (idUser, idProject, city, ticket_date) VALUES (1, 1, "Калуга", "2020-01-28");
INSERT INTO user_trip (idUser, idProject, city, ticket_date) VALUES (2, 1, "Санкт-Петербург", "2020-01-30");

-- DROP TABLE user_trip;
SELECT * FROM user_trip;
DELETE FROM user_trip WHERE idUserTrip = 6;
UPDATE user_trip SET ticket = null WHERE idUserTrip = 1;

SELECT user_trip.idUserTrip, user_trip.idUser, user_trip.city, user_trip.idProject, user_trip.ticket_date,
      user_trip.ticket, projects.proj_name, projects.comp_name, projects.proj_city
      FROM user_trip
      LEFT JOIN users ON user_trip.idUser = users.idUser
      LEFT JOIN projects ON user_trip.idProject = projects.idProject
      WHERE users.user_login = "b.grekov"
      ORDER BY user_trip.ticket_date DESC;


CREATE TABLE IF NOT EXISTS user_vacation (
idUserVacation INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idUser INT NOT NULL,
date_begin DATETIME,
date_end DATETIME,
CONSTRAINT vacation_user
FOREIGN KEY (idUser)
REFERENCES users(idUser)
ON DELETE CASCADE
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

INSERT INTO user_vacation (idUser, date_begin, date_end) VALUES (1, "2020-02-15", "2020-02-28");
INSERT INTO user_vacation (idUser, date_begin, date_end) VALUES (2, "2020-03-25", "2020-04-05");

CREATE TABLE IF NOT EXISTS user_med_cert (
idUserMedCert INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idUser INT NOT NULL,
date_begin DATETIME,
date_end DATETIME,
CONSTRAINT med_cert_user
FOREIGN KEY (idUser)
REFERENCES users(idUser)
ON DELETE CASCADE
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

INSERT INTO user_med_cert (idUser, date_begin, date_end) VALUES (1, "2020-03-05", "2020-03-07");

CREATE TABLE IF NOT EXISTS services (
idService INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
serv_name VARCHAR(80) NOT NULL,
serv_desc VARCHAR(300) NOT NULL,
serv_pic VARCHAR(250) NOT NULL
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

INSERT INTO services (serv_name, serv_desc, serv_pic) VALUES ("Монтаж",
  "Силами наших специалистов могут быть выполнены монтаж металлоконструкций, трубопроводов, вентиляции и проведение необходимых испытаний.", "assemb.jpg");
  INSERT INTO services (serv_name, serv_desc, serv_pic) VALUES ("Демонтаж",
  "Работы по разборке промышленных линий и снятию оборудования выполняются с полной сохранностью демонтируемых станков и агрегатов.", "disassemb.jpg");
  INSERT INTO services (serv_name, serv_desc, serv_pic) VALUES ("Такелаж",
  "Наш опыт и техническое оснащение позволяют перегружать, перемещать, разворачивать и кантовать тяжеловесное оборудование с максимальной точностью.", "rigging.jpeg");

CREATE TABLE IF NOT EXISTS projects (
idProject INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
proj_name VARCHAR(250) NOT NULL,
proj_city VARCHAR(50) NOT NULL,
proj_desc TEXT NOT NULL,
proj_date_begin DATETIME,
proj_date_end DATETIME,
proj_contract VARCHAR(50),
comp_name VARCHAR(50) NOT NULL,
comp_logo VARCHAR(250),
proj_pic VARCHAR(250),
proj_on_site VARCHAR(10) NOT NULL
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

INSERT INTO projects (proj_name, proj_city, proj_desc, proj_date_begin, proj_date_end, proj_on_site, comp_name, comp_logo, proj_pic) VALUES ("Монтаж емкостей и трубопроводов картоноделательной машины",
"Липецк", "Монтаж под ключ емкостей и трубопроводов размольно-подготовительного отделения и участка массоподготовки новой картоноделательной машины. Проект включал монтаж различного технологического оборудования французского производителя KADANT. Опыт подрядчика позволил заказчику сократить сроки запуска КДМ № 2 в эксплуатацию.",
 "2020-01-25", "2020-01-28", "да", "Л-ПАК", "comp_logo1.jpg", "pr1.jpg");
INSERT INTO projects (proj_name, proj_city, proj_desc, proj_date_begin, proj_date_end, proj_on_site, comp_name, comp_logo, proj_pic) VALUES ("Монтаж автоматической линии резиносмешения",
  "Екатеринбург", "Монтаж под ключ автоматической линии резиносмешения и проведение пуско-наладочных работ.", "2020-04-03", "2020-04-12", "да", "УЗКЛ", "comp_logo2.jpg", "pr2.jpg");
INSERT INTO projects (proj_name, proj_city, proj_desc, proj_date_begin, proj_date_end, proj_on_site, comp_name, comp_logo, proj_pic) VALUES ("Демонтаж и монтаж технологического оборудования по производству керамогранитной плитки",
  "Самара", "Демонтаж, такелажные работы по перемещению оборудования и монтаж технологической линии на производстве керамической плитки без остановки.", "2020-04-15", "2020-04-19", 'да', "Самарский Стройфарфор", "comp_logo3.jpg", "pr3.jpg");
  INSERT INTO projects (proj_name, proj_city, proj_desc, proj_date_begin, proj_date_end, proj_on_site, comp_name, comp_logo, proj_pic) VALUES ("Такелаж низуовольтного оборудования на территории завода",
  "Самара", "Такелаж низуовольтного оборудования на территории завода.", "2020-03-02", "2020-03-19", "нет", "Самарский Стройфарфор", "comp_logo3.jpg", "pr2.jpg");

DELETE FROM projects WHERE idProject = 1;
DROP TABLE projects;
SELECT * FROM projects;

CREATE TABLE IF NOT EXISTS project_service (
idProject INT NOT NULL,
idService INT NOT NULL,
CONSTRAINT pr_incl_serv
FOREIGN KEY (idProject)
REFERENCES project(idProject)
ON DELETE CASCADE,
CONSTRAINT serv_in_proj
FOREIGN KEY (idService)
REFERENCES service(idService)
ON DELETE CASCADE
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

CREATE TABLE IF NOT EXISTS `clients` (
idClient INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
client_name VARCHAR(20) NOT NULL,
surname VARCHAR(40),
phone VARCHAR(20) NOT NULL,
e_mail VARCHAR(40) NOT NULL,
request TEXT,
client_date DATETIME
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

INSERT INTO clients (client_name, surname, phone, e_mail, request, client_date)
VALUES ('Андрюс', 'Мамонтовас', '89110551785', 'av@ng.com', 'Монтаж линии изготовления туалетной бумаги', CURDATE());
INSERT INTO clients (client_name, surname, phone, e_mail, request, client_date)
VALUES ('Петр', 'Денисов', '89192334897', 'pd@fhjgsg.com', 'Запрос 2', CURDATE());
INSERT INTO clients (client_name, surname, phone, e_mail, request, client_date)
VALUES ('Инна', 'Попова', 89192334897, 'inna@comp.com', 'Перемещение печи на территории завода', CURDATE());
INSERT INTO clients (client_name, surname, phone, e_mail, request, client_date)
VALUES ('Артур', 'Джабрелян', 84589623485, 'arty@comp.com', 'Запрос5', CURDATE());

SELECT * FROM clients;

SELECT DATE_FORMAT(client_date,'%d.%m.%Y') as client_date FROM clients;

CREATE TABLE IF NOT EXISTS company (
idCompany INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
comp_pic VARCHAR(250),
idProject INT NOT NULL,
idClient INT,
CONSTRAINT client_company
FOREIGN KEY (idClient)
REFERENCES clients(idClient)
ON DELETE CASCADE,
CONSTRAINT comp_has_proj
FOREIGN KEY (idProject)
REFERENCES project(idProject)
ON DELETE CASCADE
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

CREATE TABLE IF NOT EXISTS news (
idNews INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
news_name VARCHAR(250) NOT NULL,
news_desc VARCHAR(400),
news_date DATETIME,
idProject INT,
CONSTRAINT news_proj
FOREIGN KEY (idProject)
REFERENCES projects(idProject)
ON DELETE CASCADE
)ENGINE=InnoDB
DEFAULT CHARSET='utf8mb4';

-- DROP TABLE news;

INSERT INTO news (news_name, news_desc, news_date) VALUES ("Передислокация флексографической машины",
 "Демонтаж, перевезка и монтаж на новом месте флексографическую печатную машину общей массой 60 тонн. Проект выполнен по заказу крупнейшего в Краснодаре производителя бумажной упаковки для пищевых и непищевых продуктов.", "2020-04-12");
INSERT INTO news (news_name, news_desc, news_date) VALUES ("Монтаж прессовой линии для крупногабаритной штамповки",
  "Смонтирована прессовая линия крупногабаритной штамповки на заводе по выпуску легковых автомобилей в Тульской области.", "2020-05-23");
INSERT INTO news (news_name, news_desc, news_date) VALUES ("Демонтаж центробежной дробилки",
  "Демонтаж центробежной дробилки на пердприятии горно-обогатительного производства в Первоуральске.", "2020-03-09");
INSERT INTO news (news_name, news_desc, news_date) VALUES ("Монтаж линии изготовления алюминиевых банок",
    "Монтаж линии производства алюминиевых банок в Нарофоминске.", "2020-02-01");

SELECT * FROM news ORDER BY news_date DESC;
-- DELETE FROM news WHERE idNews > 4;
-- таблица командировок

CREATE DATABASE emensawerbeseite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE emensawerbeseite;

CREATE TABLE gericht (
                         id int8 primary key,
                         name VARCHAR(80) NOT NULL UNIQUE ,
                         beschreibung VARCHAR(800) NOT NULL ,
                         erfasst_am DATE NOT NULL ,
                         vegetarisch BOOLEAN DEFAULT 0 NOT NULL ,
                         vegan BOOLEAN DEFAULT 0 NOT NULL ,
                         preis_intern DOUBLE NOT NULL CHECK ( preis_intern > 0 ),
                         preis_extern DOUBLE CHECK ( preis_extern > preis_intern )
);

CREATE TABLE allergen(
                         code CHAR(4) PRIMARY KEY ,
                         name VARCHAR(300) NOT NULL ,
                         typ VARCHAR(20) DEFAULT 'allergen' NOT NULL
);

CREATE TABLE kategorie (
                           id int8 PRIMARY KEY ,
                           name VARCHAR(80) NOT NULL ,
                           eltern_id int8 REFERENCES kategorie(id),
                           bildname VARCHAR(200)
);

create table gericht_hat_allergen(
                                     code CHAR(4) REFERENCES allergen(code),
                                     gericht_id int8 NOT NULL REFERENCES gericht(id)
);

CREATE TABLE gericht_hat_kategorie (
                                       gericht_id int8 NOT NULL REFERENCES gericht(id),
                                       kategorie_id int8 NOT NULL REFERENCES kategorie(id)
);

INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
                                                   ('a', 'Getreideprodukte', 'Getreide (Gluten)'),
                                                   ('a1', 'Weizen', 'Allergen'),
                                                   ('a2', 'Roggen', 'Allergen'),
                                                   ('a3', 'Gerste', 'Allergen'),
                                                   ('a4', 'Dinkel', 'Allergen'),
                                                   ('a5', 'Hafer', 'Allergen'),
                                                   ('a6', 'Dinkel', 'Allergen'),
                                                   ('b', 'Fisch', 'Allergen'),
                                                   ('c', 'Krebstiere', 'Allergen'),
                                                   ('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
                                                   ('e', 'Sellerie', 'Allergen'),
                                                   ('f', 'Milch und Laktose', 'Allergen'),
                                                   ('f1', 'Butter', 'Allergen'),
                                                   ('f2', 'Käse', 'Allergen'),
                                                   ('f3', 'Margarine', 'Allergen'),
                                                   ('g', 'Sesam', 'Allergen'),
                                                   ('h', 'Nüsse', 'Allergen'),
                                                   ('h1', 'Mandeln', 'Allergen'),
                                                   ('h2', 'Haselnüsse', 'Allergen'),
                                                   ('h3', 'Walnüsse', 'Allergen'),
                                                   ('i', 'Erdnüsse', 'Allergen');

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preis_intern`, `preis_extern`) VALUES
                                                                                                                               (1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4),
                                                                                                                               (3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4),
                                                                                                                               (4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
                                                                                                                               (5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
                                                                                                                               (6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 0, 1, 2.5, 4.5),
                                                                                                                               (7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
                                                                                                                               (8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
                                                                                                                               (9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
                                                                                                                               (10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
                                                                                                                               (11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 0, 1, 2, 3),
                                                                                                                               (12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
                                                                                                                               (13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 0, 1, 2.5, 4.5),
                                                                                                                               (14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 0, 1, 3, 5),
                                                                                                                               (15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
                                                                                                                               (16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 0, 1, 1, 1.5),
                                                                                                                               (17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
                                                                                                                               (18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
                                                                                                                               (19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 0, 1, 1.25, 1.75),
                                                                                                                               (20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9);

INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
                                                              ('h', 1),
                                                              ('a3', 1),
                                                              ('a4', 1),
                                                              ('f1', 3),
                                                              ('a6', 3),
                                                              ('i', 3),
                                                              ('a3', 4),
                                                              ('f1', 4),
                                                              ('a4', 4),
                                                              ('h3', 4),
                                                              ('d', 6),
                                                              ('h1',7),
                                                              ('a2', 7),
                                                              ('h3', 7),
                                                              ('c', 7),
                                                              ('a3', 8),
                                                              ('h3', 10),
                                                              ('d', 10),
                                                              ('f', 10),
                                                              ('f2', 12),
                                                              ('h1', 12),
                                                              ('a5',12),
                                                              ('c', 1),
                                                              ('a2', 9),
                                                              ('i', 14),
                                                              ('f1', 1),
                                                              ('a1', 15),
                                                              ('a4', 15),
                                                              ('i', 15),
                                                              ('f3', 15),
                                                              ('h3', 15);

INSERT INTO `kategorie` (`id`, `eltern_id`, `name`, `bildname`) VALUES
                                                                    (1, NULL, 'Aktionen', 'kat_aktionen.png'),
                                                                    (2, NULL, 'Menus', 'kat_menu.gif'),
                                                                    (3, 2, 'Hauptspeisen', 'kat_menu_haupt.bmp'),
                                                                    (4, 2, 'Vorspeisen', 'kat_menu_vor.svg'),
                                                                    (5, 2, 'Desserts', 'kat_menu_dessert.pic'),
                                                                    (6, 1, 'Mensastars', 'kat_stars.tif'),
                                                                    (7, 1, 'Erstiewoche', 'kat_erties.jpg');

INSERT INTO `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`) VALUES
                                                                       (3, 1),	(3, 3),	(3, 4),	(3, 5),	(3, 6),	(3, 7),	(3, 9),	(4, 16), (4, 17), (4, 18), (5, 16), (5, 17), (5, 18);

SHOW COLUMNS FROM gericht;
SELECT COUNT(*) FROM gericht;
SELECT COUNT(*) FROM allergen;
SELECT COUNT(*) FROM kategorie;
SELECT COUNT(*) FROM gericht_hat_allergen;
SELECT COUNT(*) FROM gericht_hat_kategorie;

-- 3.1
SELECT * FROM gericht;

-- 3.2
SELECT erfasst_am FROM gericht;

-- 3.3
select erfasst_am,name as Gerichtname from gericht order by Gerichtname desc;

-- 3.4
select name , beschreibung from gericht order by name limit 5;

-- 3.5
select name , beschreibung from gericht order by name limit 10 offset  5;

-- 3.6
select distinct typ from allergen;

-- 3.7
select name from gericht where name like 'K%';

-- 3.8
select id,name from gericht where name like '%suppe%';


-- 3.9
select * from kategorie where eltern_id is NULL;

-- 3.10
update allergen set name = 'Kamut' where code = 'a6';
select * from allergen;

-- 3.11
insert into `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preis_intern`, `preis_extern`)
values (21, 'Currywurst mit Pommes', 'Pommer und Bockwurst mit spezieller Currysose', '2022-11-11', 0, 0, 2.3, 4.5);
insert into `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`) values (3,21);

select gericht.name, kategorie.name from gericht
join gericht_hat_kategorie on gericht.id = gericht_hat_kategorie.gericht_id
join kategorie on kategorie.id = gericht_hat_kategorie.kategorie_id ;

SELECT gericht.name,gericht.preis_intern,gericht.preis_extern,allergen.name as code
from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
             join allergen on gericht_hat_allergen.code = allergen.code
order by gericht.name limit 5;

-- 6.1
select gericht.name,allergen.name from gericht
join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
join allergen on gericht_hat_allergen.code = allergen.code;

-- 6.2
select gericht.name,allergen.name from gericht
left join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
left join allergen on gericht_hat_allergen.code = allergen.code;

-- 6.3
select gericht.name,allergen.name from gericht
right join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
right join allergen on gericht_hat_allergen.code = allergen.code;

-- 6.4
select count(gericht.name) as Anzahl,kategorie.name from gericht_hat_kategorie
join gericht on gericht.id = gericht_hat_kategorie.gericht_id
join kategorie on gericht_hat_kategorie.kategorie_id = kategorie.id
group by kategorie.name
order by count(gericht.id);

-- 6.5
select count(gericht.name) as Anzahl,kategorie.name from gericht_hat_kategorie
join gericht on gericht.id = gericht_hat_kategorie.gericht_id
join kategorie on gericht_hat_kategorie.kategorie_id = kategorie.id
group by kategorie.name
HAVING anzahl > 2;

-- 6.6
select gericht.name from gericht_hat_allergen
join gericht on gericht.id = gericht_hat_allergen.gericht_id
join allergen on gericht_hat_allergen.code = allergen.code
group by gericht.name
having count(gericht.name) >= 4;









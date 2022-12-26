use emensawerbeseite;

create table benutzer(
                         id int8 auto_increment primary key unique,
                         name varchar(200) not null,
                         email varchar(100) not null unique,
                         passwort varchar(200) not null,
                         admin boolean not null default FALSE,
                         anzahlfehler int not null default 0,
                         anzahlanmeldung int not null,
                         letzteanmeldung datetime,
                         letzterfehler datetime
);
-- 5.1.3
insert into benutzer(name,email,passwort,admin,anzahlanmeldung)
values ('admin','admin@emensa.example','8bef1421b7c92e27540f0bca3cfd905ec51ff458',true,'1');

-- 5.2.1
alter table gericht add bildname varchar(200) default null;

-- 5.2.2)
update gericht set bildname = '01_bratkartoffel.jpg' where id = 1;
update gericht set bildname = '03_bratkartoffel.jpg' where id = 3;
update gericht set bildname = '04_tofu.jpg' where id = 4;
update gericht set bildname = '06_lasagne.jpg' where id = 6;
update gericht set bildname = '09_suppe.jpg' where id = 9;
update gericht set bildname = '10_forelle.jpg' where id = 10;
update gericht set bildname = '11_soup.jpg' where id = 11;
update gericht set bildname = '12_kassler.jpg' where id = 12;
update gericht set bildname = '13_reibekuchen.jpg' where id = 13;
update gericht set bildname = '15_pilze.jpg' where id = 15;
update gericht set bildname = '17_broetchen.jpg' where id = 17;
update gericht set bildname = '19_mousse.jpg' where id = 19;
update gericht set bildname = '20_suppe.jpg' where id = 20;

update benutzer set passwort = '8bef1421b7c92e27540f0bca3cfd905ec51ff458' where id = 1;

update benutzer set anzahlanmeldung = 1 where id = 1;
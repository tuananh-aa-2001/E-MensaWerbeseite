use emensawerbeseite;
-- Meilenstein 4
-- 1.2
create table ersteller(
                          erstellerId int8 not null auto_increment primary key unique,
                          email varchar(50) not null unique,
                          name varchar(50) default 'anonym'
);

-- 1.2
create table wunschgericht(
                              id int8 auto_increment primary key,
                              gericht_name varchar(50),
                              beschreibung varchar(100),
                              datum  date default CURRENT_DATE,
                              erstellerId  int8,
                              foreign key (erstellerId) references  ersteller(erstellerId)
);

select * from wunschgericht;
select * from ersteller;

-- 1.6
SELECT ID, GERICHT_NAME, BESCHREIBUNG, DATUM, EMAIL, NAME FROM wunschgericht
INNER JOIN ersteller ON wunschgericht.erstellerID = ersteller.erstellerID
ORDER BY datum desc LIMIT 5;

-- 4.1
alter table gericht_hat_kategorie add constraint unique_gericht_kategorie unique key (gericht_id,kategorie_id);

-- 4.2
create index gericht_name_index on gericht(name);
select * from gericht where name = 'lasagne';

-- 4.3.1
alter table gericht_hat_kategorie add constraint fk_gericht foreign key (gericht_id) references gericht(id) on delete cascade;
-- 4.3.2
alter table gericht_hat_allergen add constraint fk_gericht_allergen foreign key (gericht_id) references gericht(id) on delete cascade;

-- 4.4.1
alter table gericht_hat_kategorie add constraint fk_kategorie foreign key (kategorie_id) references gericht(id);
-- 4.4.2
alter table kategorie add constraint fk_eltern_kategorie foreign key(eltern_id) references kategorie(id);

-- 4.5
alter table gericht_hat_allergen add constraint fk_allergen_code foreign key(code) references allergen(code) on update cascade;

-- 4.6
alter table gericht_hat_kategorie add primary key (gericht_id,kategorie_id);
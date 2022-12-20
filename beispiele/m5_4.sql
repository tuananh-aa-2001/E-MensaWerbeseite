create view view_suppengerichte as select * from gericht where name like '%suppe%';
select * from view_suppengerichte;

create view view_anmeldungen as select id, email, anzahlanmeldung from benutzer order by anzahlanmeldung desc;
select * from view_anmeldungen;

create view view_kategoriegerichte_vegetarisch as select gericht.name as gericht,
kategorie.name as kategorie from gericht inner join gericht_hat_kategorie on gericht.id = gericht_hat_kategorie.gericht_id
right join kategorie on kategorie.id = gericht_hat_kategorie.kategorie_id and gericht.vegetarisch = 1 or vegetarisch is null
order by gericht_id;

select * from view_kategoriegerichte_vegetarisch;


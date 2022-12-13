use emensawerbeseite;

drop procedure if exists anmeldungszaehler;

create procedure anmeldungszaehler (IN id int, IN anzahlanmeldung int, IN letzteanmeldung datetime)
begin
    update benutzer set benutzer.anzahlanmeldung = benutzer.anzahlanmeldung  + anzahlanmeldung,
                        benutzer.letzteanmeldung = letzteanmeldung where benutzer.id = id;
end;

select * from benutzer;
call anmeldungszaehler(1,8,now());
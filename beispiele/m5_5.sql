use emensawerbeseite;
update benutzer set benutzer.passwort = '8bef1421b7c92e27540f0bca3cfd905ec51ff458' where id=1;

drop procedure if exists anmeldungszaehler;

create procedure anmeldungszaehler (IN email_input VARCHAR(100))
begin
    update benutzer set benutzer.anzahlanmeldung = benutzer.anzahlanmeldung  + anzahlanmeldung
                       where benutzer.email = email_input ;
end;

select * from benutzer;
call anmeldungszaehler('admin@emensa.example');

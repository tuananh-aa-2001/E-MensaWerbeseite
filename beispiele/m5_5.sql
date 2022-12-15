use emensawerbeseite;

drop procedure if exists anmeldungszaehler;

create procedure anmeldungszaehler (IN email_input VARCHAR(100))
begin
    update benutzer set benutzer.anzahlanmeldung = benutzer.anzahlanmeldung  + anzahlanmeldung
                       where benutzer.email = email_input ;
end;

select * from benutzer;
call anmeldungszaehler('admin@emensa.example');
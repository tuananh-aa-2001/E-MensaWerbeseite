use emensawerbeseite;

create table if not exists bewertung(
    id int8 primary key auto_increment,
    bemerkung varchar(200) not null,
    sternebewertung enum('sehr schlecht','schlecht','gut','sehr gut'),
    bewertungszeitpunkt datetime not null default now(),
    hervorgehoben boolean not null default 0,
    gerichtId  bigint not null,
    foreign key (gerichtId) references gericht(id),
    check (length(bemerkung > 4))
);
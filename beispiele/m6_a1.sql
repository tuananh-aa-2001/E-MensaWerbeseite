use emensawerbeseite;

CREATE TABLE IF NOT EXISTS bewertung(
id INT8 PRIMARY KEY AUTO_INCREMENT,
bemerkung VARCHAR(200) NOT NULL,
sternebewertung ENUM('sehr schlecht', 'schlecht', 'gut', 'sehr gut'),
bewertungszeitpunkt DATETIME NOT NULL DEFAULT NOW(),
hervorgehoben BOOLEAN NOT NULL DEFAULT 0,
gerichtId BIGINT NOT NULL,
FOREIGN KEY (gerichtId) REFERENCES gericht(id),
CHECK (LENGTH(bemerkung)>4)
);


-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja (
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
email varchar(50) NOT NULL,
password varchar(50) NOT NULL,
rooli varchar
);

CREATE TABLE Treeni (
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
kesto varchar(50),
soveltuvuus varchar(50),
kuvaus varchar(500) 
);


CREATE TABLE Voimalaji (
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
kuvaus varchar(500) 
);

CREATE TABLE Liike (
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
soveltuvuus varchar(50),
kuvaus varchar(500),
voimalaji_id INTEGER REFERENCES Voimalaji(id) 
);

CREATE TABLE Treeniliike (
liike_id INTEGER REFERENCES Liike(id),
treeni_id INTEGER REFERENCES Treeni(id)
);


CREATE TABLE Voimatreeni (
voimalaji_id INTEGER REFERENCES Voimalaji(id),
treeni_id INTEGER REFERENCES Treeni(id)
);
-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (id, name, email, password, rooli) VALUES ('1', 'Elsa', 'elsa.nyrhinen@helsinki.fi', 'Elsa123', 'true');
INSERT INTO Kayttaja (id, name, email, password, rooli) VALUES ('2', 'Testi', 'testi@helsinki.fi', 'Testi123', 'false');
INSERT INTO Treeni (id, name, kesto, soveltuvuus, kuvaus) VALUES ('1', 'Crossfit', '30min', '{"Juniorit", "Seniorit"}', 'Nopeatempoinen treeni.');
INSERT INTO Voimalaji (id, name, kuvaus) VALUES ('1', 'Nopeusvoima', 'Räjähtävävoima ja pikavoima. Tuotetaan mahdollisimman suuri voima lyhyessä ajassa.');
INSERT INTO Voimalaji (id, name, kuvaus) VALUES ('2', 'Kestovoima', 'Aerobinen lihaskestävyys ja anaerobinen voimakestävyys. Luo taloudellisuuden edellytykset suorituksiin parantamalla hitaiden ja nopeiden lihassolujen työtehoja.');
INSERT INTO Voimalaji (id, name, kuvaus) VALUES ('3', 'Maksimivoima', 'Perusvoima ja maksimivoima. Harjoittelussa liikenopeus vähäinen: mahdollisimman suurilla painoilla ja mahdollisimman nopeasti.');
INSERT INTO Liike (id, name, soveltuvuus, kuvaus, voimalaji_id) VALUES ('1', 'Ojentajapunnerrus', 'juniorit', 'vartalo suorassa linjassa punnerrusasennossa, kyynerpäät kyljissä.','1');
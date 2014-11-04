# USE barista
# SET FOREIGN_KEY_CHECKS = 0;
# TRUNCATE TABLE ferdig_ordre;
# TRUNCATE TABLE fp_tilbehor;
# TRUNCATE TABLE ordre;
# TRUNCATE TABLE ferdigprodukt;
# TRUNCATE TABLE admins;
# TRUNCATE TABLE kategori;
# TRUNCATE TABLE produkt;
# TRUNCATE TABLE tilbehor;
# TRUNCATE TABLE type;
# SET FOREIGN_KEY_CHECKS = 1;

SET FOREIGN_KEY_CHECKS = 0;
DROP DATABASE IF EXISTS barista;

CREATE DATABASE barista;
USE barista;
CREATE TABLE admins
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  username VARCHAR(256) NOT NULL,
  password VARCHAR(256) NOT NULL,
  firstname VARCHAR(256) NOT NULL,
  lastname VARCHAR(256) NOT NULL,
  activated CHAR(2) NOT NULL
);
CREATE TABLE ferdig_ordre
(
  fp_id INT NOT NULL,
  ordre_id INT NOT NULL
);
CREATE TABLE ferdigprodukt
(
  fp_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fp_navn VARCHAR(20),
  produkt_id INT NOT NULL
);
CREATE TABLE fp_tilbehor
(
  fp_id INT NOT NULL,
  tilbehor_id INT NOT NULL,
  PRIMARY KEY ( fp_id, tilbehor_id )
);
CREATE TABLE kategori
(
  kat_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  Kat_navn VARCHAR(10)
);
CREATE TABLE ordre
(
  ordre_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  ordre_navn VARCHAR(20),
  dato DATE
);
CREATE TABLE produkt
(
  produkt_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  produkt_navn VARCHAR(20),
  kat_id INT NOT NULL,
  pris DECIMAL(10,2) NOT NULL,
  bilde VARCHAR(256),
  beskrivelse VARCHAR(256)
);
CREATE TABLE tilbehor
(
  tilbehor_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tilbehor_navn VARCHAR(15),
  type_id MEDIUMINT,
  pris DECIMAL(3,2) NOT NULL
);
CREATE TABLE type
(
  type_id MEDIUMINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  type_navn CHAR(30) NOT NULL
);

ALTER TABLE ferdig_ordre ADD FOREIGN KEY ( fp_id ) REFERENCES ferdigprodukt ( fp_id );
ALTER TABLE ferdig_ordre ADD FOREIGN KEY ( ordre_id ) REFERENCES ordre ( ordre_id );
ALTER TABLE ferdigprodukt ADD FOREIGN KEY ( produkt_id ) REFERENCES produkt ( produkt_id );
CREATE UNIQUE INDEX fp_id ON ferdigprodukt ( fp_id );
ALTER TABLE fp_tilbehor ADD FOREIGN KEY ( fp_id ) REFERENCES ferdigprodukt ( fp_id );
ALTER TABLE fp_tilbehor ADD FOREIGN KEY ( tilbehor_id ) REFERENCES tilbehor ( tilbehor_id );
CREATE UNIQUE INDEX kat_id ON kategori ( kat_id );
CREATE UNIQUE INDEX ordre_id ON ordre ( ordre_id );
ALTER TABLE produkt ADD FOREIGN KEY ( kat_id ) REFERENCES kategori ( kat_id );
CREATE UNIQUE INDEX produkt_id ON produkt ( produkt_id );
ALTER TABLE tilbehor ADD FOREIGN KEY ( type_id ) REFERENCES type ( type_id );
CREATE UNIQUE INDEX tilbehør_id ON tilbehor ( tilbehor_id );


INSERT INTO `produkt` (`produkt_id`, `produkt_navn`, `kat_id`, `pris`, `bilde`, `beskrivelse`) VALUES
  (1, 'Regular Coffe', 1, '20.00', 'pics/regular.jpg', 'Vanelig svart kaffi med dyp aroma'),
  (2, 'Cappuccino', 1, '30.00', ' pics/cappuccino.jpg', 'Cappucino er laget av espresso og steamet melk og består av 1/3 melk, 1/3 espresso og 1/3 melkeskum'),
  (3, 'Espresso', 1, '30.00', 'pics/espresso.jpg', 'Espresso er en mer intens og smaksfull kaffitype enn vanelig filterkaffi.'),
  (4, 'Cafe Latte', 1, '30.00', ' pics/cafelatte.jpg', 'Cafe Latte lages av espresso og varm melk, hvor det er en del espresso og fem deler melk.'),
  (5, 'Caffe Mocca', 1, '30.00', 'pics/cafemocca.jpg', 'Cafe mocca er en drikk som lages på samme måte som cafe latte, med espresso og melk, men her tilsettes også sokolade.'),
  (6, 'Grønn te', 2, '20.00', ' pics/greentea.jpg', 'Klassisk grønn te, som gir et lyst vann med mye smak.'),
  (7, 'Frukt te', 2, '20.00', 'pics/fruktte.jpg', 'Frukt te også kjent som "bestemors frukt hage", består av deilige tørkede bær, frukter og blader.'),
  (8, 'Earl grey', 2, '20.00', ' pics/earlgrey.jpg', 'Eargrey er en svart te som er smaksatt med oljer og utvunnet av bergamottappelsin'),
  (9, 'Chai te', 2, '25.00', ' pics/te.jpg', 'Chai te er en søt krydderte fra india, hvor man erstatter vannet med melk.'),
  (10, 'Iskaffi Mocca', 1, '35.00', ' pics/iskaffimocca.jpg', 'En iskald cafe mocca med ekstra sjokolade for masse smak.'),
  (11, 'Iskaffi Latte', 1, '35.00', ' pics/iskaffilatte.jpg', 'Iskaffi latte er en enkel iskaffi, tilsett gjerne en av våre siruper for ekstra smak.'),
  (12, 'Iste Fersken', 2, '30.00', ' pics/icedteapeach.jpg', 'Vår hjemmelagde fersken iste, trukket på fersken og mynte.'),
  (13, 'Iste Sitron', 2, '30.00', ' pics/icedtealemon.jpg', 'Vår hjemmelagde sitron iste, trukket på ferke sitroner og mynte.');

INSERT INTO `tilbehor` (`tilbehor_id`, `tilbehor_navn`, `type_id`, `pris`) VALUES
  (1, 'Skummet melk', 1, '0.00'),
  (2, 'Laktose fri', 1, '5.00'),
  (3, 'Hel Melk', 1, '0.00'),
  (4, 'Krem', 2, '7.00'),
  (5, 'Marshmellows', 2, '7.00'),
  (6, 'cappucino dryss', 2, '2.00'),
  (7, 'Sjokolade biter', 2, '7.00'),
  (8, 'Hasselnøtt siru', 4, '5.00'),
  (9, 'Caramel Sirup', 4, '5.00'),
  (10, 'Vanilje sirup', 4, '5.00'),
  (11, 'Sjokolade Sirup', 4, '5.00'),
  (12, 'Irish Cream Sir', 4, '5.00'),
  (13, 'Brunt sukker', 3, '2.00'),
  (14, 'Vanelig sukker', 3, '2.00'),
  (15, 'sukkerfri sotni', 3, '2.00');

INSERT INTO `type` (`type_id`, `type_navn`) VALUES
  (1, 'Melk'),
  (2, 'Topping'),
  (3, 'Sukker'),
  (4, 'Syrup');

SET FOREIGN_KEY_CHECKS = 1;

DROP PROCEDURE IF EXISTS produktFraKatId;
CREATE PROCEDURE produktFraKatId(
  IN ID INT
)
  BEGIN
    SELECT * FROM produkt
    WHERE kat_id = ID;
  END;

DROP PROCEDURE IF EXISTS sp_SelAllProdukt;
CREATE PROCEDURE sp_SelAllProdukt()
  BEGIN
    SELECT * FROM produkt;
  END;

DROP PROCEDURE IF EXISTS sp_tilbehor;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tilbehor`()
  BEGIN
    SELECT * FROM tilbehor;
  END;

# Hent ut produkta utifra ordre_navn
DROP PROCEDURE IF EXISTS fpFraOrdreNavn;
CREATE PROCEDURE fpFraOrdreNavn(
  IN ordreNavn NCHAR(20)
)
  BEGIN
    DECLARE ordreId INT;
    SELECT ordre_id FROM ordre
    WHERE ordreNavn = ordre_navn
    INTO ordreId;

    SELECT ordre.ordre_id
      ,ferdigprodukt.fp_id
      ,ferdigprodukt.fp_navn
      ,ferdigprodukt.produkt_id
      ,produkt.pris AS 'produkt_pris'
      ,produkt.kat_id

    FROM
      ordre
      LEFT JOIN ferdig_ordre
        ON ordre.ordre_id = ferdig_ordre.ordre_id
      LEFT JOIN ferdigprodukt
        ON ferdig_ordre.fp_id = ferdigprodukt.fp_id
      LEFT JOIN produkt
        ON ferdigprodukt.produkt_id = produkt.produkt_id
    WHERE ordre.ordre_id = ordreId

    GROUP BY fp_id;
  END;

# Hent ut tilbehør ut i fra ferdigprodukt ID
DROP PROCEDURE IF EXISTS tilbehorFraFp;
CREATE PROCEDURE tilbehorFraFp(
  IN fpId INT
)
  BEGIN
    SELECT ferdigprodukt.fp_id
      ,tilbehor.tilbehor_id
      ,tilbehor.tilbehor_navn
      ,tilbehor.type_id
      ,tilbehor.pris AS 'tilbehor_pris'

    FROM
      ferdigprodukt
      LEFT JOIN fp_tilbehor
        ON ferdigprodukt.fp_id = fp_tilbehor.fp_id
      LEFT JOIN tilbehor
        ON fp_tilbehor.tilbehor_id = tilbehor.tilbehor_id
    WHERE ferdigprodukt.fp_id = fpId

    GROUP BY fp_tilbehor.tilbehor_id;
  END;


DROP TRIGGER IF EXISTS ins_produkt_check;
delimiter //
CREATE TRIGGER ins_produkt_check
BEFORE INSERT ON produkt
FOR EACH ROW
  BEGIN
    IF NEW.pris < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Pris kan ikke være under 0 kr';
    END IF;
  END;//
delimiter ;

DROP TRIGGER IF EXISTS ins_tilbehor_check;
delimiter //
CREATE TRIGGER ins_tilbehor_check
BEFORE INSERT ON tilbehor
FOR EACH ROW
  BEGIN
    IF NEW.pris < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Pris kan ikke være under 0 kr';
    END IF;
  END;//
delimiter ;
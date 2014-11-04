USE barista;

DROP PROCEDURE IF EXISTS produktFraKatId;
CREATE PROCEDURE produktFraKatId(
  IN ID INT
)
  BEGIN
    SELECT * FROM produkt
    WHERE kat_id = ID;
  END;

CREATE PROCEDURE sp_SelAllProdukt()
  BEGIN
    SELECT * FROM produkt;
  END;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tilbehor`()
BEGIN
  SELECT * FROM tilbehor;
END;

# SET FOREIGN_KEY_CHECKS = 0;
# TRUNCATE TABLE ferdig_ordre;
# TRUNCATE TABLE fp_tilbehor;
# TRUNCATE TABLE ordre;
# TRUNCATE TABLE ferdigprodukt;
# SET FOREIGN_KEY_CHECKS = 1;

# Hent ut produkta og tilbehør utifra ordre_navn
DROP PROCEDURE IF EXISTS ordreListe;
CREATE PROCEDURE ordreListe(
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
      ,tilbehor.tilbehor_id
      ,tilbehor.tilbehor_navn
      ,tilbehor.type_id
      ,tilbehor.pris AS 'tilbehor_pris'
    FROM
      ordre
      LEFT JOIN ferdig_ordre
        ON ordre.ordre_id = ferdig_ordre.ordre_id
      LEFT JOIN ferdigprodukt
        ON ferdig_ordre.fp_id = ferdigprodukt.fp_id
      LEFT JOIN fp_tilbehor
        ON ferdigprodukt.fp_id = fp_tilbehor.fp_id
      LEFT JOIN tilbehor
        ON fp_tilbehor.tilbehor_id = tilbehor.tilbehor_id
      LEFT JOIN produkt
        ON ferdigprodukt.produkt_id = produkt.produkt_id


    WHERE ordre.ordre_id = ordreId;

    #GROUP BY fp_id;



  END;


CALL ordreListe('GfJG01MLwjFBpYnNqlmq');


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

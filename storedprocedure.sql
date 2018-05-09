DEFINER //
CREATE PROCEDURE starters()
    BEGIN
SELECT gk, def1, def2, def3, mid1, mid2, mid3, for1, for2, fr FROM team

WHERE ID = 2 AND start = 1

END //
DELIMITER;

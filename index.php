<!DOCTYPE html>
<html>

    <head>
    </head>

    <body>

        <title>Index ds</title>

            <?php
            /**
             * Created by IntelliJ IDEA.
             * User: fun
             * Date: 23.09.14
             * Time: 09:29
             */




            $mysqli = new mysqli("localhost", "moderator", "ftyujnbv", "barista", 3306);
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }

            $mysqli->query("INSERT INTO barista.produkt(produkt_navn,kat_id)VALUES ('Phpkaffe' , 1)");

            $tables = $mysqli->query("SHOW TABLES FROM barista");

            while($mainTable = mysqli_fetch_array($tables))
            {
                $attributes = $mysqli->query("SELECT * FROM " . $mainTable[0]);

                echo "<h6>" . $mainTable[0] . "</h6>";

                echo mysqli_fetch_field($attribute);

                while($attribute = mysqli_fetch_array($attributes))
                {
                    echo $attribute[0];

                    echo "<br>";
                }
                echo "<br>";
                echo "<br>";
            }

            $mysqli->query("DELETE FROM barista.produkt WHERE produkt_navn='Phpkaffe'");


            ?>

    </body>

</html>

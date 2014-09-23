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


            //$table = $mysqli->query("");


                //$result = $mysqli->query("SELECT * FROM produkt");
                //echo "<table>";

                //while($produktnavn = mysqli_fetch_array($result))
                //{
                //    echo "<tr><td>" . $produktnavn['produkt_navn'] . "</td></tr>";
                //}


                for($i=0;$i<9;$i++){
                    for($j=$i+1;$j<10;$j++){
                        echo($i . " " . $j . "<br>");
                    }
                }
                echo("OMGOMGOMGOMOGMOGMGMG<br>");

                function f($i,$j)
                {
                   echo($i . " " . $j . "<br>");
                   if($j>=9 && $i<8) {
                       f($i+1,$i+2);
                   }
                   else if($j<9){
                       f($i,$j+1);
                   }
                }
                f(0,1);

            ?>

    </body>

</html>

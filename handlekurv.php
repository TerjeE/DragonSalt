<div class="shopping-cart">

    <?php


    foreach($_SESSION["produkt"] as $produkt)
    {
        echo "<b>";
       echo $produkt->navn . "<br>";
        echo "</b>";
        if(is_array($produkt->tilbehor))
        {


            echo htmlentities(" Tilbehør: ");
            foreach($produkt->tilbehor as $tilbehor_id)
            {
                //echo $tilbehor_id;

                $tilbehor_navn = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tilbehor WHERE tilbehor_id ='$tilbehor_id'"))['tilbehor_navn'];
                echo $tilbehor_navn;
                echo "\t";
            }
            echo "<br>";
        }else{
            echo htmlentities("Uten tilbehør");
            echo "<br>";

        }

    }

    ?>

</div>
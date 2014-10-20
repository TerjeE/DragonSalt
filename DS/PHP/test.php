<?php
/**
 * Created by IntelliJ IDEA.
 * User: fun
 * Date: 23.09.14
 * Time: 14:24
 */

$A = [9,8,7,6,5,4,3,2,1];
$B = [9,2,7,6,5,4,3,8,1];


$n = 9;

for($i=0;$i<$n-1;$i++){
    for($j=$i+1;$j<$n;$j++){
        echo $i . "   " . $j . "<br>";
        if($A[$i]>$A[$j]){
            $temp = $A[$j];
            $A[$j]=$A[$i];
            $A[$i]=$temp;
        }
    }
}

print_r($A);

echo "<br>";
echo "<br>";
echo "<br>";

function f($i,$j){
    global $n,$B;

    if($i<$n-2 && $j>=$n-1){
        f($i+1,$i+2);
    }
    else if($i<$n-1 && $j<$n-1){
        f($i,$j+1);
    }
    echo $i . "   " . $j . "<br>";

    if($B[$i]>$B[$j]){
        $temp = $B[$j];
        $B[$j]=$B[$i];
        $B[$i]=$temp;
    }

}

f(0,0);


echo "<br>";
echo "<br>";
echo "<br>";
print_r($B);

/**
 * Created by fun on 20.10.14.
 */

/*
function openBox(produktnavn)
{
    document.write(produktnavn);
}
*/

function openBox(produktnavn)
{
    var ting = document.getElementById(produktnavn);
    var alle = document.getElementsByClassName("popup");

    for(var i=0; i<alle.length; i++) {
        if(alle[i] != ting) {
            alle[i].style.display = "none";
        }
    }

    if(ting.style.display == "none" || (ting.style.display != "none" && ting.style.display != "block")){
        ting.style.display = "block";
    }else{
        ting.style.display = "none";
    }
}

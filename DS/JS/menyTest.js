/**
 * Created by fun on 20.10.14.
 */

var timeout	= 500;
var closetimer	= 0;
var ddmenuitem	= 0;

// open hidden layer
function mopen(id)
{
    // cancel close timer
    mcancelclosetime();

    // close old layer
    if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

    // get new layer and show it
    ddmenuitem = document.getElementById(id);
    ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
    if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
    closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
    if(closetimer)
    {
        window.clearTimeout(closetimer);
        closetimer = null;
    }
}
function openBox(produktnavn)
{
    document.write(produktnavn);
}

function openBox(produktnavn)
{

    ting = document.getElementById(produktnavn);

    alle = document.getElementsByClassName("popup");

    /*for(var en in alle){
        if(en!=ting){
            en.style.display = "none";
        }
    }*/

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

// close layer when click-out
document.onclick = mclose;
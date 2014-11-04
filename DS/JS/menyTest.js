/**
 * Created by fun on 20.10.14.
 */

function openBox(produktnavn)
{
    clicked = 1;

    ting = document.getElementById(produktnavn);
    alle = document.getElementsByClassName("popup");

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

function openKat(kategorinavn){
    ting = document.getElementById(kategorinavn);
    alle = document.getElementsByClassName("kategori");
    //clicked = 1;
    ting.style.display = "block";
    for(var i=0; i<alle.length; i++) {
        if(alle[i] != ting) {
            alle[i].style.display = "none";
        }
    }

}

function htmlClicked(){
    if(clicked == 1){
        clicked = 0;
    }else{
        //hides all popup
        alle = document.getElementsByClassName("popup");

        for(var i=0; i<alle.length; i++) {
            alle[i].style.display = "none";
        }
    }

}

function scrollTest(element){
    scrollpos= document.body.scrollTop;
    localStorage.setItem("scrollpos", scrollpos);
    //alert(scrollpos);
}

function scrolldown(){
    var scrollpos = localStorage.getItem("scrollpos");
    //alert("scrolldown" + scrollpos);
    window.scrollTo(0, scrollpos);

}

function popupClicked(){
    clicked = 1;

}


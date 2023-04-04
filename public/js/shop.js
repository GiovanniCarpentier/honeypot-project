'use strict';

document.addEventListener("DOMContentLoaded",init);

function init(){
    console.log("loaded");
    document.querySelector("#SearchItem").addEventListener("keyup", searchProduct);
}

function searchProduct(e){
    if(e.keyCode !== 13){
        return
    }

    let data = e.target.value;

    let url = window.location.origin;
    window.location.href = url + "/shop/" + data;
}
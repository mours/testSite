<!-- switch button to modern map -->
document.getElementById('click1').onclick = function ( event ){
    document.getElementById('mymap').src = "./css/images/carte4.jpg";
    document.getElementById('click1Text').style.fontWeight = "bold";
    document.getElementById('click2Text').style.fontWeight = "normal";
}
<!-- switch button to old map -->
document.getElementById('click2').onclick = function ( event ){
    document.getElementById('mymap').src = "./css/images/carte3.jpg";
    document.getElementById('click1Text').style.fontWeight = "normal";
    document.getElementById('click2Text').style.fontWeight = "bold";
}
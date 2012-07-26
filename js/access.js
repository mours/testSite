<!-- switch button to modern map -->
document.getElementById('click1').onclick = function ( event ){
    document.getElementById('mymap').src = "./css/images/GoogleMap.png";
    document.getElementById('click1Text').style.fontWeight = "bold";
    document.getElementById('click2Text').style.fontWeight = "normal";
}
<!-- switch button to old map -->
document.getElementById('click2').onclick = function ( event ){
    document.getElementById('mymap').src = "./css/images/CassiniMap.png";
    document.getElementById('click1Text').style.fontWeight = "normal";
    document.getElementById('click2Text').style.fontWeight = "bold";
}
function Import(){
    let filename = document.getElementById("import-selection").value;
    fetch('./ajax.php/?importfile='+filename)
    .then(res =>res.text())
    .then(res => document.getElementById('tableholder').innerHTML=res);
}
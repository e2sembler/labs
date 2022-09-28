function GetData(){ 
    let fname = document.getElementById("fname").value; 
    let fmin = document.getElementById("price-row").children[0].value;    
    let fmax = document.getElementById("price-row").children[1].value;
    let fdesc = document.getElementById("desc").value;
    let fbrand = document.getElementById("brands").value;
    const xhttp= new XMLHttpRequest();
    xhttp.onload = function(){
        document.getElementById("item-list").innerHTML=this.responseText;
        scroll(0,0);
    }
    xhttp.open("GET","filter.php?fname="+fname+"&fmin="+fmin+"&fmax="+fmax+"&fdesc="+fdesc+"&fbrand="+fbrand);
    xhttp.send();
}
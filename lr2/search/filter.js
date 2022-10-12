function GetData(){ 
    let fname = document.getElementById("fname").value; 
    let fmin = document.getElementById("price-row").children[0].value;    
    let fmax = document.getElementById("price-row").children[1].value;
    let fdesc = document.getElementById("desc").value;
    let fbrand = document.getElementById("brands").value;
    const xhttp= new XMLHttpRequest();

    xhttp.onerror = ()=> alert("Нет связи с сервером");
    xhttp.open("GET","filter.php?fname="+fname+"&fmin="+fmin+"&fmax="+fmax+"&fdesc="+fdesc+"&fbrand="+fbrand);
    xhttp.send(); 
    xhttp.onreadystatechange =()=> {
        if(xhttp.readyState === XMLHttpRequest.DONE){
        if (xhttp.status === 200){ 
            document.getElementById("item-list").innerHTML=xhttp.responseText;
            scroll(0,0);
        }
        if(xhttp.status==500) alert("Проблема на стороне сервера");
    }
    } 
}
function CheckPass(){
    let target = event.target;
if(target.value){
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST","./inputcheck-ajax.php"); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("fpass1="+target.value); 
    xhttp.onload=()=>{
        if(xhttp.status==200) target.parentNode.lastElementChild.innerHTML=xhttp.responseText;
    }
}
else target.parentNode.lastElementChild.innerHTML=null;
}


function CheckPass2(){  
if(event.target.value){
    if(document.querySelector("#passtd>input").value!=event.target.value)
    event.target.parentNode.lastElementChild.innerHTML ="<p>Пароли не совпадают</p>"; 
    else event.target.parentNode.lastElementChild.innerHTML=null;
}
}

function CheckMail(){ 
    let target = event.target;
if(target.value){
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST","./inputcheck-ajax.php"); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("fmail="+target.value); 
    xhttp.onload=()=>{
        if(xhttp.status==200) target.parentNode.lastElementChild.innerHTML=xhttp.responseText;
    }
} else target.parentNode.lastElementChild.innerHTML=null;
}

function Register(){
    let array = document.querySelectorAll('#regform>table>tbody>tr>td>input'); 
    let values = [];
    for(let a of array)
        values.push(a.value);
    let userdata = JSON.stringify(values); 
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST","./reg.php"); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userdata="+userdata);
    xhttp.onload=()=>{
        if(xhttp.status==200){
            if(xhttp.responseText.length<=2){
                alert("Регистрация успешна, войдите в систему");
                window.location.href="./login.php"; 
            }
            else alert(xhttp.responseText); 
            console.log(xhttp.responseText.length);
        }
    } 
}
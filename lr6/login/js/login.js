function Login(){
    CheckMail();
    let mail = document.getElementById("flogin");
    let pass = document.getElementById("fpass1"); 
    if(!mail.value){
        mail.parentNode.lastElementChild.innerHTML="<p>Почта не может быть пустой</p>";
        return;
    }
    if(!pass.value){
        pass.parentNode.lastElementChild.innerHTML="<p>Пароль не может быть пустым</p>";
        return;
    }
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST","./login.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("mail="+mail.value+"&pass="+pass.value);
    xhttp.onload=()=>{
        if(xhttp.status==200){
            if(xhttp.responseText.length<=2){
                alert("Вход успешен");
                window.location.href="../search/"; 
            }
            else alert(xhttp.responseText);
        }
    }
}

function CheckMail(){ 
    let target = document.getElementById("flogin");
    if(target.value){
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST","./inputcheck-ajax.php"); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("loginmail="+target.value); 
    xhttp.onload=()=>{
        if(xhttp.status==200) target.parentNode.lastElementChild.innerHTML=xhttp.responseText;
    }

} else target.parentNode.lastElementChild.innerHTML=null;
}
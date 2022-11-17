
async function LoadPreset(){
    let index = event.target.selectedIndex; 
    let textarea = document.getElementById("inputarea");
    if(index==0){
        textarea.value=null;
        return;
    }
    const data = {preset:index};
    fetch('ajax.php?preset='+index). 
    then(response=>response.text()). 
    then(result => textarea.value = result);
}

async function Send(){ 
    let textarea = document.getElementById("inputarea");
    if(!textarea.value) return;  
    const data = {inputarea:textarea.value}; 
    const resarea = document.getElementById("resultarea");
    fetch("ajax.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=utf-8",
        },
        body: JSON.stringify(data),
    }).
    then(response => response.text()).
    then(result => resarea.innerHTML = result); 
}
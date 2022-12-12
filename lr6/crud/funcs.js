 
async function GetData(){ 
    fetch('./ajax.php?table_items=1'). 
    then(response=>response.text()). 
    then(result => document.getElementById("item-list").innerHTML = result);
}

function ClearFields(){
    document.querySelectorAll('#addeditem>p>input[type="text"]').forEach(field => field.value=null);
    document.querySelector('#addeditem>p>select').value=null;
    document.getElementById('upload').value=null;
}

async function AddItem(){
    let elements = document.querySelectorAll('#addeditem>p>*');
    let errorcounter = GetErrorCount(elements);
    if(errorcounter>0) return; 
    let data = new FormData();
    data.append('img',elements[0].files[0]);
    data.append('name',elements[1].value);
    data.append('brand',elements[2].value);
    data.append('desc',elements[3].value);
    data.append('price',elements[4].value);
    fetch('./ajax.php',{
        method: 'POST',
        body: data
    }).
        then(res => res.text()).then(result=>{if(result.length>3) alert(result) ;GetData()});
}

function GetErrorCount(elements){
    document.querySelectorAll('#addeditem>p>.errorentry').forEach(ele => ele.classList.remove('errorentry'));
    let errorcounter = 0; 
    elements.forEach(ele => {if(ele.value==''){ ele.classList.add('errorentry'); errorcounter++;} });
    if(isNaN(elements[4].value)){
        elements[4].classList.add('errorentry');
        errorcounter++;
    }
    return errorcounter;
}



window.onload=()=>GetData();

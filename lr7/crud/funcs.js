 
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
    data.append('additem',1);
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


function ElementHider(eventarg, confirm_mode){
    eventarg.querySelectorAll('.hidden').forEach(ele => ele.classList.remove('hidden'));
    if(confirm_mode){
        eventarg.querySelector('.rmbtn').classList.add('hidden');
        eventarg.querySelector('.editbtn').classList.add('hidden'); 
    }
    else{
        eventarg.querySelector('.confirmbtn').classList.add('hidden');
        eventarg.querySelector('.cancelbtn').classList.add('hidden');
    }
}

function CheckError(row){
    row.querySelectorAll('.errorentry').forEach(ele=>ele.classList.remove('errorentry'));
    if(isNaN(row.querySelector('.price').value)) row.querySelector('.price').classList.add('errorentry');
    if(row.querySelector('.name').value=='') row.querySelector('.name').classList.add('errorentry');
    if(row.querySelector('.desc-box').value=='') row.querySelector('.desc-box').classList.add('errorentry');
    if(row.querySelector('#brands').value=='') row.querySelector('.desc-box').classList.add('errorentry');
    return row.querySelectorAll('.errorentry').length>0
}

async function EditMode(targ,enable,canceled=false){
    let selecter = targ.querySelector('.selecter');
    if(enable){
        fetch('./ajax.php?get_brands=1').
            then(res => res.text())
            .then(res => {
                selecter.innerHTML=res; 
                selecter.querySelector('select').value=selecter.getAttribute('data-val');
            });
        targ.querySelector('#img>img').classList.add('hidden');
        targ.querySelector('#img>input').classList.remove('hidden');
        targ.querySelector('#img>input').value=null;
        targ.querySelectorAll('textarea').forEach(ele => ele.readOnly=false)
    }
    else{
        selecter.innerHTML=selecter.getAttribute('data-val');
        targ.querySelector('#img>img').classList.remove('hidden');
        targ.querySelector('#img>input').classList.add('hidden'); 
        targ.querySelectorAll('textarea').forEach(ele => ele.readOnly=true); 
        if(canceled==true)
            targ.querySelectorAll('textarea').forEach(ele => ele.value=ele.getAttribute('data-val'));
        

    }

}

function EditClick(){
    ElementHider(event.target.parentNode,true);
    event.target.parentNode.querySelector('.confirmbtn').setAttribute('data-del',false); 
    let row = event.target.parentNode.parentNode;
    EditMode(row, true);
}


function DeleteClick(){
    ElementHider(event.target.parentNode,true); 
    event.target.parentNode.querySelector('.confirmbtn').setAttribute('data-del',true);
}

function CancelClick(){
    ElementHider(event.target.parentNode, false);
    event.target.parentNode.parentNode.querySelectorAll('.errorentry').forEach(ele=>ele.classList.remove('errorentry'));
    EditMode(event.target.parentNode.parentNode, false,true);
}
async function ConfirmClick(){
    let data = new FormData();
    let row = event.target.parentNode.parentNode; 
    if(event.target.parentNode.querySelector('.confirmbtn').getAttribute('data-del')=='true'){ 
        data.append('id',row.querySelector('.id').innerText);
        data.append('delete',true);
        data.append('img',row.querySelector('#img>img').getAttribute('src'))
        fetch('./ajax.php',{
            method: 'POST',
            body: data
        }).
            then(res => res.text()).then(res=>{GetData();});
    }
    else{ 
        if(CheckError(row)){
            alert('Найдены ошибки');
            return;
        }
        ElementHider(event.target.parentNode, false);
        data.append('id',row.querySelector('.id').innerText);
        let img = row.querySelector('#img>input');
        if(img.value!='')
            data.append('img',img.files[0]);
        data.append('name',row.querySelector('.name').value);
        data.append('brand',row.querySelector('.selecter>#brands').value);
        data.append('desc',row.querySelector('.desc-box').value);
        data.append('price',row.querySelector('.price').value);
        data.append('updatetable',1);
        fetch('./ajax.php',{
            method: 'POST',
            body: data
        }).
            then(res => res.text()).then(result=>{if(result.length>3) alert(result) ;GetData()});
    }
}


window.onload=()=>GetData();

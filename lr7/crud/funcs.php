<?php 
function GenerateImgName(&$img){
    $fullfilename = $img['name'];
    $filename = preg_replace('/(\.\w{3,4}$)/ui','',$fullfilename);
    $arr = preg_split('/\./ui',$fullfilename);
    $filext = array_pop($arr);   
    if(file_exists('../images/items/'.$img['name'])){
        for($i=1;;$i++)
            if(!file_exists('../images/items/'.$filename.'('.$i.').'.$filext)){
                $fullfilename = $filename.'('.$i.').'.$filext;
                break;
            }
    }
    return $fullfilename;
}

function SaveImg(&$fullfilename, &$img){  
        move_uploaded_file($img['tmp_name'],'../images/items/'.$fullfilename); 
}
?>
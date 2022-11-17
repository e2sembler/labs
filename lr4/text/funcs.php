<?php 
//5 9 15 17


function DoTheStuffIamTheStuff($text){ 
 $wordcounterarr = array();
 $text = Job9($text);
 $text = Job5($text);
 $text = Job17($text,$wordcounterarr);
 $text = Job15($text,$wordcounterarr);
 return $text;
}

/*  Тире, вставленное минусом между двумя пробелами заменять на среднее тире (&ndash;), двойной
/*  минуc между пробелами заменять на &mdash; и привязывать его к предыдущему слову неразрывным
/*  пробелом. */
function Job5($text){
    $text = preg_replace('/(\s-\s)/u',"&nbsp;&ndash; ",$text);
    $text = preg_replace('/(\s--\s)/u','&nbsp;&mdash; ', $text); 
    return $text;
};


/*  Удалить лишние пробелы между дефисом в местоимениях и наречиях (напр.: кто- то, заменится на
/*  кто-то). Удаление пробелов перед точками, запятыми и двоеточиями в тексте, Добавить пробел после
/*  этих знаков препинания (если его нет).*/

function Job9($text){
    $text = preg_replace('/(\s+?-\s+?((?=либо)|(?=нибудь)|(?=то)))/ui','-', $text);  
    $text = preg_replace('/(\s((?=\;)|(?=\.)|(?=\,)))/u','', $text);
    $text = preg_replace('/(((?<=\;)|(?<=\.)|(?<=\,))(?!\s))/u',' ', $text); 
    return $text;
}


/*  Предметный указатель. Посчитать все разные слова в тексте, за исключением предлогов и союзов
/*  русского языка, и наиболее частые 100 вывести с количеством (сколько раз встречается в тексте).
/*  Нажатие на слово должно перекидывать на первое вхождение слова в текст. Функцию str_word_count
/*  использовать нельзя.*/

function Job15($text, &$wordcounterarr){
    if(empty($wordcounterarr)) return $text;
    $counterres='<br><h2>Список повторяющихся слов</h2><br>';
    arsort($wordcounterarr);
    $keys = array_keys($wordcounterarr);
    for($i=0; $i<100&&$i<count($wordcounterarr); $i++){
        $word = $keys[$i];
        if($wordcounterarr[$word]<2) continue;
        $text = preg_replace("/(\b".$word."\b)/ui","<p id='".$word."'>".$word."</a>",$text,1);
        $counterres.=" <a href='#".$word."'>".($i+1).") ".$word." = ".$wordcounterarr[$word].";</a> ";
    }
    $text.= '<div id="countres">'.$counterres.'</div>';
    return $text; 

}




// 17 - Подсветить в тексте технические повторы. Если дважды подряд вставлено одно и то же слово, 
// второе вхождение должно быть подсвечено желтым фоном. Если слово вставлено 3, 4, более раз 
// подряд, все вхождения после первого подсвечиваются.

function Job17($text,&$wordcounterarr){ 
    $cleanedtext = strip_tags($text);
    $cleanedtext = preg_replace("/(\&nbsp\;)|(\&ndash\;)/ui"," ",$cleanedtext);
    $words = preg_split('/([^\w+]+|\bно\b|\bв\b|\bесли\b|\bи\b|\bпо\b|\bа\b|\bже\b|\d+|\b\w{1,3}\b)/ui',mb_strtolower($cleanedtext));
    foreach ($words as $word){
        if(empty($word))continue;
        if(!isset($wordcounterarr[$word])) {
            $wordcounterarr[$word]=1; continue;}
        if($wordcounterarr[$word]==1){
            $text = preg_replace('/\b('.$word.')\b/ui','<my-yellow>'.$word.'</my-yellow>',$text);  
            $text = preg_replace('/<my-yellow>'.$word.'<\/my-yellow>/ui',$word,$text,1);  
        }
        $wordcounterarr[$word]++;
    }
    error_log(count($wordcounterarr));
    return $text; 
}

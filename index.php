<?php
set_time_limit(0);
$pdo = new PDO("mysql: host=localhost; dbname=parser","root","");
 require_once("simple_html_dom.php");   
//  echo $code =  file_get_contents("https://proxy12.online.ua/oboi/r2-d1/004/223/035/view4bbb2472be57e.jpg");
//  file_put_contents("picture.jpg",$code );
    


//$html = file_get_html('https://oboi.online.ua/windows/');
//$array = $html->find('.inner a');
//
//foreach($array as $k=>$v){
//  $l = "https://oboi.online.ua". $v->href;
//  $link = $pdo->prepare("INSERT INTO pages (link) VALUES (?)");
//  $link->bindParam(1,$l);
//  $link->execute();
//}

$data = $pdo->prepare(" SELECT * FROM pages ");
$data->execute();
$pages = $data->fetchAll();
//print_r($pages);
    foreach($pages as $k=>$v){
      $html =  file_get_html($v['link']);
     $arr =   $html->find('.image a img');
        foreach($arr as $key=>$val){
//            echo $val->src;
           $img =  $pdo->prepare("INSERT INTO images (link) VALUES (?)");
        $img->bindParam(1,$val->src);
        $img->execute();
        }
    }
?>
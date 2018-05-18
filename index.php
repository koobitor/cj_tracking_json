<?php

require('simple_html_dom.php');

$url = "http://thagnexs.cjkx.net/web/g_info.jsp?slipno=".$_REQUEST['no'];
$html = str_get_html(file_get_contents($url));

$mapping = ["date","time","agent","status","etc"];
$status = [];
foreach($html->find('table',-1)->find('tr') as $item => $table){
  if($item != 0){
    $temp = [];
    foreach($table->find('td') as $index => $line){
      $temp[$mapping[$index]] = str_replace("&nbsp;","",$line->plaintext);
    }
    $status[] = $temp;
  }
}

print_r(json_encode($status));
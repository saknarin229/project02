<?php

session_start();
ob_start();

include_once('Connections/DataBcon.php');
include_once('optionclass/option.class.php');

$file = scandir('actionclass');
foreach($file as $item){
    if($item !== '.' && $item !== '..'){
        include_once("actionclass/$item"); //โหลด form class มาเก็บไว้เรียกให้งาน
    }
}


include_once('layout/layout.php'); // โหลด form มาแสดงผล
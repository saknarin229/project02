<?php

session_start();
ob_start();

include_once('Connections/DataBcon.php');
include_once('optionclass/option.class.php');

$file = scandir('actionclass');
foreach($file as $item){
    if($item !== '.' && $item !== '..'){
        include_once("actionclass/$item");
    }
}


include_once('layout/layout.php');
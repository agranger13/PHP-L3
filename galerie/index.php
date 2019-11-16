<?php
    $images = scandir ("Images");
    foreach($images as $i){
        if($i != "." || $i != ".."){
            echo $i;
        }
    }
?>
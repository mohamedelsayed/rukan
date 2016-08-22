<?php if(isset($string)){
    $new_string = trim(trim($string, '<p>'), '</p>');
    echo $new_string;  
}?>
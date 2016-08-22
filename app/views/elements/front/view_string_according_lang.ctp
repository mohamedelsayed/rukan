<?php if(isset($str_en)){
    $item_value = '';    
    $item_value_default = $str_en;                        
    if($site_lang == 'ar'){
        if(isset($str_ar))
        $item_value = $str_ar;
    }
    if(trim($item_value) == ''){
        $item_value = $item_value_default;
    }
    echo $item_value;
}
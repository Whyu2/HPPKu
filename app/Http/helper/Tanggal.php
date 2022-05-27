<?php 
function formatDate($date = '', $format = 'd F Y'){
    if($date == '' || $date == null)
        return;
        
    return date($format,strtotime($date));
}

function formatDatebulan($date = '', $format = 'm/Y'){
    if($date == '' || $date == null)
        return;
        
    return date($format,strtotime($date));
}
function formatawaltahun($date = '', $format = 'Y-m-d'){
    if($date == '' || $date == null)
        return;
        
    return date($format,strtotime($date));
}
?>


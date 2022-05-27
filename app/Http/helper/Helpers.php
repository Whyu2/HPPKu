<?php
if (!function_exists('formatIDR')){
    function formatIDR($value){
        return "Rp. " . number_format($value,0,',','.');
    }
}
if (!function_exists('titik')){
    function titik($value){
        return " " . number_format($value,0,',','.');
    }
}
?>
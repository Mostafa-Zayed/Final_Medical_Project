<?php

if (! function_exists('create_sidebar')) 
{
    function create_sidebar(array $sidebar, $prefix): string
    {
        
        $items = '';
        foreach ($sidebar as $icon => $value) {
            $items .= "<li><a href='{$prefix}{$value}/view.php'><i class='fa fa-$icon'></i>".ucfirst($value)."</a></li>";
            
        }
        return $items;
    }
}
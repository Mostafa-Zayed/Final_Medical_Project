<?php 
setcookie('name','mostafa',time() + 60*60);
/**
* This Function To Remove Spaces bettween string
*
* @param string $input
* @return string
*/
function remove_spaces($input) : string
{
	return implode('',explode(' ',trim($input)));
}

//echo remove_spaces(" tesing now if you can it");
$names = array(1,2,3,4,5,5,555);

print_r(array_values($names));
?>
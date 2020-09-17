<?php

/**
* This Function To Remove spaces in first and end of text and incode html tages
* 
* @param string $input
* @return string
*/
function prepare_input(string $input): string
{
	return trim(htmlspecialchars($input));
}

/**
* This Function To Redirect To The given Path
*
* @param string $path
* @return void
*/
function redirect(string $path): void 
{
	header('location:'.WEBSITE_URL.$path);
}

/**
 * This Function To Return Global Variables From Array
 * 
 * @param array $data
 * @return void
 */
function decomposed_array(array $data): void
{
	foreach($data as $key => $value){
		GLOBAL $$key;
		 $$key = prepare_input($value);
	 }
}
?>
<?php
function filled_out($form_vars){
	foreach ($form_vars as $key => $value)
	{

//echo "key is $key, value is $value <br />";		
		if(((!isset($key)) || $value == "")&&$key!="id"){

//echo "not setted key is $key, value is $value <br />";		

	return false;
}
	}
	return true;
}
?>

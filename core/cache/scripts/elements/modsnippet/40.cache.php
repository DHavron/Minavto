<?php  return '$phone = isset($phone) ? $phone : \'\';
if ($phone)	{ 
	$phone = \'+\'. preg_replace("/\\D/","",$phone);
}
return $phone;
return;
';
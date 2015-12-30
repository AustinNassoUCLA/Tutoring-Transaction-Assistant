<?

//SET SERVER SETTINGS HERE!
$server = "localhost"; 
$user = "root"; 
$pass = "root";
$db = "BBTest_Transactions"; 

//READABLITY FUNCTIONS
function timeDB2Readable($time)
{
	$PM = "AM";
	$time_str = substr($time, 0 , 5); 
	$hour = intval(substr($time_str, 0, 2)); 
	if ($hour > 11)
	{
		$PM = "PM";
		if ($hour > 12)
			$hour -= 12;
	}
	$minute = substr($time_str, 2 , 3); 
	return "{$hour}" . $minute . $PM;
}

function timeReadable2DB($time, $PM)
{
	if (strlen($time) == 5)
	{
		$hour = intval(substr($time, 0, 2));
		$minute = substr($time, 2, 3); 
	}
	else
	{
		$hour = intval(substr($time, 0, 1));
		$minute = substr($time, 1, 3); 
	}
	
	if ($PM == "PM" && $hour != 12)
		$hour += 12; 
	
	if ($hour > 9)
		return $hour . $minute . ":00"; 
	else
		return "0" . $hour . $minute . ":00"; 
}

function dateDB2Readable($date)
{
	$year = substr($date, 2, 2); 
	$month = substr($date, 5, 2); 
	$day = substr($date, 8, 2);
	
	return $month . "/" . $day . "/" . $year; 
}

function dateReadable2DB($date)
{
	$month = substr($date, 0, 2); 
	$day = substr($date, 3, 2); 
	$year = substr($date, 6, 2);
	
	return "20" . $year . "-" . $month . "-" . $day; 
}
?>
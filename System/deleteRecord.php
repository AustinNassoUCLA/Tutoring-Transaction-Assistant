<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?
echo "<h1>Data could not be deleted.</h1>";
include 'config_transactions.php';
$conn = mysql_connect($server, $user, $pass);
mysql_select_db($db); 

$query = "DELETE FROM Transactions WHERE IDNum = '{$_POST['idnum']}'"; 
$return_value = mysql_query($query, $conn); 
if (!$return_value)
	die("<h1>Data could not be deleted.</h1>" . mysql_error()); 
mysql_close($conn);
?>
</body>
</html>
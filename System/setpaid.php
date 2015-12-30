<?
include 'config_transactions.php';
$conn = mysql_connect($server, $user, $pass);
mysql_select_db($db); 


$type = $_POST['type'];
$id = $_POST['id']; 

if ($type == 'client')
	$sql = "UPDATE Transactions SET PaymentReceived=\"Y\" WHERE cid=\"{$id}\""; 
else
	$sql = "UPDATE Transactions SET PaidTutor=\"Y\" WHERE tid=\"{$id}\""; 
	
$return_value = mysql_query($sql, $conn); 
if (!$return_value)
	echo "Failed.";
else
{
	$num_rows = mysql_affected_rows();
	if ($num_rows == 1)
		echo "1 record successfully updated!";
	else
		echo "{$num_rows} records successfully updated!";
}

mysql_close($conn);
?>
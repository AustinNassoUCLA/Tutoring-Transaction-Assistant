<?
include 'config_transactions.php';
$conn = mysql_connect($server, $user, $pass);
mysql_select_db($db); 

$p_time = timeReadable2DB($_POST['time'], $_POST['pm']);
$p_date = dateReadable2DB($_POST['date']);

$client_last = $_POST['last'];
$client_first = $_POST['first'];
$tutor_last = $_POST['tutorlast'];
$tutor_first = $_POST['tutorfirst'];

$tutor_found = 0;
$client_found = 0;

$tutor_query = "SELECT tid FROM Tutor WHERE First='{$tutor_first}' AND Last='{$tutor_last}'"; 
$client_query = "SELECT cid FROM Client WHERE First='{$client_first}' AND Last='{$client_last}'"; 

$client_ret=mysql_query($client_query, $conn);
if (mysql_num_rows($client_ret)==0)
	echo "Error: Client not found in database.";
else
{
	$client=mysql_fetch_assoc($client_ret); 
	$cid=$client[cid];
	$client_found = 1;
}
	
$tutor_ret=mysql_query($tutor_query, $conn);
if (mysql_num_rows($tutor_ret)==0)
	echo "Error: Tutor not found in database.";
else
{
	$tutor=mysql_fetch_assoc($tutor_ret); 
	$tid=$tutor[tid];	
	$tutor_found = 1;
}


if ($tutor_found && $client_found){
$query = "UPDATE Transactions SET  BillingCycle='{$_POST['billing']}', tid='{$tid}', cid='{$cid}', Time = '{$p_time}', Date = '{$p_date}', AmountCharged = '{$_POST['amountCharged']}', AmountPaidTutor='{$_POST['amountPay']}', PaymentReceived = '{$_POST['paymentReceived']}', PaidTutor =  '{$_POST['paidTutor']}', MoneyRequest = '{$_POST['moneyRequested']}', Status = '{$_POST['status']}'  WHERE IDNum = '{$_POST['idnum']}'";
$return_value = mysql_query($query, $conn); 
if (!$return_value)
	die("<h1>Data could not be added.</h1>" . mysql_error()); 
else
	echo "Record successfully updated!";
}
mysql_close($conn);
?>
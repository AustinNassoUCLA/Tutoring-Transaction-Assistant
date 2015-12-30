<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Transactions Manager Assistant</title>
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css" />
</head>
<body>
<script type="text/javascript"> 
var editIndex = new Object(); 

function toggleMoneyStats()
{
	$("#moneyStats").toggle();
}
function addRecord()
{
	document.getElementById("addTrans").style.display = "block"; 
}

function cancel()
{
	document.getElementById("new_transaction").reset();
	document.getElementById("addTrans").style.display = "none"; 
}

function paid(id, type)
{
	var r = confirm("Are you sure?")
	if (r)
	{ 
		$.ajax({
        url: "setpaid.php",
        type: "POST",
		dataType: "text",
        data: {'id': id, 'type': type},
		success: function(text){alert(text); location.reload()}});
	}
}

function validateEdit(id)
{
	var submit = true; 
	var textRx = /^[a-z]+$/i;
	var numRx = /^[0-9]+(\.[0-9]+)?$/;
	var timeRx = /^(10|11|12|[1-9]):[0-5][0-9]$/; 
	var dateRx = /^(10|11|12|0[1-9])\/[0-3][0-9]\/[0-9][0-9]$/; 
	
	if (!textRx.test(document.getElementById(id + "last_edit").value))
	{
		document.getElementById(id + "last_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "last_edit").style.backgroundColor = "white";
		
	if (!textRx.test(document.getElementById(id + "first_edit").value))
	{
		document.getElementById(id + "first_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "first_edit").style.backgroundColor = "white";
		
	if (!textRx.test(document.getElementById(id + "tutorlast_edit").value))
	{
		document.getElementById(id + "tutorlast_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "tutorlast_edit").style.backgroundColor = "white";
		
	if (!textRx.test(document.getElementById(id + "tutorfirst_edit").value))
	{
		document.getElementById(id + "tutorfirst_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "tutorfirst_edit").style.backgroundColor = "white";
		
	if (!dateRx.test(document.getElementById(id + "date_edit").value))
	{
		document.getElementById(id + "date_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "date_edit").style.backgroundColor = "white";
		
	if (!timeRx.test(document.getElementById(id + "time_edit").value))
	{
		document.getElementById(id + "time_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "time_edit").style.backgroundColor = "white";
		
	if (!numRx.test(document.getElementById(id + "charged_edit").value))
	{
		document.getElementById(id + "charged_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "charged_edit").style.backgroundColor = "white";
		
	if (!numRx.test(document.getElementById(id + "paytutor_edit").value))
	{
		document.getElementById(id + "paytutor_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "paytutor_edit").style.backgroundColor = "white";
		
	if (!numRx.test(document.getElementById(id + "requested_edit").value))
	{
		document.getElementById(id + "requested_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "requested_edit").style.backgroundColor = "white";
		
	if (!numRx.test(document.getElementById(id + "billing_edit").value))
	{
		document.getElementById(id + "billing_edit").style.backgroundColor = "red";
		submit =  false; 
	}
	
	else
		document.getElementById(id + "billing_edit").style.backgroundColor = "white";
		
	var received = "N";
	var paidtutor = "N";
	if (document.getElementById(id + "paidtutor_edit").checked)
		paidtutor = "Y";
	if (document.getElementById(id + "received_edit").checked)
		received = "Y";
		
	if (submit) {
		if (confirm("Are you sure you want to edit this record?")){
        confirmEdit(document.getElementById(id).getAttribute("data-IDNum"), document.getElementById(id + "billing_edit").value, document.getElementById(id + "last_edit").value, document.getElementById(id + "first_edit").value, document.getElementById(id + "tutorlast_edit").value, document.getElementById(id + "tutorfirst_edit").value, document.getElementById(id + "date_edit").value, document.getElementById(id + "time_edit").value, document.getElementById(id + "charged_edit").value, document.getElementById(id + "paytutor_edit").value, received, paidtutor,document.getElementById(id + "requested_edit").value, document.getElementById(id + "status_edit").value, document.getElementById(id + "PM").value);
    }} else {
        alert("This record remains unchanged");
    }
}

function confirmEdit(idnum, billing, last, first, tutorlast, tutorfirst, date, time, amountCharged, amountPay, paymentReceived, paidTutor, moneyRequested, status, pm)
{
	$.ajax({
        url: "editRecord.php",
        type: "POST",
		dataType: "text",
        data: {'idnum': idnum, 'billing': billing, 'last': last, 'first': first, 'date': date, 'tutorlast': tutorlast,'tutorfirst': tutorfirst, 'time': time, 'amountCharged': amountCharged, 'amountPay':amountPay, 'paymentReceived': paymentReceived, 'paidTutor': paidTutor, 'moneyRequested':moneyRequested, 'status':status, 'pm':pm},
		success: function(text){alert(text); location.reload()}});
}

function cancelEdit(id)
{
	document.getElementById(id).innerHTML = editIndex[id];
}

function edit_active(id)
{
	editIndex[id] = document.getElementById(id).innerHTML;
	var children = document.getElementById(id).childNodes; 
	var status = children[13].innerHTML;
	var received = children[10].innerHTML == "N";
	var paidtutor = children[11].innerHTML == "N";
	var ampm = children[7].innerHTML.substring((children[7].innerHTML.toString()).length - 2, (children[7].innerHTML.toString()).length); 
	 
	document.getElementById(id).innerHTML = '<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"><td>' + children[0].innerHTML + '</td><td><input type="number" id="' + id + 'billing_edit" size="7" value="' + children[1].innerHTML + '"></td><td><input name="last_edit" id="' + id + 'last_edit" value="' + children[2].innerHTML + '"type="text" size="10" /> </td><td><input name="first_edit" id="' + id + 'first_edit" value="' + children[3].innerHTML + '"type="text" size="10" /> </td><td><input name="tutorlast_edit" id="' + id + 'tutorlast_edit" value="' + children[4].innerHTML + '"type="text" size="10"/><td><input name="tutorfirst_edit" id="' + id + 'tutorfirst_edit" value="' + children[5].innerHTML + '"type="text" size="10"/> </td><td><input name="date_edit" id="' + id + 'date_edit" value="' + children[6].innerHTML + '"type="text" maxlength="8" size="8" /> </td><td><input size="3" maxlength="5" name="time_edit" id="' + id + 'time_edit" value="' + children[7].innerHTML.substring(0, (children[7].innerHTML.toString()).length - 2)  + '"type="text" maxlength="7" size="7" /><select style="display:inline-block" id="' + id + 'PM" name="PM"><option value="PM">PM</option><option value="AM">AM</option></select></td><td><input id="' + id + 'charged_edit" name="charged_edit" value="' + children[8].innerHTML + '" size="10" type="number" /> </td><td><input id="' + id + 'paytutor_edit" name="paytutor_edit" value="' + children[9].innerHTML + '"size="10" type="number" /> </td><td><input id="' + id + 'received_edit" type="checkbox" name="received" value="YES" /></td><td><input id="' + id + 'paidtutor_edit" type="checkbox" name="paidtutor" value="YES" /></td><td><input id="' + id + 'requested_edit" name="requested_edit" value="' + children[12].innerHTML + '" size="10" type="number" /> </td><td><select name="status" id="' + id + 'status_edit"><option value="C">C</option><option value="B">B</option><option value="X">X</option></select></td><td><button class="button-med" onclick="validateEdit(\''+id+'\')">Confirm</button></td><td><button class="button-med" onclick="cancelEdit(\''+id+'\')">Cancel</button></td></form>';
	
	if (received)
		document.getElementById(id + "received_edit").checked = false;  
	else
		document.getElementById(id + "received_edit").checked = true;
		
	if (paidtutor)
		document.getElementById(id + "paidtutor_edit").checked = false;  
	else
		document.getElementById(id + "paidtutor_edit").checked = true; 
		
	if (ampm == "AM")
		document.getElementById(id + "PM").value = "AM";
		
	document.getElementById(id + "status_edit").value = status;
}




function copyRecord(cid, tid, date, time, amountCharged, amountPay, paymentReceived, paidTutor, moneyRequested, status, billing)
{
	document.getElementById("client").value = cid; 
	document.getElementById("tutor").value = tid; 
	document.getElementById("date").value = date;
	ampm = time.substr(time.length - 2, time.length); 
	document.getElementById("PM").value = ampm; 
	time = (time.length == 7 ? time.substr(0, 5) : time.substr(0, 4));  
	document.getElementById("time").value = time; 
	document.getElementById("charged").value = amountCharged; 
	document.getElementById("payTutor").value = amountPay;
	document.getElementById("billingcycle").value = billing; 
	if (paidTutor == "Y")
		document.getElementById("paidtutor").checked = true;
	else
		document.getElementById("paidtutor").checked = false; 
		
	if (paymentReceived == "Y")
		document.getElementById("received").checked = true;
	else
		document.getElementById("received").checked = false; 
		
	document.getElementById("requested").value = moneyRequested; 
	document.getElementById("status").value = status; 
}

function currentDateSet()
{
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yy = today.getFullYear();
	year = yy.toString(); 
	year = year.substr(2, 2); 

	if(dd<10) {
    	dd='0'+dd
	} 

	if(mm<10) {
    	mm='0'+mm
	} 

	today = mm+'/'+dd+'/'+year;
	document.getElementById("date").value = today; 	
}

function delete_record_confirm(recordNum, idnum)
{
	
	if (confirm("Are you sure you want to delete Record " + recordNum + "?") == true) {
        delete_record(idnum); 
    } else {
        x = "Record " + recordNum + " remains.";
    }
}

function delete_record(idnum)
{
	$.ajax({
        url: "deleteRecord.php",
        type: "POST",
		dataType: "json",
        data: {'idnum': idnum}})
		success: alert("Record deleted!"); location.reload();
}
</script>
<?
include 'config_transactions.php';

//ERROR VAR
$lastNameSet = 1; 
$firstNameSet = 1; 
$tutorSet = 1; 
$timeSet = 1; 
$dateSet = 1; 
$amountChargedSet = 1;
$amountPaidTutorSet = 1; 
$moneyRequestSet = 1; 
$billingSet = 1; 

$conn = mysql_connect($server, $user, $pass);
if (!$conn)
{
	 die("<h1>An error occurred.</h1>" . mysql_error()); 	
}

mysql_select_db($db); 
$query = "SELECT IDNum, Transactions.cid, Transactions.tid, BillingCycle, Client.Last AS LastName, Client.First AS FirstName, Tutor.First as TutorFirst, Tutor.Last as TutorLast, Time, Date, AmountCharged, AmountPaidTutor, PaymentReceived, PaidTutor, MoneyRequest, Status FROM Transactions inner join Client on Transactions.cid = Client.cid inner join Tutor on Transactions.tid = Tutor.tid ORDER BY Date ASC, Time ASC"; 
$return_value = mysql_query($query, $conn); 
if (!$return_value)
{
	die("<h1>Data could not be loaded.</h1>" . mysql_error()); 
}

if(isset($_POST['submit'])) 
{
	//TO DO: VALIDATE ALL FIELDS WITH REGEX AND DETERMINE BILLING CYCLE FROM A SET DATE AND ADD MECHANISM TO EDIT AND DELETE TRANSACTION RECORDS
	
	
	$submitted = 1; 
	
	$p_cid = $_POST['client'];
	$p_tid = $_POST['tutor'];
	$p_time = $_POST['time'];
	$p_ampm = $_POST['PM']; 
	$p_date = $_POST['date'];
	$p_charged = $_POST['charged'];
	$p_payTutor = $_POST['payTutor'];
	$p_requested = $_POST['requested'];
	$p_status = $_POST['status'];
	$p_paidTutor = $_POST['paidtutor']; 
	$p_received = $_POST['received']; 
	$p_billing = $_POST['billingcycle']; 
	

	if(!isset($p_tid))
		$p_tid = 0;
	
	if(!isset($p_time) || trim($p_time) == '')
	{
		$timeSet = 0; 
		$submitted = 0; 
	}
	
	//CONVERT TO DATABASE READABLE TIME
	else
	{
		if (preg_match("/^([0-9]|1[012]):[0-5][0-9]$/", trim($p_time)))
			$p_time = timeReadable2DB($p_time, $p_ampm);
		else
		{
			$timeSet = 0; 
			$submitted = 0; 
		}
	}
	
	if(!isset($p_date) || trim($p_date) == '')
	{
		$dateSet = 0; 
		$submitted = 0; 
	}
	
	//CONVERT TO DATABASE READABLE DATE
	else
	{
		if (preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{2}$/", trim($p_date)))
			$p_date = dateReadable2DB($p_date);
		else
		{
			$dateSet = 0; 
			$submitted = 0; 
		}
	}
	
	if(!isset($p_charged) || trim($p_charged) == '')
	{
		$amountChargedSet = 0; 
		$submitted = 0; 
	}
	
	else
	{
		if (!preg_match("/^[0-9]+(\.[0-9][0-9]?)?$/", trim($p_charged)))
		{
			$amountChargedSet = 0; 
			$submitted = 0; 
		}
	}
	
	if(!isset($p_payTutor) || trim($p_payTutor) == '')
	{
		$amountPaidTutorSet = 0; 
		$submitted = 0; 
	}
	
	else
	{
		if (!preg_match("/^[0-9]+(\.[0-9][0-9]?)?$/", trim($p_payTutor)))
		{
			$amountPaidTutorSet = 0; 
			$submitted = 0; 
		}
	}
	
	if(!isset($p_requested) || trim($p_requested) == '')
	{
		$moneyRequestSet = 0; 
		$submitted = 0; 
	}
	
	else
	{
		if (!preg_match("/^[0-9]*$/", trim($p_requested)))
		{
			$moneyRequestSet = 0;  
			$submitted = 0; 
		}
	}
	
	if(!isset($p_billing) || trim($p_billing) == '')
	{
		$billingSet = 0; 
		$submitted = 0; 
	}
	
	else
	{
		if (!preg_match("/^[0-9]*$/", trim($p_billing)))
		{
			$billingSet = 0;  
			$submitted = 0; 
		}
	}
	
	if ($p_received  == "YES")
		$p_received = "Y"; 
	else
		$p_received = "N"; 
		
	if ($p_paidTutor == "YES")
		$p_paidTutor = "Y"; 
	else
		$p_paidTutor = "N";
		
	
	$sql = "INSERT INTO Transactions (BillingCycle, tid, cid, Time, Date, AmountCharged, AmountPaidTutor, PaymentReceived, PaidTutor, MoneyRequest, Status) VALUES('{$p_billing}', '{$p_tid}', '{$p_cid}', '{$p_time}', '{$p_date}', {$p_charged}, {$p_payTutor}, '{$p_received}', '{$p_paidTutor}', {$p_requested}, '{$p_status}')"; 
	
	
	//REDIRECTS TO CURRENT PAGE SO THAT SUBMITTED TRANSACTIONS CANNOT BE RESUBMITTED WITH PAGE REFRESH
	if ($submitted)
	{
		$return_value = mysql_query($sql, $conn);
		//if (!$return_value)
			//die("<h1>ERROR OCCURRED: (1, '{$p_lastName}', '{$p_firstName}', '{$p_tutor}', {$p_time}, {$p_date}, {$p_charged}, {$p_payTutor}, '{$p_received}', '{$p_paidTutor}', {$p_requested}, '{$p_status}')</h1>"); 
		mysql_close($conn);
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		echo "<meta http-equiv=refresh content=\"0; URL='{$url}'";
	}
}


?>

<button class="button-large" onclick="addRecord()">Add transaction</button>
<button class="button-large" onclick="cancel()">Cancel</button>
<div id="addTrans" style="display: none; width: 500px; height: 400px; padding-left: 40px; padding-top: 10px;"> 
<h1> Add transaction </h1>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" id="new_transaction">
Client: <? 
$sql="SELECT First, Last, cid FROM Client"; 
$client_ret = mysql_query($sql, $conn);

echo "<select name='client' id='client'>";
while($row = mysql_fetch_array($client_ret, MYSQL_ASSOC))
{
	echo "<option value='{$row[cid]}'>{$row[First]} {$row[Last]}</option>";
}
echo "</select>";

?> </br>
Tutor: <? 
$sql="SELECT First, Last, tid FROM Tutor"; 
$tutor_ret = mysql_query($sql, $conn);

echo "<select name='tutor' id='tutor'>";
while($row = mysql_fetch_array($tutor_ret, MYSQL_ASSOC))
{
	if ($row[First] != 'Other'){
	echo "<option value='{$row[tid]}'>{$row[First]} {$row[Last]}</option>";
	}
}
echo "</select>";

?> <br />
Date (mm/dd/yy): <input <? if (!$dateSet){echo "class='error'";} ?> type="text" name="date" id="date"><button class="button-small" type="button" onclick="currentDateSet()"> Current </button> </br>
Time: <input <? if (!$timeSet){echo "class='error'";} ?> type="text" name="time" id="time">
<select name="PM" id="PM"> <option value="AM">AM</option><option value="PM">PM</option> </select> <br />
Amount Charged: <input id="charged"<? if (!$amountChargedSet){echo "class='error'";} ?> type="number" name="charged" /> </br>
Amount to Pay Tutor: <input id="payTutor"<? if (!$amountPaidTutorSet){echo "class='error'";} ?>type="number" name="payTutor" /> </br>
Payment Received: <input id="received" type="checkbox" name="received" value="YES" /> </br>
Paid Tutor: <input id="paidtutor" type="checkbox" name="paidtutor" value="YES" /> </br>
Money Requested: <input <? if (!$moneyRequestSet){echo "class='error'";} ?> type="number" name="requested" id="requested"/> </br>
Status: <select name="status" id="status">
    <option value="B">Booked</option>
 	<option value="C">Completed</option>
    <option value="X">Cancelled</option>
  </select>  </br>
Billing Cycle: <input size="3" <? if (!$billingSet){echo "class='error'";} ?> type="number" name="billingcycle" id="billingcycle"/></br>
<input type="submit" name="submit" value="Add Transaction" />
</form>
</div>
<table id="transaction_table">
<tr>
	<th> Transaction No. </th>
	<th> Billing Cycle </th>
	<th> Client Last </th>
	<th> Client First </th>
	<th> Tutor Last</th>
    <th> Tutor First</th>
	<th> Date </th>
	<th> Time </th>
	<th> Amount Charged </th>
	<th> Amount to Pay Tutor </th>
	<th> Payment Received </th>
	<th> Paid Tutor </th>
	<th> Money Requested </th>
	<th> Status </th>
    <th> Edit </th>
    <th> Delete </th>
    <th> Copy </th>
</tr>
<tr>
</tr>
<?
$total_revenue = 0.0; 
$total_profit = 0.0; 
$index = 0; 
while ($row = mysql_fetch_array($return_value, MYSQL_ASSOC))
{
	$index++; 
	
	//IF NOT CANCELLED, ADD TO PROFIT AND REVENUE
	if ($row[Status] != "X")
	{
		$total_revenue += floatval($row[AmountCharged]);
		$total_profit += (floatval($row[AmountCharged]) - floatval($row[AmountPaidTutor]));
	}
	
	
	$newTime = timeDB2Readable($row[Time]);
	$newDate = dateDB2Readable($row[Date]); 
	
	if ($row[Status] == "X")
		$cancelled = "class='X'";
	else
		$cancelled = ""; 
		
	echo "<tr " . $cancelled . " id=\"row_{$index}\" data-IDNum=\"{$row[IDNum]}\" data-cid=\"{$row[cid]}\" data-tid=\"{$row[tid]}\"><td>{$index}</td><td>$row[BillingCycle]</td><td>$row[LastName]</td><td>$row[FirstName]</td><td>$row[TutorLast]</td><td>$row[TutorFirst]</td><td>{$newDate}</td><td>{$newTime}</td><td>$row[AmountCharged]</td><td>$row[AmountPaidTutor]</td><td class='$row[PaymentReceived]'>$row[PaymentReceived]</td><td class='$row[PaidTutor]'>$row[PaidTutor]</td><td>$row[MoneyRequest]</td><td class='$row[Status]'>$row[Status]</td><td><button class='button-med' onclick='edit_active(\"row_{$index}\")'>Edit</button></td><td><button class='button-med' onclick='delete_record_confirm(\"{$index}\", {$row[IDNum]})'>Delete</button></td><td><button class='button-med' onclick='copyRecord(\"{$row[cid]}\", \"{$row[tid]}\", \"{$newDate}\", \"{$newTime}\", {$row[AmountCharged]}, {$row[AmountPaidTutor]}, \"{$row[PaymentReceived]}\", \"{$row[PaidTutor]}\", {$row[MoneyRequest]}, \"{$row[Status]}\", {$row[BillingCycle]})'>Copy</button></td></tr>"; 	
}
?>

</table>
<button class="button-large" onclick="toggleMoneyStats()">Show Total Revenue </button>
<?
echo "<div id=\"moneyStats\" style=\"display: none;\">";
echo "<h2> Total Revenue: \$" . money_format('%i', $total_revenue) . "</h2><h2> Total Profit: \$" . money_format('%i', $total_profit) . "</h2>";
echo "</div>";
?>
<br />

<div class="center">
<div class="inline">
<?
//GET AMOUNT OWED FROM CLIENTS
$query = "SELECT Client.cid AS id, Client.First AS FirstName, Client.Last AS LastName, Client.Email AS Email, SUM(AmountCharged) AS Money from Transactions inner join Client on Client.cid=Transactions.cid WHERE PaymentReceived='N' GROUP BY Client.cid";
$result = mysql_query($query, $conn); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
if ($row)
{
	echo "<h2>Outstanding Balances</h2>";
	echo "<table style='position:relative; bottom:10px; margin-right: 100px;' id='client_owes'><th>First Name</th><th>Last Name</th><th>Money Owed</th><th>Paypal E-mail</th><th>Paid</th>"; 
	do
	{
		echo "<tr><td>$row[FirstName]</td><td>$row[LastName]</td><td>$$row[Money]</td><td>$row[Email]</td><td><button class='button-med' onclick='paid($row[id], \"client\")'>Paid</button></tr>";
	}
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)); 
	echo "</table>";
}
else
	echo "<h2><b>All clients have paid!</b></h2>"; 
	
?>
</div>

<div class="inline">
<?
	
//GET AMOUNT OWED TO TUTORS
$query = "SELECT Tutor.tid AS id, Tutor.First AS FirstName, Tutor.Last AS LastName, Tutor.Email AS Email, SUM(AmountPaidTutor) AS Money from Transactions inner join Tutor on Tutor.tid=Transactions.tid WHERE PaidTutor='N' GROUP BY Tutor.tid";
$result = mysql_query($query, $conn); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
if ($row)
{
	echo "<h2>Pay Tutors</h2>";
	echo "<table id='tutor_owed'><th>First Name</th><th>Last Name</th><th>Money Owed</th><th>Paypal E-mail</th><th>Paid</th>"; 
	do
	{
		echo "<tr><td>$row[FirstName]</td><td>$row[LastName]</td><td>$$row[Money]</td><td>$row[Email]</td><td><button class='button-med' onclick='paid($row[id], \"tutor\")'>Paid</button></tr>";
	}
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)); 
	echo "</table>";
}
else
	echo "<h2><b>All tutors have been paid!</b></h2>"; 

?>
</div>
</div>
</body>
</html>
<?php 
function setBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','mybank');
	$array = $con->query("select * from userAccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}
function setOtherBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','mybank');
	$array = $con->query("select * from otheraccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update otheraccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update otheraccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}
function makeTransaction($action,$amount,$balance,$other)
{
	$con = new mysqli('localhost','root','','mybank');
	if ($action == 'transfer')
	{
		$balance=$balance-$amount;
		return $con->query("insert into transaction (action,debit,balance,other,userId) values ('transfer','$amount','$balance','$other','$_SESSION[userId]')");
	}
	if ($action == 'withdraw')
	{
		$balance=$balance-$amount;
		return $con->query("insert into transaction (action,debit,balance,other,userId) values ('withdraw','$amount','$balance','$other','$_SESSION[userId]')");
		
	}
	if ($action == 'deposit')
	{
		$balance=$balance+$amount;
		return $con->query("insert into transaction (action,credit,balance,other,userId) values ('deposit','$amount','$balance','$other','$_SESSION[userId]')");
	}
}
function makeTransactionCashier($action,$amount,$other,$userId)
{
	$con = new mysqli('localhost','root','','mybank');
	if ($action == 'transfer')
	{
		
		return $con->query("insert into transaction (action,debit,other,userId) values ('transfer','$amount','$other','$userId')");
	}
	if ($action == 'withdraw')
	{

	return $con->query("insert into transaction (action,debit,other,userId) values ('withdraw','$amount','$other','$userId')");
		
	}
	if ($action == 'deposit')
	{
		
		return $con->query("insert into transaction (action,credit,other,userId) values ('deposit','$amount','$other','$userId')");
		
	}
}

?>
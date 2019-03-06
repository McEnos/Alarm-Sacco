<?php

function instant_loan($amount)
{
	$maximum_amount = 3000;
	if ($amount > $maximum_amount)
	{
		echo "Instant Loan can only be a maximum of Ksh 3000";
	}
	$total_amount = $amount * 115;
	return $total_amount;
}

function normal_loan($amount)
{
	
}
?>
<?php
session_start();
require("AuthnetCIM.class.php");
require_once("db.php");
// if(isset($_POST["checkout_auth"]))
// {
	try
	{
		$cim = new AuthnetCIM('8xLvXjp24z','95kv2j6q9qB7KA79',true);
		$email_address=mysqli_real_escape_string($conn, $_POST['email']);
		$description='Monthly Membership No. ' . md5(uniqid(rand(), true));
		$customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);

		// Create Customer Profile

		$cim->setParameter('email',$email_address);
		$cim->setParameter('description',$description);
		$cim->setParameter('merchantCustomerId',$customer_id);
		$cim->createCustomerProfile();

		if($cim->isSuccessful())
		{
			$profile_id=$cim->getProfileID();
		}

		// Print Results Of Request

		echo '<strong>createCustomerProfileRequest Response Summary:</strong>'.$cim->getResponseSummary().'';
		echo'<br>';
		echo '<strong>Profile ID:</strong>'.$profile_id.'';
		echo'<br>';
		echo'<br>';

		// Create Payment Profile

		$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
		$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
		$address =  mysqli_real_escape_string($conn, $_POST['address']);
		$zipCode =  mysqli_real_escape_string($conn, $_POST['zipCode']);
		$phoneNumber =  mysqli_real_escape_string($conn, $_POST['phoneNumber']);
		$creditCardNumber =  mysqli_real_escape_string($conn, $_POST['creditCardNumber']);
		$expiration = (date("Y")+1).'-12';

		$cim->setParameter('customerProfileId',$profile_id);
		$cim->setParameter('billToFirstName',$firstName);
		$cim->setParameter('billToLastName',$lastName);
		$cim->setParameter('billToAddress',$address);
		$cim->setParameter('billToZip',$zipCode);
		$cim->setParameter('billToPhoneNumber',$phoneNumber);
		$cim->setParameter('cardNumber',$creditCardNumber);
		$cim->setParameter('expirationDate',$expiration);
		$cim->createCustomerPaymentProfile();

		if($cim->isSuccessful())
		{
			$payment_profile_id = $cim->getPaymentProfileId();
		}

		// Print Results Of Request
		echo '<strong>createCustomerPaymentProfileRequest Response Summary:</strong> ' .$cim->getResponseSummary() . '';
		echo'<br>';
    	echo '<strong>Payment Profile ID:</strong> ' . $payment_profile_id . '';
    	echo'<br>';
    	echo'<br>';


    	// Create Shipping Profile
    	$cim->setParameter("customerProfileId",$profile_id);
    	$cim->setParameter("shipToFirstName",$firstName);
    	$cim->setParameter("shipToLastName",$lastName);
    	$cim->setParameter("shipToAddress",$address);
    	$cim->setParameter("shipToZip",$zipCode);
    	$cim->setParameter("shipToPhoneNumber",$phoneNumber);
    	$cim->createCustomerShippingAddress();

    	if($cim->isSuccessful())
    	{
    		$shipping_profile_id=$cim->getCustomerAddressId();
    	}

    	// Print Results Of Request
    	echo '<strong>createCustomerShippingAddressRequest Response Summary:</strong> ' .$cim->getResponseSummary() . '';
    	echo'<br>';
    	echo '<strong>Shipping Profile ID:</strong> ' . $shipping_profile_id . '';
    	echo'<br>';
    	echo'<br>';


    	// Process A Transaction
    	$purchase_amount = $_POST["total_price"];
  

    	$cim->setParameter('amount',$purchase_amount);
    	$cim->setParameter('customerProfileId',$profile_id);
    	$cim->setParameter('customerPaymentProfileId',$payment_profile_id);
    	$cim->setParameter('customerShippingAddressId',$shipping_profile_id);
    	$cim->setParameter('cardCode','123');
    	$cim->setLineItem('12', 'test item', 'it lets you test stuff', '1', '1.00');
    	$cim->createCustomerProfileTransaction();

    	if($cim->isSuccessful())
    	{
    		$approval_code = $cim->getAuthCode();
    	}
    	echo '<strong>createCustomerProfileTransactionRequest Response Summary:</strong> ' .$cim->getResponseSummary() . '';
    	echo'<br>';
    	echo '<strong>Approval code:</strong> ' . $approval_code;
    	echo'<br>';
    	echo'<br>'; 
    	echo '<form action="index.php" >
    			<input type="submit" class="btn btn-lg btn-default cartBtn" value="Back To Main Page" />
			</form>';
	}

	catch(AuthCIMException $e)
	{
		echo $e;
		echo $cim;
	}

?>
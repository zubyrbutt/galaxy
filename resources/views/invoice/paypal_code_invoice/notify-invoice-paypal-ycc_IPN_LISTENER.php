<?php 
	include('file_include.php');
	include('includes/invoice_functions.php');
	 $paypalmode = PAYPAL_MODE; //Sandbox for testing or empty ''
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = implode(',',$_REQUEST);
fwrite($myfile, $txt);
fclose($myfile);


$myfile3 = fopen("newfile3.txt", "w") or die("Unable to open file!");
$txt3 = implode(',',$_POST);
fwrite($myfile3, $txt3);
fclose($myfile3);

	

	



	    if($paypalmode=='sandbox')
        {
            $paypalmode     =   '.sandbox';
        }
        $req = 'cmd=' . urlencode('_notify-validate');
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
$myfile4 = fopen("newfile4.txt", "w") or die("Unable to open file!");
$txt4 = $req;
fwrite($myfile4, $txt4);
fclose($myfile4);
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.sandbox.paypal.com'));
        $res = curl_exec($ch);
        curl_close($ch);
       $myfile2 = fopen("newfile2.txt", "w") or die("Unable to open file!");
$txt2 = $res;
fwrite($myfile2, $txt2);
fclose($myfile2);
        if ($res=="VERIFIED")
        {

			$txn_id = $_POST['txn_id'];



//testing
$sql = "INSERT INTO `ipn_data_tbl` ( `item_name`,`payer_email`,`first_name`,`last_name`,`txn_id`,`txn_type`,`payment_status`,`invoice_id` ) VALUES( '".$item_name."','justemail111@text.com','".$first_name."','".$last_name."','".$txn_id."','".$txn_type."','".$payment_status."','".$invoice_id."' ) "; 
			mysql_query($sql) or die(mysql_error()); 
		}	

?>
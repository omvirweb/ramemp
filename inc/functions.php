<?php
function formatFileSize($bytes){
    $bytes = number_format($bytes / 1048576, 2) . ' MB';
    return $bytes;
}
function setPFS($value=false){
	if($value==true){
		echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		print_r($_SERVER);
		echo "</pre>";
		exit;
	}
}
function phpMailerMail($FromDisplay, $FromEmail, $ReplyTo, $ToName, $ToEmail, $myCCList, $myBCCList, $Subject, $HTMLMsg, $TxtMsg, $AttFile, $AttFileName, $AttFileType)
{
	if(isset($ToEmail) && validateEmail($ToEmail))
	{
		require_once("class.phpmailer.php");

		$mail = new PHPMailer();

		# -- prepare mail body
		# --
		
		$message = strip_tags($HTMLMsg);
		//$myMsg = str_replace("\n","",$message);
		$message = str_replace("\t","",$message);
		$message = str_replace("&nbsp;","",$message);

		# --
		
		if(!isset($FromDisplay) || strlen(trim($FromDisplay))==0)
			$FromDisplay = $FromEmail;
		
		if(!isset($ToName) || strlen(trim($ToName))==0)
			$ToName = $ToEmail;

		# -- add ccs
		# ---
		
		if(isset($myCCList) && strlen(trim($myCCList)) > 0)
		{
			$tempCCs = explode(",", $myCCList);
			
			for($c = 0;$c<count($tempCCs);$c++)
				if(validateEmail($tempCCs[$c]))
					$mail->AddCC($tempCCs[$c]);
			}
			
		# ---
			
		# -- add bccs
		# ---
			
			if(isset($myBCCList) && strlen(trim($myBCCList)) > 0)
			{
				$tempBCCs = explode(",", $myBCCList);
				
				for($c = 0;$c<count($tempBCCs);$c++)
					if(validateEmail($tempBCCs[$c]))
						$mail->AddBCC($tempBCCs[$c]);
				}
				
		# --
				
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "mailrelay.webvault.com.au";  // specify main and backup server
		$mail->SMTPAuth = false;     // turn on SMTP authentication
		//$mail->Username = "support@igentechnolabs.com";  // SMTP username
		//$mail->Password = "support123"; // SMTP password

		$mail->FromName = $FromDisplay;
		$mail->From = $FromEmail;
		$mail->AddAddress($ToEmail,$ToName);
		
		# -- if reply to is set, add it.

		if(validateEmail($ReplyTo))
			$mail->AddReplyTo($ReplyTo);

		//$mail->WordWrap = 50;                                 // set word wrap to 50 characters
		
		if(strlen(trim($HTMLMsg)) > 0)
		{
			$mail->IsHTML(true);                                  // set email format to HTML
			$mail->Body = $HTMLMsg;
			
			if(strlen(trim($TxtMsg)) >0)
			{
				$mail->AltBody = $TxtMsg;
			}
			else
			{
				$message = strip_tags($HTMLMsg);
				//$myMsg = str_replace("\n","",$message);
				$message = str_replace("\t","",$message);
				$message = str_replace("&nbsp;","",$message);			

				$mail->AltBody = 	$message;
			}
		}
		else
		{
			$mail->IsHTML(false);
			$mail->Body = $TxtMsg;
		}
		
		$mail->Subject = $Subject;
		
		if(strlen(trim($AttFile))> 0 && file_exists($AttFile))
		{
			$mail -> AddAttachment($AttFile,$AttFileName);
		}
		
		$mail->Send();
		
	}
}

function random_password( $length = 8 ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}

function convert_number_to_words($number) {

	$hyphen      = '-';
	$conjunction = ' and ';
	$separator   = ', ';
	$negative    = 'negative ';
	$decimal     = ' point ';
	$dictionary  = array(
		0                   => 'zero',
		1                   => 'one',
		2                   => 'two',
		3                   => 'three',
		4                   => 'four',
		5                   => 'five',
		6                   => 'six',
		7                   => 'seven',
		8                   => 'eight',
		9                   => 'nine',
		10                  => 'ten',
		11                  => 'eleven',
		12                  => 'twelve',
		13                  => 'thirteen',
		14                  => 'fourteen',
		15                  => 'fifteen',
		16                  => 'sixteen',
		17                  => 'seventeen',
		18                  => 'eighteen',
		19                  => 'nineteen',
		20                  => 'twenty',
		30                  => 'thirty',
		40                  => 'fourty',
		50                  => 'fifty',
		60                  => 'sixty',
		70                  => 'seventy',
		80                  => 'eighty',
		90                  => 'ninety',
		100                 => 'hundred',
		1000                => 'thousand',
		1000000             => 'million',
		1000000000          => 'billion',
		1000000000000       => 'trillion',
		1000000000000000    => 'quadrillion',
		1000000000000000000 => 'quintillion'
	);

	if (!is_numeric($number)) {
		return false;
	}

	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}

	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}

	$string = $fraction = null;

	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}

	switch (true) {
		case $number < 21:
		$string = $dictionary[$number];
		break;
		case $number < 100:
		$tens   = ((int) ($number / 10)) * 10;
		$units  = $number % 10;
		$string = $dictionary[$tens];
		if ($units) {
			$string .= $hyphen . $dictionary[$units];
		}
		break;
		case $number < 1000:
		$hundreds  = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if ($remainder) {
			$string .= $conjunction . convert_number_to_words($remainder);
		}
		break;
		default:
		$baseUnit = pow(1000, floor(log($number, 1000)));
		$numBaseUnits = (int) ($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		if ($remainder) {
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words($remainder);
		}
		break;
	}

	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}

	return $string;
}

function checkURL($value){
	if(!empty($value)){
		if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
			$uri = str_replace(array('http://'), 'https://', $value);
		} else {
			$uri = $value;
		}
	}else{
		$uri = $value;
	}
	return $uri;
}

function get_department($d_id){
    global $link;
	$res = mysqli_query($link,"select d_main from department where d_id = ".$d_id);
	$row = mysqli_fetch_assoc($res);

	return $row["d_main"];
}

function get_department_city($d_id){
    global $link;
	$res = mysqli_query($link,"select d_city from department where d_id = ".$d_id);
	$row = mysqli_fetch_assoc($res);

	return $row["d_city"];
}

function get_department_state($d_id){
    global $link;
	$res = mysqli_query($link,"select d_state from department where d_id = ".$d_id);
	$row = mysqli_fetch_assoc($res);

	return $row["d_state"];
}

function get_department_village($d_id){
    global $link;
	$res = mysqli_query($link,"select d_village from department where d_id = ".$d_id);
	$row = mysqli_fetch_assoc($res);

	return $row["d_village"];
}

function get_employeename($e_id){
    global $link;
	$res = mysqli_query($link,"select e_firstname,e_lastname,e_fathername from employee where e_id = ".$e_id);
	$row = mysqli_fetch_assoc($res);

	return $row["e_firstname"]." ".$row["e_fathername"]." ".$row["e_lastname"];
}

function get_employeedeignation($e_id){
    global $link;
	$res = mysqli_query($link,"select e_current_designation from employee where e_id = ".$e_id);
	$row = mysqli_fetch_assoc($res);

	return $row["e_current_designation"];
}

function get_company($c_id){
    global $link;
	$res = mysqli_query($link,"select c_name from company where c_id = ".$c_id);
	$row = mysqli_fetch_assoc($res);

	return $row["c_name"];
}

function itemname_by_id($i_id){
    global $link;
	$res = mysqli_query($link,"select i_name from items where i_id = ".$i_id);
	$row = mysqli_fetch_assoc($res);

	return $row["i_name"];
}

function itemunit_by_id($i_id){
    global $link;
	$res = mysqli_query($link,"select i_unit from items where i_id = ".$i_id);
	$row = mysqli_fetch_assoc($res);

	return $row["i_unit"];
}

function get_month($m_id){
    if($m_id == "1"){
    	return "Jan";
    }else if($m_id == "2"){
    	return "Feb";
    }else if($m_id == "3"){
    	return "Mar";
    }else if($m_id == "4"){
    	return "Apr";
    }else if($m_id == "5"){
    	return "May";
    }else if($m_id == "6"){
    	return "Jun";
    }else if($m_id == "7"){
    	return "Jul";
    }else if($m_id == "8"){
    	return "Aug";
    }else if($m_id == "9"){
    	return "Sep";
    }else if($m_id == "10"){
    	return "Oct";
    }else if($m_id == "11"){
    	return "Nov";
    }else if($m_id == "12"){
    	return "Dec";
    }
}

function get_month2($m_id){
    if($m_id == "1"){
    	return "January";
    }else if($m_id == "2"){
    	return "February";
    }else if($m_id == "3"){
    	return "March";
    }else if($m_id == "4"){
    	return "April";
    }else if($m_id == "5"){
    	return "May";
    }else if($m_id == "6"){
    	return "June";
    }else if($m_id == "7"){
    	return "July";
    }else if($m_id == "8"){
    	return "August";
    }else if($m_id == "9"){
    	return "Septembet";
    }else if($m_id == "10"){
    	return "October";
    }else if($m_id == "11"){
    	return "November";
    }else if($m_id == "12"){
    	return "December";
    }
}

function get_days_in_month($month, $year)
{
    if ($month == "02")
    {
        if ($year % 4 == 0) return 29;
        else return 28;
    }
    else if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") return 31;
    else return 30;
}
?>
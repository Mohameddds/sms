<?php
session_start();
if(!isset($_SESSION['li7wak']))  { 
          header("Location: index.php");
      }
class NexmoMessage {
	private $nx_key = '';
	private $nx_secret = '';
	var $nx_uri = 'https://rest.nexmo.com/sms/json';
	private $nexmo_response = '';
	var $inbound_message = false;
	public $to = '';
	public $from = '';
	public $text = '';
	public $network = '';
	public $message_id = '';
	public $ssl_verify = false;
	function NexmoMessage ($api_key, $api_secret) {
		$this->nx_key = $api_key;
		$this->nx_secret = $api_secret;
	}




	function sendText ( $to, $from, $message, $unicode=null ) {
	
		// Making sure strings are UTF-8 encoded
		if ( !is_numeric($from) && !mb_check_encoding($from, 'UTF-8') ) {
			trigger_error('$from needs to be a valid UTF-8 encoded string');
			return false;
		}

		if ( !mb_check_encoding($message, 'UTF-8') ) {
			trigger_error('$message needs to be a valid UTF-8 encoded string');
			return false;
		}
		
		if ($unicode === null) {
			$containsUnicode = max(array_map('ord', str_split($message))) > 127;
		} else {
			$containsUnicode = (bool)$unicode;
		}
		
		$from = $this->validateOriginator($from);

		$from = urlencode( $from );
		$message = urlencode( $message );
		
		// Send away!
		$post = array(
			'from' => $from,
			'to' => $to,
			'text' => $message,
			'type' => $containsUnicode ? 'unicode' : 'text'
		);
		return $this->sendRequest ( $post );
		
	}
	
	
	/**
	 * Prepare new WAP message.
	 */
	function sendBinary ( $to, $from, $body, $udh ) {
	
		//Binary messages must be hex encoded
		$body = bin2hex ( $body );
		$udh = bin2hex ( $udh );

		// Make sure $from is valid
		$from = $this->validateOriginator($from);

		// Send away!
		$post = array(
			'from' => $from,
			'to' => $to,
			'type' => 'binary',
			'body' => $body,
			'udh' => $udh
		);
		return $this->sendRequest ( $post );
		
	}
	
	
	/**
	 * Prepare new binary message.
	 */
	function pushWap ( $to, $from, $title, $url, $validity = 172800000 ) {

		// Making sure $title and $url are UTF-8 encoded
		if ( !mb_check_encoding($title, 'UTF-8') || !mb_check_encoding($url, 'UTF-8') ) {
			trigger_error('$title and $udh need to be valid UTF-8 encoded strings');
			return false;
		}
		
		// Make sure $from is valid
		$from = $this->validateOriginator($from);

		// Send away!
		$post = array(
			'from' => $from,
			'to' => $to,
			'type' => 'wappush',
			'url' => $url,
			'title' => $title,
			'validity' => $validity
		);
		return $this->sendRequest ( $post );
		
	}
	private function sendRequest ( $data ) {
		// Build the post data
		$data = array_merge($data, array('username' => $this->nx_key, 'password' => $this->nx_secret));
		$post = '';
		foreach($data as $k => $v){
			$post .= "&$k=$v";
		}

		// If available, use CURL
		if (function_exists('curl_version')) {

			$to_nexmo = curl_init( $this->nx_uri );
			curl_setopt( $to_nexmo, CURLOPT_POST, true );
			curl_setopt( $to_nexmo, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $to_nexmo, CURLOPT_POSTFIELDS, $post );

			if (!$this->ssl_verify) {
				curl_setopt( $to_nexmo, CURLOPT_SSL_VERIFYPEER, false);
			}

			$from_nexmo = curl_exec( $to_nexmo );
			curl_close ( $to_nexmo );

		} elseif (ini_get('allow_url_fopen')) {
			// No CURL available so try the awesome file_get_contents

			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $post
				)
			);
			$context = stream_context_create($opts);
			$from_nexmo = file_get_contents($this->nx_uri, false, $context);

		} else {
			// No way of sending a HTTP post :(
			return false;
		}

		
		return $this->nexmoParse( $from_nexmo );
	 
	}
	
	
	/**
	 * Recursively normalise any key names in an object, removing unwanted characters
	 */
	private function normaliseKeys ($obj) {
		// Determine is working with a class or araay
		if ($obj instanceof stdClass) {
			$new_obj = new stdClass();
			$is_obj = true;
		} else {
			$new_obj = array();
			$is_obj = false;
		}


		foreach($obj as $key => $val){
			// If we come across another class/array, normalise it
			if ($val instanceof stdClass || is_array($val)) {
				$val = $this->normaliseKeys($val);
			}
			
			// Replace any unwanted characters in they key name
			if ($is_obj) {
				$new_obj->{str_replace('-', '', $key)} = $val;
			} else {
				$new_obj[str_replace('-', '', $key)] = $val;
			}
		}

		return $new_obj;
	}


	/**
	 * Parse server response.
	 */
	private function nexmoParse ( $from_nexmo ) {
		$response = json_decode($from_nexmo);

		// Copy the response data into an object, removing any '-' characters from the key
		$response_obj = $this->normaliseKeys($response);

		if ($response_obj) {
			$this->nexmo_response = $response_obj;

			// Find the total cost of this message
			$response_obj->cost = $total_cost = 0;
			if (is_array($response_obj->messages)) {
				foreach ($response_obj->messages as $msg) {
					if (property_exists($msg, "messageprice")) {
						$total_cost = $total_cost + (float)$msg->messageprice;
					}
				}

				$response_obj->cost = $total_cost;
			}

			return $response_obj;

		} else {
			// A malformed response
			$this->nexmo_response = array();
			return false;
		}
		
	}


	
	private function validateOriginator($inp){
		// Remove any invalid characters
		$ret = preg_replace('/[^a-zA-Z0-9]/', '', (string)$inp);

		if(preg_match('/[a-zA-Z]/', $inp)){

			$ret = substr($ret, 0, 11);

		} else {

			// Numerical, remove any prepending '00'
			if(substr($ret, 0, 2) == '00'){
				$ret = substr($ret, 2);
				$ret = substr($ret, 0, 15);
			}
		}
		
		return (string)$ret;
	}

	public function displayOverview( $nexmo_response=null ){
		$info = (!$nexmo_response) ? $this->nexmo_response : $nexmo_response;

		if (!$nexmo_response ) return 'Cannot display an overview of this response';

		// How many messages were sent?
		if ( $info->messagecount > 1 ) {
		
			$status = 'Your message was sent in ' . $info->messagecount . ' parts';
		
		} elseif ( $info->messagecount == 1) {
		
			//$status = 'Your message was sent';
		
		} else {

			return 'There was an error ? sending your message ?';
		}
		
		if (!is_array($info->messages)) $info->messages = array();
		$message_status = array();
		foreach ( $info->messages as $message ) {
			$tmp = array('id'=>'', 'status'=>0);

			if ( $message->status != 0) {
				$tmp['status'] = $message->errortext;
			} else {
				$tmp['status'] = '<img src="https://media.giphy.com/media/lDOBJkpstriNy/giphy.gif" alt="" width="76" height="60" />';
				$tmp['id'] = $message->messageid;
			}

			$message_status[] = $tmp;
		}
		
		
		if (isset($_SERVER['HTTP_HOST'])) {
			foreach ($message_status as $mstat) {
				$ret .= '<div class="alert alert-success" style="padding: 0px 0px 0px 0px;margin-bottom: 10px;text-shadow: rgba(255, 255, 255, 0.5) 0px 1px 0px;background-color: rgb(223, 240, 216);border: 1px solid rgb(214, 233, 198);border-radius: 4px;color: rgb(70, 136, 71);font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 14px;font-style: normal;font-variant-ligatures: normal;font-variant-caps: normal;font-weight: normal;letter-spacing: normal;orphans: 2;text-align: start;text-indent: 0px;text-transform: none;white-space: normal;widows: 2;word-spacing: 0px;-webkit-text-stroke-width: 0px;text-decoration-style: initial;text-decoration-color: initial;">
<big><strong>'.$mstat['status'].'</strong></big> </div> ';
			}
			$ret .= '</table>';

		} else {

			$ret = "$status:\n";

			$out_sizes = array('id'=>strlen('Message ID'), 'status'=>strlen('Status'));
			foreach ($message_status as $mstat) {
				if ($out_sizes['id'] < strlen($mstat['id'])) {
					$out_sizes['id'] = strlen($mstat['id']);
				}
				if ($out_sizes['status'] < strlen($mstat['status'])) {
					$out_sizes['status'] = strlen($mstat['status']);
				}
			}

			$ret .= '  '.str_pad('Status', $out_sizes['status'], ' ').'   ';
			$ret .= str_pad('Message ID', $out_sizes['id'], ' ')."\n";
			foreach ($message_status as $mstat) {
				$ret .= '  '.str_pad($mstat['status'], $out_sizes['status'], ' ').'   ';
				$ret .= str_pad($mstat['id'], $out_sizes['id'], ' ')."\n";
			}
		}

		return $ret;
	}






	public function inboundText( $data=null ){
		if(!$data) $data = $_GET;

		if(!isset($data['text'], $data['msisdn'], $data['to'])) return false;

		$this->to = $data['to'];
		$this->from = $data['msisdn'];
		$this->text = $data['text'];
		$this->network = (isset($data['network-code'])) ? $data['network-code'] : '';
		$this->message_id = $data['messageId'];

		$this->inbound_message = true;

		return true;
	}

	public function reply ($message) {
		if (!$this->inbound_message) {
			return false;
		}

		return $this->sendText($this->from, $this->to, $message);
	}

}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$date1 = date('H:i:s d/m/Y');
$ip = getenv("REMOTE_ADDR");
function Z118_OS($USER_AGENT){
	$OS_ERROR    =   "Unknown OS Platform";
    $OS  =   array( '/windows nt 10/i'      =>  'Windows 10',
	                '/windows nt 6.3/i'     =>  'Windows 8.1',
	                '/windows nt 6.2/i'     =>  'Windows 8',
	                '/windows nt 6.1/i'     =>  'Windows 7',
	                '/windows nt 6.0/i'     =>  'Windows Vista',
	                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	                '/windows nt 5.1/i'     =>  'Windows XP',
	                '/windows xp/i'         =>  'Windows XP',
	                '/windows nt 5.0/i'     =>  'Windows 2000',
	                '/windows me/i'         =>  'Windows ME',
	                '/win98/i'              =>  'Windows 98',
	                '/win95/i'              =>  'Windows 95',
	                '/win16/i'              =>  'Windows 3.11',
	                '/macintosh|mac os x/i' =>  'Mac OS X',
	                '/mac_powerpc/i'        =>  'Mac OS 9',
	                '/linux/i'              =>  'Linux',
	                '/ubuntu/i'             =>  'Ubuntu',
	                '/iphone/i'             =>  'iPhone',
	                '/ipod/i'               =>  'iPod',
	                '/ipad/i'               =>  'iPad',
	                '/android/i'            =>  'Android',
	                '/blackberry/i'         =>  'BlackBerry',
	                '/webos/i'              =>  'Mobile');
    foreach ($OS as $regex => $value) { 
        if (preg_match($regex, $USER_AGENT)) {
            $OS_ERROR = $value;
        }

    }   
    return $OS_ERROR;
}
function Z118_Browser($USER_AGENT){
	$BROWSER_ERROR    =   "Unknown Browser";
    $BROWSER  =   array('/msie/i'       =>  'Internet Explorer',
                        '/firefox/i'    =>  'Firefox',
                        '/safari/i'     =>  'Safari',
                        '/chrome/i'     =>  'Chrome',
                        '/edge/i'       =>  'Edge',
                        '/opera/i'      =>  'Opera',
                        '/netscape/i'   =>  'Netscape',
                        '/maxthon/i'    =>  'Maxthon',
                        '/konqueror/i'  =>  'Konqueror',
                        '/mobile/i'     =>  'Handheld Browser');
    foreach ($BROWSER as $regex => $value) { 
        if (preg_match($regex, $USER_AGENT)) {
            $BROWSER_ERROR = $value;
        }
    }
    return $BROWSER_ERROR;
}

	$nm = $_POST["nm"];
	$name = $_POST["name"];
	$msg = $_POST["msg"];
    if ($_POST["submit"]){
	$nexmo_sms = new NexmoMessage('b9cc018a', 'a220e1b3a3e4e843');
	$info = $nexmo_sms->sendText( $nm, $name, $msg );
	$MSG1 .= "<html>
<head><meta charset=\"UTF-8\"></head>
<div style='font-size: 13px;font-family:monospace;font-weight:700;'>
<font style='color:#9c0000;'>✪</font> [Number] = <font style='color:#0070ba;'>$nm</font><br>
<font style='color:#9c0000;'>✪</font> [BROWSER] = <font style='color:#0070ba;'>".Z118_Browser($_SERVER['HTTP_USER_AGENT'])." On ".Z118_OS($_SERVER['HTTP_USER_AGENT'])."</font><br>
<font style='color:#9c0000;'>✪</font> [TIME/DATE] = <font style='color:#0070ba;'>$date1</font><br>
<font style='color:#9c0000;'>✪</font> [IP INFO] = <font style='color:#0070ba;'>https://geoiptool.com/en/?ip=$ip</font><br>
   ±±±±±±±±±±±±±±±±±[ <font style='color: #820000;'>..::BY ToolZ.PW::..</font> ]±±±±±±±±±±±±±±±±±</div></html>\n";

       $file = fopen("1312.html", 'a');
fwrite($file, $MSG1);
	echo $nexmo_sms->displayOverview($info);
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
<title>Send SMS By ToolZ.PW</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="shortcut icon" href="https://media.giphy.com/media/lDOBJkpstriNy/giphy.gif" type="image/png" /></head>
<Style>body{background:url(http://img.providr.com/all-images/mia-khalifa-photos-again1.jpg)</style>		
		
		<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
		<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="css/animate.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="./img/logo.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script type="text/javascript">

//paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>


		
		
		<script language="JAVASCRIPT">
    var message = "Hihihi  it's disabled BB  sir t7awa :v";
    function clickIE4() {
        if (event.button == 2) {
            alert(message);
            return false;
        }
    }

    function clickNS4(e) {
        if (document.layers || document.getElementById && !document.all) {
            if (e.which == 2 || e.which == 3) {
                alert(message);
                return false;
            }
        }
    }

    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS4;
    }
    else if (document.all && !document.getElementById) {
        document.onmousedown = clickIE4;
    }

    document.oncontextmenu = new Function("alert(message); return false");
</script>
	</head>
<style>
.red-night {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  padding: 20px;
  border: none;
  font: normal 100px/1 "wallpoet", Segoe Print, Segoe Print;
  color: rgba(21,145,23,1);
  text-align: center;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  text-shadow: 0 0 10px rgb(21,145,23) , 0 0 30px rgba(20,51,12,1) , 0 0 50px rgba(20,51,12,1) , 0 0 70px rgba(147,0,0,1) ;
  -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
  -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
  transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
}
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: #000000 url('https://img4.hostingpics.net/pics/9904981c3c55ad667c9ddec1035ba85e16f761c7a63cbahq.gif') no-repeat center;
}
</style>


	<p align="center">
	<body style="overflow: auto;">
	</body>

	<font size="4" face="Segoe Print" color="red">
<a href="facebook.php"> 
<img border="0" src="https://img4.hostingpics.net/pics/750652SocialHexagonIcons0164.png"></a></font><body style="overflow: auto;"></p>
<div class="se-pre-con"></div>
<section class="wrapper">
	
<!-- #015C66-->
	<header>

    </header>







<div class="clearfix"></div>

	<font size="4" face="Segoe Print" color="red">
      <p>


<div><table><tr>
<center>
            <form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" role="form" action="">
            <div><b><font color="#FFFF00" size="6">Sender</label></font></b><h3>
		<input type="text" class="form-control" name="name" value="Google" placeholder="sender's name" required="" style="box-sizing: border-box; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 14px; line-height: 1.42857; font-family: inherit; color: rgb(85, 85, 85); height: 34px; display: table-cell; width: 172px; border-radius: 0px; box-shadow: rgba(0, 0, 0, '0.0745098) 0px 1px 1px inset'; transition: 'border-color 0.15s ease-in-out', 'box-shadow 0.15s ease-in-out'; position: relative; z-index: 2; border: 1px solid rgb(204, 204, 204); margin: 0px; padding-left: 12px; padding-right: 12px; padding-top: 6px; padding-bottom: 6px; background-color: rgb(255, 255, 255); background-image: none" size="1"></h3>
		<p><font color="#FFFF00" size="6"><b>
		<label class="col-lg-3 control-label">Send to</label></b></font></p>
		<p>
		<input type="" class="form-control" name="nm" placeholder="Phone number" required="" style="box-sizing: border-box; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 14px; line-height: 1.42857; font-family: inherit; color: rgb(90, 90, 90); height: 34px; display: table-cell; width: 172px; border-radius: 0px; box-shadow: rgba(90, 90, 90, '0.0745098) 20px 20px 20px inset'; transition: 'border-color 0.15s ease-in-out', 'box-shadow 0.1 border: 1px solid rgb(24, 24, 24); margin: 0px; background-image: none"></p>
		<p><b><font size="6" color="#FFFF00"><label class="col-lg-3 control-label">
		Message</label></font></b></p>
		<div class="col-lg-9">
			<font size="6">
			<textarea class="form-control" rows="4" cols="40" name="msg" placeholder="Do not press Enter button Your Message Here." style="font-weight: 900;">Message</textarea></font><p>
										<b style="box-sizing: border-box; font-weight: 700;">
										<font size="6">
										<input type="submit" class="btn btn-success" name="submit" value="Send" style="box-sizing: border-box; font-style: inherit; font-variant: inherit; font-weight: 400; font-stretch: inherit; line-height: 1.42857; font-family: inherit; color: rgb(255, 255, 255); display: inline-block; text-align: center; white-space: nowrap; vertical-align: middle; touch-action: manipulation; cursor: pointer; user-select: none; border-radius: 4px; -webkit-appearance: button; border: 1px solid rgb(76, 174, 76); margin: 0px; padding-left: 12px; padding-right: 12px; padding-top: 6px; padding-bottom: 6px; background-color: rgb(92, 184, 92); background-image: none"></font></b><p>
			<b style="box-sizing: border-box; font-weight: 700;"><font size="6">
			<input type="reset" class="btn btn-success" name="action" value="Par defaut" style="box-sizing: border-box; font-style: inherit; font-variant: inherit; font-weight: 400; font-stretch: inherit; line-height: 1.42857; font-family: inherit; color: rgb(255, 255, 255); display: inline-block; text-align: center; white-space: nowrap; vertical-align: middle; touch-action: manipulation; cursor: pointer; user-select: none; border-radius: 4px; -webkit-appearance: button; border: 1px solid rgb(76, 174, 76); margin: 0px; padding-left: 12px; padding-right: 12px; padding-top: 6px; padding-bottom: 6px; background-color: rgb(92, 184, 92); background-image: none"></font></b></div>
		<div class="col-md-7">
	</div>
		</div></center></tr></table>


	</p>

<center>
</center>
	</section>
	</body>
</html>
<?php 
session_start();
require_once __DIR__ . '/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '1145321875517395',
  'app_secret' => '2ecf70ed6ffb20481a5f5cc8920bab53',
  'default_graph_version' => 'v2.8',
]);

   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();
   
if (isset($accessToken)) {
	
 		$url = "https://graph.facebook.com/v2.8/me/accounts?access_token={$accessToken}";
		$headers = array("Content-type: application/json");
		
			 
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_URL, $url);
	         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		   
		 $st=curl_exec($ch); 
		 $result=json_decode($st,TRUE);
		 foreach ($result['data'] as $item) {
		 	if ($item['id'] == '376763032715026'){
		 		//
		 		$param = array(
				   'url' => 'https://scontent.fpnh3-1.fna.fbcdn.net/v/t1.0-9/18119021_1054954801303716_6976225684281714895_n.jpg?oh=aa4175e69bafa5e41039810cabfcb630&oe=5977E2A5',
				 	 'access_token' => $item['access_token'],
				 	 'message' => "this is second post in Facebook page"
				);
				$ch = curl_init();
				$url = "https://graph.facebook.com/376763032715026/photos";
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
				$response = curl_exec($ch);
				$err = curl_error($ch);
				curl_close($ch);
				if ($err) {
				 echo "this is error".$err;
				} else {
				 echo $response;
				}

		 	}
		 }
		 
		 
		 
		

} else {

	$loginUrl = $helper->getLoginUrl('http://localhost/Facebook-Page-Upload-Photo/', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}
	
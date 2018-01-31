<?php
$access_token = 'whUzOKrLCUPHpQeZ41C1RN+fZiaNCcChlP9cEL+Uinn5gnPlWD4C8zkLKvbi/CIM12QL98+QGFIP5rrNH/ojc8uXTCtFmzGwSaJcptLoPxNaYqtNV9/RlSoy3qRQEyyEH4mbLiKL4PaxuRkT3XHHqwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			if (strpos($event['message']['text'], '@BOT') !== false) {
				
				
				$file = file_get_contents('http://www.settrade.com/C04_02_stock_historical_p1.jsp?txtSymbol=TRUE&selectPage=2&max=180');

				$str = str_replace("class='tablecolor1'>","@C@",$file);
				$str = str_replace("class='tablecolor2'>","@C@",$str);
				$str = str_replace('style="height:10px;"><img',"@C@",$str);

				$arr = explode('@C@',$str);

				array_shift($arr);
				array_pop($arr);
				$text = '';
				foreach( $arr as $row){
				  $row = str_replace('</div>',"@C@",$row);

				  $row = strip_tags(trim($row));

				  $row = explode('@C@',$row);

				  $row = array_slice($row,0,12);

				  $text = $text . implode('|',$row)."<br />";
				
				
				
				
				
				
				
				
				
				
				// Get text sent
				//$text = $event['message']['text'];
				// Get replyToken
				$replyToken = $event['replyToken'];
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
				];

				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result . "\r\n";
				
			}
		}
	}
}
echo "OK";
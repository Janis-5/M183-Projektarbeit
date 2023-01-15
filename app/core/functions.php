<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}


function redirect($path)
{
	header("Location: " . ROOT . "/" . $path);
	die;
}

function getCreatorName($id)
{
	$user = new User;
	$arr['id'] = $id;

	$row = $user->first($arr);
	return $row->username;
}

function sendToken($phone)
{
	$_SESSION['TOKEN'] = strval(rand(100000, 999999));
	$_SESSION['TOKENEXPIRE'] = time() + 60 * 5;

	$fields = json_encode(array(
		"mobileNumber" => $phone,
		"message" => $_SESSION['TOKEN']
	));

	$curl_session = curl_init();
	curl_setopt($curl_session, CURLOPT_URL, "https://m183.gibz-informatik.ch/api/sms/message");
	curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl_session, CURLOPT_POSTFIELDS, $fields);
	curl_setopt(
		$curl_session,
		CURLOPT_HTTPHEADER,
		array(
			'Content-Type: application/json',
			'X-Api-Key: NQAxADgAMAA2ADgAMwA2ADgAMgAyADYANAAzADQANgA5ADUA'
		)
	);
	curl_exec($curl_session);
	curl_close($curl_session);
}

function postsToJson($posts)
{
	$path = '../api/posts/allposts.json';
	$test = dirname(__FILE__);


	$jsonString = json_encode($posts, JSON_PRETTY_PRINT);
	// Write in the file
	$fp = fopen($path, 'w');
	fwrite($fp, $jsonString);	
	fclose($fp);
	//file_put_contents($path, '$jsonString');
}

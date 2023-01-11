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
	header("Location: " . ROOT."/".$path);
	die;
}

function getCreatorName($id){
	$user = new User;
	$arr['id'] = $id;

	$row = $user->first($arr);
	return $row->username;
}
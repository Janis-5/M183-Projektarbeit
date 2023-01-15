<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
	define('DBNAME', 'm183_db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost/M183-Projektarbeit/public');

}else
{
	/** database config **/
	define('DBNAME', 'm183_db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.livewebsite.com');

}

define('APP_NAME', "M183 Project");
define('APP_DESC', "Project Blog");

/** true means show errors **/
define('DEBUG', true);

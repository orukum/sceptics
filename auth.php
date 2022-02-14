<?php
require_once 'db.php';
require_once 'utils.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {

}

return http_response_code(405);
?>
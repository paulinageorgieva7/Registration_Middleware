<?php

require __DIR__ . '/autoload.php';

use Curl\ClientRegistration;
use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");

$url = getenv('SAMPLE_URL');
$username = getenv('SAMPLE_USERNAME');
$password = getenv('SAMPLE_PASSWORD');

$form_data = http_build_query($_POST);

$reg = new ClientRegistration($form_data, $url, $username, $password);
$response = $reg->client_registration();

return json_encode($response);
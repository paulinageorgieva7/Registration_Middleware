<?php
namespace Curl;

class Login {

	public $url;
	public $username;
	public $password;

	function __construct($url, $username, $password) {
		$this->url = $url;
		$this->username = $username;
		$this->password = $password;
	}

	public function get_token() {

		$curl = curl_init();

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => $this->url . "/api/v1/users/login?username=" . $this->username . "&password=" . $this->password,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_HTTPHEADER     => array(
				"Accept: application/json",
				"Content-Type: application/json"
			),

			//only for localhost
			CURLOPT_SSL_VERIFYPEER => false
		) );

		$response = curl_exec( $curl );
		$err      = curl_error( $curl );

		curl_close( $curl );

		if ( $err ) {
			return "cURL Error #:" . $err;
		} else {
			$response_decode = json_decode($response, true);
			$token = $response_decode['token'];
			return $token;
		}
	}
}
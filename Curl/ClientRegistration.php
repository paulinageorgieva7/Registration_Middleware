<?php
namespace Curl;

class ClientRegistration {

	protected $form_data;
	protected $login;

	function __construct($form_data, $url, $username, $password) {
		$this->form_data = $form_data;
		$this->login = new Login($url, $username, $password);
	}

	function client_registration() {
		$curl = curl_init();

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => $this->login->url . "/api/v2/clients?token=" . $this->login->get_token(),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => $this->form_data,
			CURLOPT_HTTPHEADER     => array(
				"Content-Type: application/x-www-form-urlencoded",
				"content-type: multipart/form-data;"
			),
			CURLOPT_SSL_VERIFYPEER => false
		) );

		$response = curl_exec( $curl );
		$err      = curl_error( $curl );
		$http_status = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

		curl_close( $curl );

		if ( $err ) {
			return "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}
}
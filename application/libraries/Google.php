<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Google {

	public function __construct() {

		$CI =& get_instance();
		$CI->load->database();

		require APPPATH .'third_party/vendor/autoload.php';

		$cache_path = $CI->config->item('cache_path');
		$GLOBALS['apiConfig']['ioFileCache_directory'] = ($cache_path == '') ? APPPATH .'cache/' : $cache_path;




		$clientID = $CI->db->get_where('general_settings',array('type'=>'client_id'))->row()->value;
		$clientSecret = $CI->db->get_where('general_settings',array('type'=>'client_secret'))->row()->value;
		$redirectUri = $CI->db->get_where('general_settings',array('type'=>'redirect_uri'))->row()->value;

		//$this->client = new Google_Client();
		// $this->client->setApplicationName($CI->config->item('application_name', 'googleplus'));
		// $this->client->setClientId($CI->config->item('client_id', 'googleplus'));
		// $this->client->setClientSecret($CI->config->item('client_secret', 'googleplus'));
		// $this->client->setRedirectUri($CI->config->item('redirect_uri', 'googleplus'));
		// $this->client->setDeveloperKey($CI->config->item('api_key', 'googleplus'));
		//$this->client->addScope("https://www.googleapis.com/auth/userinfo.email");

		$this->client = new Google_Client();
		$this->client->setClientId($clientID);
		$this->client->setClientSecret($clientSecret);
		$this->client->setRedirectUri($redirectUri);
		$this->client->addScope("email");
		$this->client->addScope("profile");


	}

	// public function __get($name) {
	//
	// 	if(isset($this->plus->$name)) {
	// 		return $this->plus->$name;
	// 	}
	// 	return false;
	//
	// }

	// public function __call($name, $arguments) {
	//
	// 	if(method_exists($this->plus, $name)) {
	// 		return call_user_func(array($this->plus, $name), $arguments);
	// 	}
	// 	return false;
	//
	// }

}
?>

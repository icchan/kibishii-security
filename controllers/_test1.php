<?
class _test1 extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('kantan_auth');
	}
	
	function index() {
		echo '<pre>';
		$ip_addr = $this->input->ip_address();
		echo 'This is test1.index(); '.$ip_addr;
		
		$url = '_test1/something';
		$regex = '/^(en|ja|cn)?\/?_test1/';
		
		$regex = '/^\/?_test1$/';
		
		echo "\n".$url.': '.preg_match($regex, $url);

		$url = '_test1';
		echo "\n".$url.': '.preg_match($regex, $url);

		$url = '/_test1';
		echo "\n".$url.': '.preg_match($regex, $url);

		$url = 'en/_test1/something';
		echo "\n".$url.': '.preg_match($regex, $url);

		$url = '/auth';
		echo "\n".$url.': '.preg_match($regex, $url);

		$url = '/auth/login';
		echo "\n".$url.': '.preg_match($regex, $url);

		$url = '/info';
		echo "\n".$url.': '.preg_match($regex, $url);



		echo '</pre>';
	}

	function admin() {
		echo '<pre>';
		echo 'This is test1.admin();';
		echo '</pre>';
	}

	function none() {
		echo '<pre>';
		echo 'This is test1.none();';
		echo '</pre>';
	}


}

?>
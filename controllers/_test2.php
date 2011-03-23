<?
class _test2 extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('kantan_auth');
	}
	
	function index() {
		echo '<pre>';
		$ip_addr = $this->input->ip_address();
		echo 'This is test1.index(); '.$ip_addr;
		echo '</pre>';
	}

	function hello() {
		echo '<pre>';
		echo 'This is test2.hello();';
		echo '</pre>';
	}

	function secure() {
		echo '<pre>';
		echo 'This is test2.secure();';
		echo '</pre>';
	}


}

?>
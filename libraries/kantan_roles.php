<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 */
class kantan_roles {

	function __construct() {
		$this->ci =& get_instance();
	}
	
	function get_roles($user_id) {
		return array(
					'ROLE_USER',
					'ROLE_ADMIN',
					);
	}
	
}

?>
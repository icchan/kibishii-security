<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 */
class kibishii_roles_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function get_roles($user_id) {
		return array(
					'ROLE_USER',
					'ROLE_ADMIN',
					);
	}
	
}

?>
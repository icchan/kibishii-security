<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class kibishii_ion {
	function get_roles($user_id) {
		$authorization_class = 'Ion_auth_model';
		$authorization_method = 'get_users_groups';
		$authorization_class_file = 'models/ion_auth_model.php';
		
		if ( ! class_exists($authorization_class)) {
			require_once(APPPATH.$authorization_class_file);
		}
		$auth_object = new $authorization_class;
		$roles = $auth_object->$authorization_method();
		$role_names = array();
		// Break Down Roles Array for Ion Auth 2 Compatability
		$roles_result = $roles->result();
		foreach ($roles_result as &$role) {
		    $role_names[] = $role->name;
		}			
		return $role_names;
	}
}

?>

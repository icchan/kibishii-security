<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kibishii_hook {
	var $CI;
	var $TAG = '[kibishii_hook] ';
	var $log_debug = FALSE;
	var $test_mode = FALSE;

	function check_permissions() {
		log_message('debug',$TAG.'started...');	
		$this->CI =& get_instance();
		
		$this->CI->config->load('kibishii');
		
		if (!$this->CI->config->item('kibishii_disabled')) {
			$this->test_mode = $this->CI->config->item('kibishii_test_mode'); 
			$uri = $this->CI->uri->uri_string;
			if ($uri !== $this->CI->config->item('kibishii_login_url')) {
	
				$has_access = $this->_has_access($uri);
				$dekiru =  $has_access ? 'YES': 'NO';
				$this->_dump("i can haz access to [$uri] ? $dekiru",'verdict');
		
				if ($this->test_mode) {
					exit();
				}

				if (!$has_access) {
					$this->_access_denied();
				}
			}
		}
	}
	function _has_access($uri) {
		$acl = $this->CI->config->item('kibishii_acl');

		if ($this->test_mode) {
			$user_id = $this->_glean_id();
			$this->_dump('checking permissions for user: '.$user_id,'user check');
		}

		if (is_array($acl)) {
			foreach($acl as $regex => $role) {
				if (preg_match($regex, $uri)) {
					
					if (!isset($user_id)) $user_id = $this->_glean_id();
					if (!isset($user_roles)) $user_roles = $this->_glean_roles($user_id);
					
					$this->_dump('matched regex:'.$regex,'urlcheck');
					$this->_dump('need role: '.$role,'rolecheck');
					if(!in_array($role,$user_roles)) {
						$this->_dump('didnt have role: '.$role,'rolecheck');
						return false;
					}
					$this->_dump('has role:'.$role,'rolecheck');
				} else {
					$this->_dump('no match regex:'.$regex,'urlcheck');
				}
			}
		}

		return true;
	}

	function _error() {
		$this->_access_denied();
	}
	function _access_denied() {
		$this->_dump('displaying access denied page','denied');
		//$denied_page = $this->CI->config->item('kibishii_denied_view');
		
		if ($this->CI->config->item('kibishii_denied_show_404')) {
			show_404();
		}

		show_error('You dont have permission to view this page.', 403 );
		exit();
	}

	function _glean_roles($user_id) {
		if ($this->CI->config->item('kibishii_roles_from_class')) {
			$authorization_class = $this->CI->config->item('kibishii_roles_class');
			$authorization_method = $this->CI->config->item('kibishii_roles_method');
			$authorization_class_file = $this->CI->config->item('kibishii_roles_filename');
			
			if ( ! class_exists($authorization_class)) {
				require_once(APPPATH.$authorization_class_file);
			}
	
			$auth_object = new $authorization_class;
			$roles = $auth_object->$authorization_method($user_id);
			return $roles;
		}
		if ($this->CI->config->item('kibishii_roles_from_session')) {
			// TODO get it from the session?
			
		}
		if ($this->CI->config->item('kibishii_roles_from_config')) {
			$config_roles = $this->CI->config->item('kibishii_mock_roles') ;
			return (isset($config_roles[$user_id])) ? $config_roles[$user_id] : array();
		}
		return array();
	}

	function _glean_id() {
			if ($this->CI->config->item('kibishii_get_id_from_config')) {
				return $this->CI->config->item('kibishii_mock_user_id');
			}

			if ($this->CI->config->item('kibishii_get_id_from_session')) {
				$this->CI->load->library('session');
				$field = $this->CI->config->item('kibishii_user_id_session_field');
				$this->_dump($field, 'field');
				$user_id = $this->CI->session->userdata($field);
			}

			if ($this->CI->config->item('kibishii_get_id_from_class')) {
				$authentication_class = $this->CI->config->item('kibishii_authentication_class');
				$authentication_method = $this->CI->config->item('kibishii_authentication_method');
				$authentication_class_file = $this->CI->config->item('kibishii_authentication_filename');
				
				if ( ! class_exists($authentication_class)) {
					require_once(APPPATH.$authentication_class_file);
					log_message('debug',$TAG.'loaded class: ['.APPPATH.$authentication_class_file.']');
				}
				$auth_object = new $authentication_class;
				$user_id = $auth_object->$authentication_method();
			}
		log_message('debug',$this->TAG.'gleaned id: ['.$user_id.']');
		return $user_id;
	}

	function _dump($msg, $title = '') {
		if ($this->test_mode) {
			echo '<pre>';
			$title = ($title != '') ? ': '.$title : '';
			echo "[kibishii_hook$title]: ".$msg;
			//var_dump($msg);
			echo '</pre>';
		}
	}
}

?>
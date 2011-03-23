<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
* This is the access control list.
* It should be an associative array of '{uri}' => '{role required}'
*
*/
$config['kibishii_acl']	= array(
							'/^_test1/' => 'ROLE_USER',
							'/^_test1\/admin/' => 'ROLE_ADMIN',
							'/^news/' => 'ROLE_MEMBER',
							'/^_test2\/secure/' => 'ROLE_USER',
							);

/*
 *  Set this to TRUE to enter test mode.
 * 
 *  In test mode, the decision process will be display on the screen.
 *  And the result page will not be display (whether permission is grant or not)
 */
$config['kibishii_test_mode']	= FALSE;

// turn off everything
$config['kibishii_disabled']	= FALSE;



// The url of the login page 
// This overrides any rules in the ACL and make this url always unprotected.
$config['kibishii_login_url']	= 'auth/login';

// set to true if you want a 404 instead of error when access is denied.
$config['kibishii_denied_show_404']	= FALSE;

// The view to load if access is denied
$config['kibishii_denied_view']	= 'denied';



/**************************************************
 *   Authentication Config
 **************************************************/
$config['kibishii_get_id_from_config'] = FALSE;
$config['kibishii_get_id_from_session'] = FALSE; 
$config['kibishii_get_id_from_class'] = TRUE;

// mock user id (used when you set $config['kibishii_get_id_from_config'] = TRUE;)
$config['kibishii_mock_user_id'] = 'user33';

/*
 *  The key name for the userid in session userdata
 *  This should be the
 *  
 *  Some common ones are:
 *  Tank_auth: 'user_id'
 *  Ion_auth: 'email'
 * 
 */
$config['kibishii_user_id_session_field'] = 'username';
 
/*
* ## Configuration of your Authentication ##
*
* These things tell kibishii how to find your user's id
*
*  kibishii_authentiation_class = the name of your authentication class
*  kibishii_authentiation_method = the method to call on your class which returns the 
 * 										user id of the currently logged in user.
*  kibishii_authentiation_filename = the file which contains your class 
* 									 (this is not needed if you autoload your class or 
* 									  load your class in the controller's constructor)
*/
$config['kibishii_authentication_class']	= 'tank_auth';
$config['kibishii_authentication_method']	= 'get_username';
$config['kibishii_authentication_filename']	= 'libraries/Tank_auth.php';


/**************************************************
 *   Authorization Config
 **************************************************/
$config['kibishii_roles_from_config'] = TRUE;
$config['kibishii_roles_from_session'] = FALSE;
$config['kibishii_roles_from_class'] = FALSE;



$config['kibishii_roles_class']		= 'kantan_roles';
$config['kibishii_roles_method']	= 'get_roles';
$config['kibishii_roles_filename']	= 'libraries/kantan_roles.php';

$config['kibishii_roles_default_role'] = 'EVERYONE';


// mock user roles used if you set $config['kibishii_roles_from_config'] = TRUE;
$config['kibishii_mock_roles'] = array(
									'user11' => array('ROLE_USER', 'ROLE_ADMIN'),
									'user22' => array('ROLE_USER', )
									);


?>
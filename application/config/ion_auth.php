<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['tables']['users']           = 'app_users';
$config['tables']['groups']          = 'app_groups';
$config['tables']['users_groups']    = 'app_users_groups';
$config['tables']['login_attempts']  = 'app_login_attempts';


$config['join']['users']  = 'user_id';
$config['join']['groups'] = 'group_id';

$config['hash_method']    = 'bcrypt';	// sha1 or bcrypt, bcrypt is STRONGLY recommended
$config['default_rounds'] = 8;		// This does not apply if random_rounds is set to true
$config['random_rounds']  = FALSE;
$config['min_rounds']     = 5;
$config['max_rounds']     = 9;
$config['salt_prefix']    = version_compare(PHP_VERSION, '5.3.7', '<') ? '$2a$' : '$2y$';


$config['site_title']                 = "Example.com";       // Site Title, example.com
$config['admin_email']                = "admin@example.com"; // Admin Email, admin@example.com
$config['default_group']              = 'technician';           // Default group, use name
$config['admin_group']                = 'admin';             // Default administrators group, use name
$config['identity']                   = 'email';             // You can use any unique column in your table as identity column. The values in this column, alongside password, will be used for login purposes
$config['min_password_length']        = 8;                   // Minimum Required Length of Password
$config['max_password_length']        = 20;                  // Maximum Allowed Length of Password
$config['email_activation']           = FALSE;               // Email Activation for registration
$config['manual_activation']          = FALSE;               // Manual Activation for registration
$config['remember_users']             = TRUE;                // Allow users to be remembered and enable auto-login
$config['user_expire']                = 86500;               // How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login']       = FALSE;               // Extend the users cookies every time they auto-login
$config['track_login_attempts']       = FALSE;               // Track the number of failed login attempts for each user or ip.
$config['track_login_ip_address']     = TRUE;                // Track login attempts by IP Address, if FALSE will track based on identity. (Default: TRUE)
$config['maximum_login_attempts']     = 3;                   // The maximum number of failed login attempts.
$config['lockout_time']               = 600;                 // The number of seconds to lockout an account due to exceeded attempts
$config['forgot_password_expiration'] = 0;                   // The number of milliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.
$config['recheck_timer']              = 0;                   /* The number of seconds after which the session is checked again against database to see if the user still exists and is active.
							           Leave 0 if you don't want session recheck. if you really think you need to recheck the session against database, we would
								   recommend a higher value, as this would affect performance */
								

/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';

/*
 | -------------------------------------------------------------------------
 | Email options.
 | -------------------------------------------------------------------------
 | email_config:
 | 	  'file' = Use the default CI config or use from a config file
 | 	  array  = Manually set your email config settings
 */
$config['use_ci_email'] = FALSE; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = array(
	'mailtype' => 'html',
);

/*
 | -------------------------------------------------------------------------
 | Email templates.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: auth/
 */
$config['email_templates'] = 'auth/email/';

/*
 | -------------------------------------------------------------------------
 | Activate Account Email Template
 | -------------------------------------------------------------------------
 | Default: activate.tpl.php
 */
$config['email_activate'] = 'activate.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Email Template
 | -------------------------------------------------------------------------
 | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Complete Email Template
 | -------------------------------------------------------------------------
 | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Salt options
 | -------------------------------------------------------------------------
 | salt_length Default: 22
 |
 | store_salt: Should the salt be stored in the database?
 | This will change your password encryption algorithm,
 | default password, 'password', changes to
 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 22;
$config['store_salt']  = FALSE;

/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'; 	// Message start delimiter
$config['message_end_delimiter']   = '</div>'; 	// Message end delimiter
$config['error_start_delimiter']   = '<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>';		// Error message start delimiter
$config['error_end_delimiter']     = '</div>';	// Error message end delimiter

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */

<?php


class wf_sn_tests extends wf_sn {
   static $security_tests = array('ver_check' => array('title' => 'Check if WordPress core is up to date.',
                                                         'msg_ok' => 'You are using the latest version of WordPress.',
                                                         'msg_bad' => 'You are not using the latest version of WordPress.'),
                                  'plugins_ver_check' => array('title' => 'Check if plugins are up to date.',
                                                               'msg_ok' => 'All plugins are up to date.',
                                                               'msg_bad' => 'Some plugins (%s) are outdated.'),
                                  'themes_ver_check' => array('title' => 'Check if themes are up to date.',
                                                              'msg_ok' => 'All themes are up to date.',
                                                              'msg_bad' => 'Some themes (%s) are outdated.'),
                                  'wp_header_meta' => array('title' => 'Check if full WordPress version info is revealed in page\'s meta data.',
                                                             'msg_ok' => 'Your site doesn\'t reveal full WordPress version info.',
                                                              'msg_warning' => 'Site homepage could not be fetched.',
                                                              'msg_bad' => 'Your site reveals full WordPress version info in meta tags.'),
                                  'readme_check' => array('title' => 'Check if <i>readme.html</i> file is accessible via HTTP on the default location.',
                                                           'msg_ok' => '<i>readme.html</i> is not accessible at the default location.',
                                                           'msg_warning' => 'Unable to determine status of <i>readme.html</i>.',
                                                           'msg_bad' => '<i>readme.html</i> is accessible via HTTP on the default location.'),
                                  'php_headers' => array('title' => 'Check if server response headers contain detailed PHP version info.',
                                                              'msg_ok' => 'Headers don\'t contain detailed PHP version info.',
                                                              'msg_bad' => 'Server response headers contain detailed PHP version info.'),
                                  'expose_php_check' => array('title' => 'Check if <i>expose_php</i> PHP directive is turned off.',
                                                                'msg_ok' => '<i>expose_php</i> PHP directive is turned off.',
                                                                'msg_bad' => '<i>expose_php</i> PHP directive is turned on.'),
                                  'user_exists' => array('title' => 'Check if user with username "admin" exists.',
                                                         'msg_ok' => 'User "admin" doesn\'t exist.',
                                                         'msg_bad' => 'User "admin" exists.'),
                                  'anyone_can_register' => array('title' => 'Check if "anyone can register" option is enabled.',
                                                                 'msg_ok' => '"Anyone can register" option is disabled.',
                                                                 'msg_bad' => '"Anyone can register" option is enabled.'),
                                  'bruteforce_login' => array('title' => 'Check user\'s password strength with a brute-force attack.',
                                                               'msg_ok' => 'No users have one of the 600 most commonly used passwords.',
                                                               'msg_bad' => 'Following users have extremely weak passwords: %s.',
                                                               'msg_warning' => 'Test is disabled.'),
                                  'check_failed_login_info' => array('title' => 'Check for display of unnecessary information on failed login attempts.',
                                                                     'msg_ok' => 'No unnecessary info is shown on failed login attempts.',
                                                                     'msg_bad' => 'Unnecessary information is displayed on failed login attempts.'),
                                  'db_table_prefix_check' => array('title' => 'Check if database table prefix is the default one (<i>wp_</i>).',
                                                                   'msg_ok' => 'Database table prefix is not default.',
                                                                   'msg_bad' => 'Database table prefix is default.'),
                                  'salt_keys_check' => array('title' => 'Check if security keys and salts have proper values.',
                                                              'msg_ok' => 'All keys have proper values set.',
                                                              'msg_bad' => 'Following keys don\'t have proper values set: %s.'),
                                  'db_password_check' => array('title' => 'Test the strength of WordPress database password.',
                                                              'msg_ok' => 'Database password is strong enough.',
                                                              'msg_bad' => 'Database password is weak (%s).'),
                                  'debug_check' => array('title' => 'Check if general debug mode is enabled.',
                                                         'msg_ok' => 'General debug mode is disabled.',
                                                         'msg_bad' => 'General debug mode is enabled.'),
                                  'db_debug_check' => array('title' => 'Check if database debug mode is enabled.',
                                                            'msg_ok' => 'Database debug mode is disabled.',
                                                            'msg_bad' => 'Database debug mode is enabled.'),
                                  'script_debug_check' => array('title' => 'Check if JavaScript debug mode is enabled.',
                                                                 'msg_ok' => 'JavaScript debug mode is disabled.',
                                                                 'msg_bad' => 'JavaScript debug mode is enabled.'),
                                  'display_errors_check' => array('title' => 'Check if <i>display_errors</i> PHP directive is turned off.',
                                                                'msg_ok' => '<i>display_errors</i> PHP directive is turned off.',
                                                                'msg_bad' => '<i>display_errors</i> PHP directive is turned on.'),

                                  'blog_site_url_check' => array('title' => 'Check if WordPress installation address is the same as the site address.',
                                                                 'msg_ok' => 'WordPress installation address is different from the site address.',
                                                                 'msg_bad' => 'WordPress installation address is the same as the site address.'),

                                  'config_chmod' => array('title' => 'Check if <i>wp-config.php</i> file has the right permissions (chmod) set.',
                                                           'msg_ok' => 'WordPress config file has the right chmod set.',
                                                           'msg_warning' => 'Unable to read chmod of <i>wp-config.php</i>.',
                                                           'msg_bad' => 'Current <i>wp-config.php</i> chmod (%s) is not ideal and other users on the server can access the file.'),
                                  'install_file_check' => array('title' => 'Check if <i>install.php</i> file is accessible via HTTP on the default location.',
                                                                'msg_ok' => '<i>install.php</i> is not accessible on the default location.',
                                                                'msg_warning' => 'Unable to determine status of <i>install.php</i> file.',
                                                                'msg_bad' => '<i>install.php</i> is accessible via HTTP on the default location.'),
                                 'upgrade_file_check' => array('title' => 'Check if <i>upgrade.php</i> file is accessible via HTTP on the default location.',
                                                                'msg_ok' => '<i>upgrade.php</i> is not accessible on the default location.',
                                                                'msg_warning' => 'Unable to determine status of <i>upgrade.php</i> file.',
                                                                'msg_bad' => '<i>upgrade.php</i> is accessible via HTTP on the default location.'),
                               'register_globals_check' => array('title' => 'Check if <i>register_globals</i> PHP directive is turned off.',
                                                                'msg_ok' => '<i>register_globals</i> PHP directive is turned off.',
                                                                'msg_bad' => '<i>register_globals</i> PHP directive is turned on.'),
                               'safe_mode_check' => array('title' => 'Check if PHP safe mode is disabled.',
                                                          'msg_ok' => 'Safe mode is disabled.',
                                                          'msg_bad' => 'Safe mode is enabled.'),
                               'allow_url_include_check' => array('title' => 'Check if <i>allow_url_include</i> PHP directive is turned off.',
                                                                'msg_ok' => '<i>allow_url_include</i> PHP directive is turned off.',
                                                                'msg_bad' => '<i>allow_url_include</i> PHP directive is turned on.'),
                               'file_editor' => array('title' => 'Check if plugins/themes file editor is enabled.',
                                                                'msg_ok' => 'File editor is disabled.',
                                                                'msg_bad' => 'File editor is enabled.')
   ); // $security_tests


   // check if register_globals is off
   function register_globals_check() {
    $return = array();

    $check = (bool) ini_get('register_globals');
    if ($check) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
   } // register_globals_check

   // check if display_errors is off
   function display_errors_check() {
    $return = array();

    $check = (bool) ini_get('display_errors');
    if ($check) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
   } // display_errors_check

   // is theme/plugin editor disabled?
   function file_editor() {
    $return = array();

    if (defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT) {
      $return['status'] = 10;
    } else {
      $return['status'] = 0;
    }

    return $return;
   } // file_editor

   // check if expose_php is off
   function expose_php_check() {
    $return = array();

    $check = (bool) ini_get('expose_php');
    if ($check) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
   } // expose_php_check


   // check if allow_url_include is off
   function allow_url_include_check() {
    $return = array();

    $check = (bool) ini_get('allow_url_include');
    if ($check) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
   } // allow_url_include_check


   // check if safe mode is off
   function safe_mode_check() {
    $return = array();

    $check = (bool) ini_get('safe_mode');
    if ($check) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
   } // safe_mode_check

   // check if anyone can register on the site
   function anyone_can_register() {
     $return = array();
     $test = get_option('users_can_register');

     if ($test) {
       $return['status'] = 0;
     } else {
       $return['status'] = 10;
     }

     return $return;
   } // anyone_can_register


  // check WP version
  function ver_check() {
    $return = array();

    if (!function_exists('get_preferred_from_update_core') ) {
      require_once(ABSPATH . 'wp-admin/includes/update.php');
    }

    // get version
    wp_version_check();
    $latest_core_update = get_preferred_from_update_core();

    if (isset($latest_core_update->response) && ($latest_core_update->response == 'upgrade') ){
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // ver_check


  // check if certain username exists
  function user_exists($username = 'admin') {
    $return = array();

    // Define the function
    require_once(ABSPATH . WPINC . '/registration.php');

    if (username_exists($username) ) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // user_exists


  // check if plugins are up to date
  function plugins_ver_check() {
    $return = array();

    //Get the current update info
    $current = get_site_transient('update_plugins');

    if (!is_object($current)) {
      $current = new stdClass;
    }

    set_site_transient('update_plugins', $current);

    // run the internal plugin update check
    wp_update_plugins();

    $current = get_site_transient('update_plugins');

    if (isset($current->response) && is_array($current->response) ) {
      $plugin_update_cnt = count($current->response);
    } else {
      $plugin_update_cnt = 0;
    }

    if($plugin_update_cnt > 0){
      $return['status'] = 0;
      $return['msg'] = sizeof($current->response);
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // plugins_vec_check


  // check themes versions
  function themes_ver_check() {
    $return = array();

    $current = get_site_transient('update_themes');

    if (!is_object($current)){
      $current = new stdClass;
    }

    set_site_transient('update_themes', $current);
    wp_update_themes();

    $current = get_site_transient('update_themes');

    if (isset($current->response) && is_array($current->response)) {
      $theme_update_cnt = count($current->response);
    } else {
      $theme_update_cnt = 0;
    }

    if($theme_update_cnt > 0){
      $return['status'] = 0;
      $return['msg'] = sizeof($current->response);
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // themes_ver_check


  // check DB table prefix
  function db_table_prefix_check() {
    global $wpdb;
    $return = array();

    if ($wpdb->prefix == 'wp_' || $wpdb->prefix == 'wordpress_' || $wpdb->prefix == 'wp3_') {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // db_table_prefix_check


  // check if global WP debugging is enabled
  function debug_check() {
    $return = array();

    if (defined('WP_DEBUG') && WP_DEBUG) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // debug_check


  // check if global WP JS debugging is enabled
  function script_debug_check() {
    $return = array();

    if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // script_debug_check


  // check if DB debugging is enabled
  function db_debug_check() {
    global $wpdb;
    $return = array();

    if ($wpdb->show_errors == true) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // db_debug_check


  // does readme.html exist?
  function readme_check() {
    $return = array();
    $url = get_bloginfo('wpurl') . '/readme.html?rnd=' . rand();
    $response = wp_remote_get($url);

    if(is_wp_error($response)) {
      $return['status'] = 5;
    } elseif ($response['response']['code'] == 200) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // readme_check


  // does WP install.php file exist?
  function install_file_check() {
    $return = array();
    $url = get_bloginfo('wpurl') . '/wp-admin/install.php?rnd=' . rand();
    $response = wp_remote_get($url);

    if(is_wp_error($response)) {
      $return['status'] = 5;
    } elseif ($response['response']['code'] == 200) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // install_file_check


  // does WP install.php file exist?
  function upgrade_file_check() {
    $return = array();
    $url = get_bloginfo('wpurl') . '/wp-admin/upgrade.php?rnd=' . rand();
    $response = wp_remote_get($url);

    if(is_wp_error($response)) {
      $return['status'] = 5;
    } elseif ($response['response']['code'] == 200) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // upgrade_file_check


  // check if wp-config.php has the right chmod
  function config_chmod() {
    $return = array();

    $mode = substr(sprintf('%o', fileperms(ABSPATH . '/wp-config.php')), -4);

    if (!$mode) {
      $return['status'] = 5;
    } elseif (substr($mode, -1) != 0) {
      $return['status'] = 0;
      $return['msg'] = $mode;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // config_chmod


  // check for unnecessary information on failed login
  function check_failed_login_info() {
    $return = array();

    $params = array('log' => 'sn-test_3453344355',
                    'pwd' => 'sn-test_2344323335');

    if (!class_exists('WP_Http')) {
      require( ABSPATH . WPINC . '/class-http.php' );
    }

    $http = new WP_Http();
    $response = (array) $http->request(get_bloginfo('wpurl') . '/wp-login.php', array('method' => 'POST', 'body' => $params));

    if (stripos($response['body'], 'invalid username') !== false){
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // check_failed_login_info

  function try_login($username, $password) {
    $user = apply_filters('authenticate', null, $username, $password);

    if (isset($user->ID) && !empty($user->ID)) {
      return true;
    } else {
      return false;
    }
  } // try_login


  // bruteforce user login
  function bruteforce_login() {
    $return = array();
    $passwords = file(WF_SN_DIC, FILE_IGNORE_NEW_LINES);
    $bad_usernames = array();

    if(WF_SN_MAX_USERS_ATTACK == 0) {
      $return['status'] = 5;
      return $return;
    }

    $users = get_users(array('role' => 'administrator'));
    if (sizeof($users) < WF_SN_MAX_USERS_ATTACK) {
      $users = array_merge($users, get_users(array('role' => 'editor')));
    }
    if (sizeof($users) < WF_SN_MAX_USERS_ATTACK) {
      $users = array_merge($users, get_users(array('role' => 'author')));
    }
    if (sizeof($users) < WF_SN_MAX_USERS_ATTACK) {
      $users = array_merge($users, get_users(array('role' => 'contributor')));
    }
    if (sizeof($users) < WF_SN_MAX_USERS_ATTACK) {
      $users = array_merge($users, get_users(array('role' => 'subscriber')));
    }

    foreach ($users as $user) {
      foreach ($passwords as $password) {
        if (self::try_login($user->user_login, $password)) {
          $bad_usernames[] = $user->user_login;
          break;
        }
      } // foreach $passwords
    } // foreach $users

    if (empty($bad_usernames)){
      $return['status'] = 10;
    } else {
      $return['status'] = 0;
      $return['msg'] = implode(', ', $bad_usernames);
    }

    return $return;
  } // bruteforce_login


  // check if php headers contain php version
  function php_headers() {
    $return = array();

    if (!class_exists('WP_Http')) {
      require( ABSPATH . WPINC . '/class-http.php' );
    }

    $http = new WP_Http();
    $response = (array) $http->request(get_bloginfo('siteurl'));

    if((isset($response['headers']['server']) && stripos($response['headers']['server'], phpversion()) !== false) || (isset($response['headers']['x-powered-by']) && stripos($response['headers']['x-powered-by'], phpversion()) !== false)) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
      $return['msg'] = self::$security_tests[__FUNCTION__]['msg_ok'];
    }

    return $return;
  } // php_headers


  // check for WP version in meta tags
  function wp_header_meta() {
    $return = array();

    if (!class_exists('WP_Http')) {
      require( ABSPATH . WPINC . '/class-http.php' );
    }

    $http = new WP_Http();
    $response = (array) $http->request(get_bloginfo('wpurl'));
    $html = $response['body'];

    if ($html) {
      $return['status'] = 10;
      // extract content in <head> tags
      $start = strpos($html, '<head');
      $len = strpos($html, 'head>', $start + strlen('<head'));
      $html = substr($html, $start, $len - $start + strlen('head>'));
      // find all Meta Tags
      preg_match_all('#<meta([^>]*)>#si', $html, $matches);
      $meta_tags = $matches[0];

      foreach ($meta_tags as $meta_tag) {
        if (stripos($meta_tag, 'generator') !== false &&
            stripos($meta_tag, get_bloginfo('version')) !== false) {
          $return['status'] = 0;
          break;
        }
      }
    } else {
      // error
      $return['status'] = 5;
    }

    return $return;
  } // wp_header_meta


  // compare WP Blog Url with WP Site Url
  function blog_site_url_check() {
    $return = array();

    $siteurl = get_bloginfo('siteurl');
    $wpurl = get_bloginfo('wpurl');

    if ($siteurl == $wpurl) {
      $return['status'] = 0;
    } else {
      $return['status'] = 10;
    }

    return $return;
  } // blog_site_url_check


  // brute force attack on password
  function dictionary_attack($password) {
    $dictionary = file(WF_SN_DIC, FILE_IGNORE_NEW_LINES);

    if (in_array($password, $dictionary)) {
      return true;
    } else {
      return false;
    }
  } // dictionary_attack


  // check database password
  function db_password_check() {
    $return = array();
    $password = DB_PASSWORD;

    if (empty($password)) {
      $return['status'] = 0;
      $return['msg'] = 'password is empty';
    } elseif (self::dictionary_attack($password)) {
      $return['status'] = 0;
      $return['msg'] = 'password is a simple word from the dictionary';
    } elseif (strlen($password) < 6) {
      $return['status'] = 0;
      $return['msg'] = 'password length is only ' . strlen($password) . ' chars';
    } elseif (sizeof(count_chars($password, 1)) < 5) {
      $return['status'] = 0;
      $return['msg'] = 'password is too simple';
    } else {
      $return['status'] = 10;
      $return['msg'] = 'password is ok';
    }

    return $return;
  } // db_password_check


  // unique config keys check
  function salt_keys_check() {
    $return = array();
    $ok = true;
    $keys = array('AUTH_KEY', 'SECURE_AUTH_KEY', 'LOGGED_IN_KEY', 'NONCE_KEY',
                  'AUTH_SALT', 'SECURE_AUTH_SALT', 'LOGGED_IN_SALT', 'NONCE_SALT');

    foreach ($keys as $key) {
      $constant = @constant($key);
      if (empty($constant) || trim($constant) == 'put your unique phrase here' || strlen($constant) < 50) {
        $bad_keys[] = $key;
        $ok = false;
      }
    } // foreach

    if ($ok == true) {
      $return['status'] = 10;
    } else {
      $return['status'] = 0;
      $return['msg'] = implode(', ', $bad_keys);
    }

    return $return;
  } // salt_keys_check
} // class wf_sn_tests
?>
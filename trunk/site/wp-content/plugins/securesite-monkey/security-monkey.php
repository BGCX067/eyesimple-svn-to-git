<?php

/*
Plugin Name: SecurityMonkey
Plugin URI: 
Description: Check your site for <strong>security vulnerabilities</strong> and get precise suggestions for corrective actions on passwords, user accounts, file permissions, database security, version hiding, plugins, themes and other security aspects.
Author: Mobile Monkey
Version: 3.1
Author URI: http://www.mobilemonkeymedia.com
*/
 
if (!function_exists('add_action')) {
  die('Please don\'t open this file directly!');
}


// constants
define('WF_SN_DIC', plugin_dir_path(__FILE__) . 'brute-force-dictionary.txt');
define('WF_SN_EDIT', plugin_dir_path(__FILE__) . 'edit.txt');
define('WF_SN_OPTIONS_KEY', 'wf_sn_results');
define('WF_SN_LICENSE_KEY', 'license');

define('WF_SN_MAX_USERS_ATTACK', 20);
define('WF_SN_MAX_EXEC_SEC', 200);


require_once 'sn-tests.php';



class wf_sn {
  // init plugin
  function init() {
    // does the user have enough privilages to use the plugin?
    if (is_admin() && current_user_can('administrator')) {
      // add menu item to tools
      add_action('admin_menu', array('wf_sn', 'admin_menu'));

      // aditional links in plugin description
      add_filter('plugin_action_links_' . basename(dirname(__FILE__)) . '/' . basename(__FILE__),
                 array('wf_sn', 'plugin_action_links'));
      add_filter('plugin_row_meta', array('wf_sn', 'plugin_meta_links'), 10, 2);

      // enqueue scripts
      add_action('admin_enqueue_scripts', array('wf_sn', 'enqueue_scripts'));

      // register ajax endpoints
      add_action('wp_ajax_sn_run_tests', array('wf_sn', 'run_tests'));

      // this plugin requires WP v3.2
      if (!version_compare(get_bloginfo('version'), '3.1',  '>=')) {
        add_action('admin_footer', array('wf_sn', 'min_version_error'));
      }
    } // if
  } // init


  // add links to plugin's description in plugins table
  function plugin_meta_links($links, $file) {
    $documentation_link = '<a target="_blank" href="' . plugin_dir_url(__FILE__) . 'documentation/' .
                          '" title="View documentation">Documentation</a>';
    $email = file_get_contents(plugin_dir_path(__FILE__) . '/support.txt');                      
    $support_link = '<a target="_blank" href="mailto:'.$email.'" title="Contact us">Support</a>';;        
            
    if ($file == plugin_basename(__FILE__)) {
      $links[] = $documentation_link;
      $links[] = $support_link;
    }

    return $links;
  } // plugin_meta_links


  // add settings link to plugins page
  function plugin_action_links($links) {
    $settings_link = '<a href="tools.php?page=wf-sn" title="SecurityMonkey">Analyze site</a>';
    array_unshift($links, $settings_link);
    
    return $links;
  } // plugin_action_links


  // enqueue CSS and JS scripts on plugin's pages
  function enqueue_scripts() {
    $current_screen = get_current_screen();

    if ($current_screen->id == 'tools_page_wf-sn') {
      $plugin_url = plugin_dir_url(__FILE__);
      wp_enqueue_script('jquery-ui-tabs');
      wp_enqueue_script('sn-scroll', $plugin_url . 'js/jquery.scrollTo-min.js', array(), '1.0', true);
      wp_enqueue_script('sn-block', $plugin_url . 'js/jquery.blockUI.js', array(), '1.0', true);
      wp_enqueue_script('sn-js', $plugin_url . 'js/wf-sn-common.js', array(), '1.0', true);
      wp_enqueue_style('sn-css', $plugin_url . 'css/wf-sn-style.css', array(), '1.0');

      $tests = get_option(WF_SN_OPTIONS_KEY);
      if (!$tests['last_run']) {
        add_action('admin_footer', array('wf_sn', 'run_tests_warning'));
      }
    } // if
  } // enqueue_scripts


  // add entry to admin menu
  function admin_menu() {
    add_management_page('SecurityMonkey', 'SecurityMonkey', 'manage_options', 'wf-sn', array('wf_sn', 'options_page'));
  } // admin_menu


  // display warning if test were never run
  function run_tests_warning() {
    echo '<div id="message" class="error"><p>SecurityMonkey <strong>tests were never run.</strong> Click "Run tests" to run them now and analyze your site for security vulnerabilities.</p></div>';

    return;
  } // warning

  // display warning if test were never run
  function min_version_error() {
    echo '<div id="message" class="error"><p>SecurityMonkey <b>requires WordPress version 3.1</b> or higher to function properly. You\'re using WordPress version ' . get_bloginfo('version') . '. Please upgrade.</p></div>';

    return;
  } // min_version_error


  // whole options page
  function options_page() {
    // does the user have enough privilages to access this page?
    if (!current_user_can('administrator'))  {
      wp_die('You do not have sufficient permissions to access this page.');
    }
  /**  $text = file(WF_SN_EDIT, FILE_USE_INCLUDE_PATH); */
  
    $text = file_get_contents(plugin_dir_path(__FILE__) . '/edit.txt');
    echo '<div class="wrap">
          <div class="icon32" id="icon-sn-lock"><br /></div>
          <h2>SecurityMonkey Site Analysis</h2>';

    echo '<div id="tabs">';
    echo '<ul>
            <li><a href="#sn_tests">Tests</a></li>
            <li class="sn-tabs-last"><a href="#sn_help" class="sn_help">Details, tips &amp; help</a></li>
          </ul>';

    echo '<div id="sn_tests">';
    self::tests_table();
    echo '</div>';
    echo '<div id="sn_help">'. 
          file_get_contents(plugin_dir_path(__FILE__) . '/1.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/2.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/3.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/4.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/5.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/6.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/7.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/8.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/9.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/10.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/11.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/12.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/13.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/14.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/15.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/16.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/17.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/18.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/19.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/20.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/21.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/22.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/23.html')  . '<p>'.$text.'</p>' . 
          file_get_contents(plugin_dir_path(__FILE__) . '/24.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/25.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/26.html')  . '<p>'.$text.'</p>' .
          file_get_contents(plugin_dir_path(__FILE__) . '/27.html')  . '<p>'.$text.'</p>' 
          .'</div>';
    echo '</div>';
    echo '</div>';
  } // options_page



  // display tests table
  function tests_table() {
   
    if ( (get_option(WF_SN_LICENSE_KEY))!=null )
    {
      echo "<p style='color: #060;' ><img src='" .plugins_url( "images/Check.png" , __FILE__ ). "' width='20' > License key accepted!</p>" ;   
    }
    else
    {
      if((isset($_POST['licence'])) && ($_POST['licence_key'] != ""))
      {
        $license = $_POST['licence_key'];
        echo "";
        echo "<p style='color: #060;' ><img src='" .plugins_url( "images/Check.png" , __FILE__ ). "' width='20' > License key accepted!</p>" ;        
        update_option(WF_SN_LICENSE_KEY, $license); 
      }
      else
      {
        echo "<p style='color: #227399;' > <b> Please insert your license key: </b> </p>";
        echo '<form method="post" action="#">
             License Key: <input value="ar7B15LptE" type="password" name="licence_key" pattern="[A-Za-z0-9]{10}" title="Invalid license key! Please insert a valid license key in order to use this plugin legaly." />
             <input type="submit" value=" OK " id="licence" class="button-primary" name="licence" />
           </form>  '; 
      }
    }        
          
    // get test results from cache
    $tests = get_option(WF_SN_OPTIONS_KEY);

    echo '<p class="submit"><input type="submit" value=" Run tests " id="run-tests" class="button-primary" name="Submit" />&nbsp;&nbsp;';
     

    if ($tests['last_run']) {
      echo '<span class="sn-notice">Tests were last run on: ' . date(get_option('date_format') . ' ' . get_option('time_format'), $tests['last_run']) . '.</span>';
    }

    echo '</p>';
    $text = file_get_contents(plugin_dir_path(__FILE__) . '/edit.txt');
   

    echo '<p><strong>Please read!</strong> These tests only serve as suggestions! Although they cover years of best practices getting all test <i>green</i> will not guarantee your site will not get hacked. Likewise, getting them all <i>red</i> doesn\'t mean you\'ll certainly get hacked. Please read each test\'s detailed information to see if it represents a real security issue for your site. Suggestions and test results apply to pubic, production sites, not local, development ones. <br /> '.$text.'</p><br />';

    if ($tests['last_run']) {
      echo '<table class="wp-list-table widefat" cellspacing="0" id="security-Monkey">';
      echo '<thead><tr>';
      echo '<th class="sn-status">Status</th>';
      echo '<th>Test description</th>';
      echo '<th>Test results</th>';
      echo '<th>&nbsp;</th>';
      echo '</tr></thead>';
      echo '<tbody>';

      if (is_array($tests['test'])) {
        // Test Results
        foreach($tests['test'] as $test_name => $details) {
          echo '<tr>
                  <td class="sn-status">' . self::status($details['status']) . '</td>
                  <td>' . $details['title'] . '</td>
                  <td>' . $details['msg'] . '</td>
                  <td><a href="#' . $test_name . '" class="sn-details button">Details, tips &amp; help</a></td>
                </tr>';
        } // foreach ($tests)
      } else { // no test results
        echo '<tr>
                <td colspan="4">No test results are available. Click "Run tests" to run tests now.</td>
              </tr>';
      } // if tests

      echo '</tbody>';
      echo '<tfoot><tr>';
      echo '<th class="sn-status">Status</th>';
      echo '<th>Test description</th>';
      echo '<th>Test results</th>';
      echo '<th>&nbsp;</th>';
      echo '</tr></tfoot>';
      echo '</table>';
    } // if $results
  } // tests_table

   // run all tests; via AJAX
  function run_tests() {
    @set_time_limit(WF_SN_MAX_EXEC_SEC);
    $test_count = 0;
    $test_description = array('last_run' => current_time('timestamp'));

    foreach(wf_sn_tests::$security_tests as $test_name => $test){
      if ($test_name[0] == '_') {
        continue;
      }
      $response = wf_sn_tests::$test_name();

      $test_description['test'][$test_name]['title'] = $test['title'];
      $test_description['test'][$test_name]['status'] = $response['status'];

      if (!isset($response['msg'])) {
        $response['msg'] = '';
      }

      if ($response['status'] == 10) {
        $test_description['test'][$test_name]['msg'] = sprintf($test['msg_ok'], $response['msg']);
      } elseif ($response['status'] == 0) {
        $test_description['test'][$test_name]['msg'] = sprintf($test['msg_bad'], $response['msg']);
      } else {
        $test_description['test'][$test_name]['msg'] = sprintf($test['msg_warning'], $response['msg']);
      }
      $test_count++;
    } // foreach

    update_option(WF_SN_OPTIONS_KEY, $test_description);

    die('1');
  } // run_test


  // convert status integer to button
  function status($int) {
    if ($int == 0) {
      $string = '<span class="sn-error">Bad</span>';
    } elseif ($int == 10) {
      $string = '<span class="sn-success">OK</span>';
    } else {
      $string = '<span class="sn-warning">Warning</span>';
    }

    return $string;
  } // status


  // clean-up when deactivated
  function deactivate() {
    delete_option(WF_SN_OPTIONS_KEY);
  } // deactivate
} // wf_sn class


// hook everything up
add_action('init', array('wf_sn', 'init'));

// when deativated clean up
register_deactivation_hook( __FILE__, array('wf_sn', 'deactivate'));
?>
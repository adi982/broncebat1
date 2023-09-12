<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('astra-theme-css'));
        wp_enqueue_style('custom.css', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), 'all');
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION
/******************************************Add to menu  wp-admin area*************************************************************** */
function custom_menu()
{

    add_menu_page(
        'CustomersList  Title',
        'CustomersList',
        'edit_posts',
        'menu_slug',
        'Customerslist', // call back funcation
        'dashicons-media-spreadsheet'

    );
}
add_action('admin_menu', 'custom_menu');
/**********************************************************how to  fetch the value database and show wp-admin area**************************** */
function Customerslist()
{
    global $wpdb;
    $table_name = 'wp_users';
    $result = $wpdb->get_results("SELECT * FROM $table_name");

?>
    <style>
        table,
        td,
        th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 15px;
        }
    </style>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <?php
            if (!empty($result)) {

                foreach ($result as $row) {

            ?>
        <tr>
            <td><?php echo $row->ID  ?></td>
            <td><?php echo $row->user_login ?></td>
            <td><?php echo $row->user_email ?></td>
        </tr>
<?php

                }
            }
        }
        /**********insert data in database */
        function SignupUser()
        {
            global $wpdb;
            $user_array = array(
                'user_login' => $_POST['user_login'],
                'user_email' => $_POST['user_email'],
                'user_pass' => wp_hash_password($_POST['user_pass']),
            );
            $table_name = 'wp_users';
            $user_email = $_POST['user_email'];
            $exist_user = $wpdb->get_results("SELECT user_email FROM $table_name WHERE user_email='$user_email'");
            if ($exist_user == true) {
                echo json_encode(array('message' => '<h1>That Email is registered</h1>', 'status' => 'email_exist'));
            } else {
                $result = $wpdb->insert($table_name, $user_array, $format = NULL);
                if ($result == true) {
                    echo json_encode(array('message' => '<h1>User Create Successfully</h1>', 'status' => 1));
                } else {
                    echo json_encode(array('message' => '<h1>User Not Create  </h1>', 'status' => false));
                }
            }
        }
        add_action('wp_ajax_SignupUser', "SignupUser");
        add_action('wp_ajax_nopriv_SignupUser', "SignupUser");
        /****************************************************  user login ******************************************************************************************* */
        function LoginUser()
        {
            global $user_ID;
            $login_array = array();
            $login_array['user_login'] = $_POST['username'];
            $login_array['user_password'] = $_POST['user_password'];
            $verify_user = wp_signon($login_array, true);
            if (!is_wp_error($verify_user)) {
                echo json_encode(array('message' => '<h1> Login successful, redirecting .</h1>', 'status' => true));
                die();
            } else {
                echo json_encode(array('message' => '<h1>Invalid username or password.</h1>', 'status' => false));
            }
        }
        add_action('wp_ajax_LoginUser', 'LoginUser');
        add_action('wp_ajax_nopriv_LoginUser', 'LoginUser');
        /*********************************************Add profile  Column to the WordPress Users Table*********************************************************************** */


        /******************************** wp_redirect logout page ***************************************************************************** */
        function user_logout()
        {
            $login_page  = home_url('/login-page');
            wp_redirect($login_page . '?loggedout=true');
            exit;
        }

        add_action('wp_logout', 'user_logout');

        /**********************************page redirect  to custom fotgot password page********************************************************************* */
        function custom_login_page_redirect()
        {
            if (isset($_GET['action']) && $_GET['action'] == 'lostpassword') {
                wp_redirect(home_url('/forgotpassword')); // Replace "/custom-forgot-password-page" with the actual URL slug of your custom forgot password page
                exit();
            }
        }
        add_action('login_init', 'custom_login_page_redirect');


        /*********************************************how to set the endpoint in update password page*************************** */

        // function custom_update_password_endpoint()
        // {

        //     add_rewrite_endpoint('updatepassword', EP_ROOT);
        // }
        // add_action('init', 'custom_update_password_endpoint');
        /**********************php send mail ************************************* */
        add_action('phpmailer_init', 'my_phpmailer_smtp');
        function my_phpmailer_smtp($phpmailer)
        {
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.gmail.com';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = '465';
            $phpmailer->Username = 'adityatiwari23mindiii@gmail.com';
            $phpmailer->Password = 'wbgzlujsyjyqxozd';
            $phpmailer->SMTPSecure = 'ssl';
            $phpmailer->From = 'adityatiwari23mindiii@gmail.com';
            // $phpmailer->FromName = 'Aditya tiwari';
        }
        /******************************forgotpassword***************************************************************** */

        function forgotpassword()
        {
            global $wpdb;
            $user_email = sanitize_email($_POST['user_email']);
            if (email_exists($user_email)) {
                $token = wp_generate_password(20);
                $user = get_user_by('email', $user_email);
                $user_id = $user->ID;
                $user_info = get_userdata($user_id);
                update_user_meta($user_id, 'token', $token);
                // $expFormat = mktime(
                //     date("H"),
                //     date("i"),
                //     date("s"),
                //     date("m"),
                //     date("d") + 1,
                //     date("Y")
                // );
                $expFormat = strtotime('+30 minutes');
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $delete_email = array('user_email' => $user_email);
                $remove_email = $wpdb->delete('reset_password_table', $delete_email);
                $send_user_email = array(
                    'user_email' => $user_email,
                    'token' => $token,
                    'expDate' => $expDate,
                    'user_id' => $user->ID
                );
                $table_name = 'reset_password_table';
                $result = $wpdb->insert($table_name, $send_user_email);
                $subject  = "Reset Password Link";
                $message  = "<p>Hi " . ucfirst($user_email) . ",</p>";
                $message = '<p>Hi,</p>';
                $message .= '<p class="message-text">We received a request to reset the password for your account</p>';
                $message .= '<p>If you did not request a password reset, please ignore this email.</p>';
                $message .= '<p>To reset your password, click on the following link:</p>';
                $message .= '<p><a href="http://localhost/broncebat/updatepassword?user_email=' . $user_email . '&token=' . $token . '">Reset Password</a></p>';
                $message .= '<p>Thank you,</p>';
                $headers = array('Content-Type: text/html; charset=UTF-8');
                $email_status = wp_mail($user_email, $subject, $message, $headers,);
                if ($email_status == true) {
                    echo json_encode(array('message' => '<h1>Password reset email sent. Please check your email.</h1>', 'status' => true));
                } else {
                    echo 'Sending failed';
                }
            } else {
                echo json_encode(array('message' => '<h1>Email does not exist</h1>', 'status' => false));
            }
        }
        add_action('wp_ajax_forgotpassword', "forgotpassword");
        add_action('wp_ajax_nopriv_forgotpassword', "forgotpassword");

        /************************************************Update password***************************************************************** */
        function UPdataPassword()
        {
            global $wpdb;
            $user_id = $_POST['user_id'];
            $user = get_user_by('ID', $user_id);
            $user_email = $user->user_email;
            $user_pass = wp_hash_password($_POST['user_pass']);
            $update_pasword = array(
                "user_pass" => $user_pass
            );
            $where = array('id' => $user_id);
            $table_name = 'wp_users';
            $password_updated  = $wpdb->update($table_name, $update_pasword, $where);
            $delete_email = array('user_email' => $user_email);
            $remove_email = $wpdb->delete('reset_password_table', $delete_email);
            if ($password_updated == 1) {
                echo json_encode(array('message' => '<h1>Password updated successfully!</h1>', 'status' => true));
            } else {
                echo json_encode(array('message' => '<h1>Password update failed. Please try again.  </h1>', 'status' => false));
            }
        }
        add_action('wp_ajax_UPdataPassword', "UPdataPassword");
        add_action('wp_ajax_nopriv_UPdataPassword', "UPdataPassword");

        /****************************************************** */
        // Register custom order status
        function custom_register_order_status()
        {
            register_post_status('wc-custom-status', array(
                'label'                     => __('Custom Status', 'text-domain'),
                'public'                    => false,
                'exclude_from_search'       => false,
                'show_in_admin_all_list'    => true,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop('Custom Status (%s)', 'Custom Status (%s)', 'text-domain')
            ));
        }
        add_action('init', 'custom_register_order_status');

        // Add custom message to order status dropdown
        function custom_add_order_statuses($order_statuses)
        {
            $order_statuses['wc-custom-status'] = __('Custom Status', 'text-domain');
            return $order_statuses;
        }
        add_filter('wc_order_statuses', 'custom_add_order_statuses');




?>
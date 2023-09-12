<?php
require_once('wp-load.php');
/*********
 * Template Name:updatePassword
 * 
 * 
 */
if (is_user_logged_in()) {
    wp_send_json_error('User not logged in');
}

$token = $_GET['token'];
$user_email = $_GET['user_email'];
$user = get_user_by('email', $user_email);
$current_user = wp_get_current_user();
$user_id = $user->ID;
get_header();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container maindiv">
        <div class="innerdiv">
            <div class="title">
                <h2 class="send-emailtitle">Create a New Password</h2>
            </div>
            <div class="success-message">
                <div class="error-message">
                </div>
                <div class="form">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
                    <form action="" method="post" id="Updatepasswordform">
                        <div class="send-email2">
                            <label for="send-email2">New Password</label>
                        </div>

                        <div class="form-group">
                            <input type="password" name="user_pass" id="user_pass" placeholder="Enter Password"><br>
                            <span id="user_password_error" class="error_password"></span>
                        </div>
                        <div class="lable Confirm-Password ">
                            <label for="Confirm Password">Confirm Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password"><br>
                            <p id="confirm_password_error"></p>
                        </div>
                </div>
                <div class="submit-btn">
                    <a href=""></a>
                    <button type="submit" name="update_password" class="btn-submit">UPdate Password</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#user_pass").keyup(function() {
                $("#user_password_error").text('');
                $("#user_pass").addClass("box_error");
                error = true;
                $("#user_password_error").text('');
                error = false;
            });
            $("#confirm_password").keyup(function() {
                $("#confirm_password_error").text('');
                $("#confirm_password").addClass("box_error");
                error = true;
                $("#confirm_password_error").text('');
                error = false;
            });

            $("#Updatepasswordform").submit(function(event) {
                event.preventDefault();
                var user_pass = $("#user_pass").val();
                var confirm_password = $('#confirm_password').val();
                var user_id = $('#user_id').val();
                console.log("userId", user_id);
                var link = "<?php echo admin_url('admin-ajax.php') ?>"
                if ($("#user_pass").val() == '') {
                    $('#user_password_error').html("Please Enter Password.")
                    return false;

                } else if ($('#confirm_password').val() == '') {
                    $('#confirm_password_error').html("Please Enter confirm Password.")
                    return false;
                } else if ($('#user_pass').val() != $('#confirm_password').val()) {
                    $('#confirm_password_error').html("Password does not match !.")
                    return false
                }
                jQuery.ajax({
                    dataType: "json",
                    type: "post",
                    url: link,
                    data: {
                        'action': 'UPdataPassword',
                        user_pass: user_pass,
                        user_id: user_id
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $(".success-message").html(response.message);
                            window.location.href = "http://localhost/broncebat/login-page/"
                            $(".send-emailtitle").hide();
                        } else {
                            $(".error-message").html(response.message)

                        }

                    },
                    error: function(response) {
                        if (response.status == false) {
                            jQuery('.error-message').html(data.message);
                        }
                    }
                })
            })

        })
    </script>
</body>

</html>
<?php
get_footer();
?>
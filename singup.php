<?php

/****
 * Template Name:Singup
 * 
 */
get_header();
// get_template_part('header-custom')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_the_title() ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/custom.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-60">
        <div class="row">
            <div class="col-lg-6 marginaligin">
                <div class="innerdiv">
                    <div class="title">
                        <h2 class="title">Signup</h2>
                    </div>
                    <div class="success-message"></div>

                    <div class="form">
                        <form action="" method="post" id="myfrom">
                            <div class="form-group">
                                <label for="Fullname" class="font-weight">Full Name</label>
                                <input type="text" name="user_login" id="user_login" placeholder="Enter Full Name"><br>
                                <p id="name-error"></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight">Email</label>
                                <input type="text" name="user_email" id="user_email" placeholder="Enter Email"><br>
                                <div class="error-message"></div>
                                <p id="user_email_error" class="email_user"></p>
                            </div>
                            <div class="form-group">
                                <label for="Password" class="font-weight">Password</label>
                                <input type="password" name="user_pass" id="user_pass" placeholder="Enter Password"><br>
                                <p id="user_password_error" class="error_password"></p>
                            </div>
                            <div class="form-group">
                                <label for="Confirm Password" class="font-weight">Confirm Password</label>
                                <input type="password" name="user_pass" id="confirm_password" placeholder="Enter Confirm Password"><br>
                                <p id="confirm_password_error"></p>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn" class="btn-submit">Sign Up</button>
                            </div>
                            <a href="http://localhost/broncebat/login-page/">
                                <p class="bottom-text">Already have an account? Sign In</p>
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#user_login").keyup(function() {
                $("#name-error").text('');
                $("#user_login").addClass("box_error");
                error = true;
                $("#name-error").text('');
                error = false;
            });
            $("#user_email").keyup(function() {
                $("#user_email_error").text('');
                $("#user_email").addClass("box_error");
                error = true;
                $("#user_email_error").text('');
                error = false;
            });
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
            jQuery("#myfrom").submit(function(event) {
                event.preventDefault();
                var user_login = $("#user_login").val();
                var user_email = $("#user_email").val();
                var user_pass = $("#user_pass").val();
                var confirm_password = $('#confirm_password').val();
                var link = "<?php echo admin_url('admin-ajax.php') ?>"
                if ($("#user_login").val() == '') {
                    $("#name-error").html("Please Enter Full Name.")
                    return false
                } else if (!isNaN($('#user_login').val())) {
                    $("#fullname-error").html("Number is  not allowed.");
                    return false;
                } else if ($("#user_email").val() == '') {
                    $("#user_email_error").html("Please Enter the Email.");
                    return false

                } else if ($("#user_pass").val() == '') {
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
                        'action': 'SignupUser',
                        user_login: user_login,
                        user_email: user_email,
                        user_pass: user_pass
                    },
                    success: function(data) {
                        if (data.status == 'email_exist') {
                            $('.error-message').html(data.message);
                        } else if (data.status == 1) {
                            $('.success-message').html(data.message);
                            window.location.href = "http://localhost/broncebat/shop/"

                        }
                    },
                    error: function(data) {
                        if (data.status == false) {
                            jQuery('.success-message').html(data.message);

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
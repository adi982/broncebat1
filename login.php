<?php

/***
 * Template Name:Login page
 * 
 * 
 */
global $user_ID;
if (!$user_ID) {
    get_header();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/custom.css' ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>
        <div class="container mt-60">
            <div class="row mt-60">
                <div class="col-lg-6 marginaligin">
                    <div class="innerdiv">

                        <div class="title">
                            <h2 class="title">Login</h2>
                        </div>
                    </div>
                    <div class="success-message"></div>
                    <div class="error-message"></div>
                    <div class="loader" style="display: none;">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/loader-image.png' ?>" alt="Loading..." style="height:100px;width:100px,text-align:center;" />
                    </div>
                    <div class="form">
                        <form action="" method="post" id="login-form">

                            <div class="form-group">
                                <label for="email" class="font-weight">Email</label>
                                <input type="text" name="username" id="username" placeholder="Enter Email"><br>
                                <span id="user_email_error" class="email_user"></span>
                            </div>
                            <div class="form-group">
                                <label for="Password" class="font-weight">Password</label>
                                <input type="password" name="password" id="user_password" placeholder="Enter Password"><br>
                                <span id="user_password_error" class="error_password"></span>
                                <div class="lost-password">
                                    <a href="<?php echo ('http://localhost/broncebat/forgotpassword/') ?>">Forgot Password</a>

                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btn" class="btn-submit">Login</button>
                            </div>
                            <a href="http://localhost/broncebat/singup/">
                                <p class="bottom-text">Don't have an account? Sign Up</p>
                            </a>

                    </div>
                    </form>
                </div>


            </div>
        </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#username").keyup(function() {
                    $("#user_email_error").text('');
                    $("#username").addClass("box_error");
                    error = true;
                    $("#user_email_error").text('');
                    error = false;
                });
                $("#user_password").keyup(function() {
                    $("#user_password_error").text('');
                    $("#user_password").addClass("box_error");
                    error = true;
                    $("#user_password_error").text('');
                    error = false;
                });
                $("#login-form").submit(function(event) {
                    event.preventDefault();
                    var username = $("#username").val();
                    var user_password = $("#user_password").val();
                    var link = "<?php echo admin_url('admin-ajax.php') ?>"
                    if ($("#username").val() == '') {
                        $("#user_email_error").html("Please Enter the Email.");
                        return false
                    } else if (IsEmail(username) == false) {
                        $("#user_email_error").html("Please valid email");
                        return false
                    } else if ($("#user_password").val() == '') {
                        $('#user_password_error').html("Please Enter Password.")
                        return false;

                    }
                    jQuery.ajax({
                        dataType: "json",
                        type: "post",
                        url: link,
                        data: {
                            'action': 'LoginUser',
                            username: username,
                            user_password: user_password,
                        },
                        success: function(data) {
                            if (data.status == true) {
                                window.location = "http://localhost/broncebat/shop/"
                                $('.success-message').html(data.message);
                                $('.error-message').remove();
                                $('.loader').show();

                            } else if (data.status == false) {
                                $('.error-message').html(data.message);
                                jQuery('#myfrom').trigger('reset');
                            }

                            console.log(data);
                        },
                        error: function(data) {
                            if (data.status == false) {
                                jQuery('.success-message').html(data.message);

                            }
                        }
                    })
                })
            })

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </body>

    </html>
<?php
} else {
}

?>

<?php
get_footer();


?>
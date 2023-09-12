<?php

/**
 * Template Name:forgotpassword
 * 
 * 
 */
get_header();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/custom.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title></title>

</head>

<body>
    <div class="container mt-60">
        <div class="row mt-60">
            <div class="col-lg-6 marginaligin">
                <div class="innerdiv">
                    <div class="title">
                        <h2 class="send-emailtitle">Reset Password</h2>
                    </div>
                    <div class="success-message">
                        <div class="error-message">
                        </div>
                        <div class="form-group">
                            <form action="" method="post" id="email-form">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="user_email" id="user_email" placeholder="Enter Email"><br>
                                    <span id="user_email_error" class="email_user"></span>

                                </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn-submit">Send Email</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#user_email").keyup(function() {
                $("#user_email_error").text('');
                $("#user_email").addClass("box_error");
                error = true;
                $("#user_email_error").text('');
                error = false;
            });
            $("#email-form").submit(function(event) {
                event.preventDefault();
                // $('#loaderIcon').css('visibility', 'visible');
                // $('#loaderIcon').show();
                var user_email = $("#user_email").val();
                var id;
                console.log(id);
                var link = "<?php echo admin_url('admin-ajax.php') ?>"
                if ($("#user_email").val() == '') {
                    $("#user_email_error").html("Please Enter the Email.");
                    return false

                } else if (IsEmail(user_email) == false) {
                    $("#user_email_error").html("Please valid email");
                    return false
                }
                jQuery.ajax({
                    dataType: "json",
                    type: "post",
                    url: link,
                    data: {
                        'action': 'forgotpassword',
                        user_email: user_email,
                        // id:id,
                    },
                    success: function(data) {
                        if (data.status == true) {
                            $(".success-message").html(data.message)
                        } else if (data.status == false) {
                            $(".error-message").html(data.message)
                        }

                    },
                    error: function(data) {
                        if (data.status == false) {
                            jQuery('.error-message').html(data.message);
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
get_footer();
?>
<?php

/**
 * Template Name:CustomTemplate
 * 
 */
// get_header()
// Display the navigation menu

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <nav>
            <?php
            if (is_user_logged_in()) {
                // Display menu for logged-in users
                wp_nav_menu(array(
                    'theme_location' => 'primary', // Replace with your menu location or use 'menu' => 'Logged In Menu' to specify menu name directly
                    'menu_class' => 'menu',
                    'container' => false,
                ));
                // } elseif (get_transient('new_user_registered')) {
                //     // Display menu for newly registered users
                //     wp_nav_menu(array(
                //         'theme_location' => 'primary', // Replace with your menu location or use 'menu' => 'New User Menu' to specify menu name directly
                //         'menu_class' => 'menu',
                //         'container' => false,
                //     ));
                // } else {
                //     // Display menu for non-logged-in users or existing users
                //     wp_nav_menu(array(
                //         'theme_location' => 'default-menu', // Replace with your menu location or use 'menu' => 'Default Menu' to specify menu name directly
                //         'menu_class' => 'menu',
                //         'container' => false,
                //     ));
            }
            ?>
        </nav>
    </header>

</body>

</html>
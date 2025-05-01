<?php

function handle_registration_form() {
    if ( isset($_POST['register_submit']) ) {
        // دریافت داده‌ها از فرم
        $username = sanitize_user($_POST['username']);
        $email    = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        // بررسی اعتبار داده‌ها
        if ( empty($username) || empty($email) || empty($password) ) {
            echo '<p style="color:red;">تمام فیلدها را پر کنید.</p>';
        } elseif ( !is_email($email) ) {
            echo '<p style="color:red;">ایمیل وارد شده معتبر نیست.</p>';
        } elseif ( username_exists($username) ) {
            echo '<p style="color:red;">این نام کاربری قبلاً ثبت شده است.</p>';
        } elseif ( email_exists($email) ) {
            echo '<p style="color:red;">این ایمیل قبلاً ثبت شده است.</p>';
        } else {
            // ایجاد کاربر جدید
            $user_id = wp_create_user($username, $password, $email);

            if ( !is_wp_error($user_id) ) {
                echo '<p style="color:green;">ثبت‌نام با موفقیت انجام شد!</p>';
            } else {
                echo '<p style="color:red;">خطا در ثبت‌نام: ' . $user_id->get_error_message() . '</p>';
            }
        }
    }
}

add_action('init', 'handle_registration_form');
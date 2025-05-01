<?php

/**
 * Add custom admin tool to change site logo
 */
function add_change_logo_tool() {
    add_management_page(
        'تغییر لوگوی سایت',
        'تغییر لوگو',
        'manage_options',
        'change-site-logo',
        'change_site_logo_page'
    );
}

add_action('admin_menu', 'add_change_logo_tool');

function change_site_logo_page() {
    wp_enqueue_media();

    // پردازش عملیات حذف
    if ( isset($_POST['delete_logo']) && $_POST['delete_logo'] === '1' ) {
        if ( !isset($_POST['change_logo_nonce']) || !wp_verify_nonce($_POST['change_logo_nonce'], 'change_logo_action') ) {
            wp_die('خطای امنیتی!');
        }

        delete_option('site_custom_logo');
        echo '<div class="notice notice-success is-dismissible"><p>لوگوی سایت با موفقیت حذف شد.</p></div>';
        $current_logo = false;
    } // پردازش عملیات ذخیره
    elseif ( isset($_POST['submit_logo']) ) {
        if ( !isset($_POST['change_logo_nonce']) || !wp_verify_nonce($_POST['change_logo_nonce'], 'change_logo_action') ) {
            wp_die('خطای امنیتی!');
        }

        if ( !empty($_POST['site_logo_id']) ) {
            $attachment_id = intval($_POST['site_logo_id']);
            update_option('site_custom_logo', $attachment_id);
            echo '<div class="notice notice-success is-dismissible"><p>لوگوی سایت با موفقیت به‌روزرسانی شد.</p></div>';
            $current_logo = $attachment_id;
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>لطفاً یک تصویر انتخاب کنید.</p></div>';
            $current_logo = get_option('site_custom_logo');
        }
    } else {
        $current_logo = get_option('site_custom_logo');
    }
    ?>

    <div class="wrap">
        <h1>تغییر لوگوی سایت</h1>

        <form method="post">
            <?php wp_nonce_field('change_logo_action', 'change_logo_nonce'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">لوگوی فعلی</th>
                    <td>
                        <?php if ( $current_logo ) : ?>
                            <div id="current-logo-preview">
                                <?php echo wp_get_attachment_image($current_logo, 'medium'); ?>
                            </div>
                        <?php else : ?>
                            <p>لوگوی فعلی تنظیم نشده است.</p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">لوگوی جدید</th>
                    <td>
                        <input type="hidden" name="site_logo_id" id="site_logo_id"
                               value="<?php echo esc_attr($current_logo); ?>">
                        <input type="button" class="button" id="upload-logo-button" value="انتخاب تصویر از کتابخانه">
                        <?php if ( $current_logo ) : ?>
                            <button type="submit" name="delete_logo" class="button button-secondary" value="1"
                                    onclick="return confirm('آیا مطمئن هستید که می‌خواهید لوگو را حذف کنید؟');">حذف لوگو
                            </button>
                        <?php endif; ?>
                        <button type="submit" name="submit_logo" class="button button-primary">ذخیره تغییرات</button>
                    </td>
                </tr>
            </table>
        </form>

        <script>
            jQuery(document).ready(function ($) {
                // باز کردن کتابخانه رسانه
                $('#upload-logo-button').click(function (e) {
                    e.preventDefault();

                    var logoUploader = wp.media({
                        title: 'انتخاب لوگو',
                        button: {
                            text: 'استفاده از این تصویر'
                        },
                        multiple: false
                    });

                    logoUploader.on('select', function () {
                        var attachment = logoUploader.state().get('selection').first().toJSON();
                        $('#site_logo_id').val(attachment.id);

                        // نمایش پیش‌نمایش تصویر
                        var previewHtml = '<img src="' + attachment.url + '" alt="" style="max-width: 300px; height: auto;">';
                        $('#logo-preview').html(previewHtml);
                    });

                    logoUploader.open();
                });
            });
        </script>
    </div>
    <?php
}

function display_custom_logo() {
    $logo_id = get_option('site_custom_logo');
    if ( $logo_id ) {
        return wp_get_attachment_image($logo_id, 'full');
    }
    return '';
}

add_shortcode('custom_logo', 'display_custom_logo');
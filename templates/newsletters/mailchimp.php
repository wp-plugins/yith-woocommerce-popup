<?php
/**
 * Newsletter custom template
 *
 * @author Yithemes
 * @package YITH WooCommerce Popup
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YPOP_INIT' ) ) {
    exit;
} // Exit if accessed directly

$type_label        = YITH_Popup()->get_meta( $theme . '_label_position', $popup_id );
$email_label       = YITH_Popup()->get_meta( '_mailchimp-email-label', $popup_id );
$submit_label      = YITH_Popup()->get_meta( '_mailchimp-submit-label', $popup_id );
$placeholder_email = ( $type_label == 'placeholder' ) ? 'placeholder="' . $email_label . '"' : '';


$submit_icon = '';


?>
<div class="ypop-form-newsletter-wrapper">
<div class="message-box"></div>
<form method="post" action="#">
    <fieldset>
        <ul class="group">
            <li>
                <?php if( $type_label == 'label'){ echo '<label for="yit_mailchimp_newsletter_form_email">'.$email_label.'</label>'; } ?>
                <div class="newsletter_form_email">
                    <input type="text" <?php echo $placeholder_email ?> name="yit_mailchimp_newsletter_form_email" id="yit_mailchimp_newsletter_form_email" class="email-field text-field autoclear" />
                </div>
            </li>
            <li class="ypop-submit">
                <input type="hidden" name="yit_mailchimp_newsletter_form_id" value="<?php echo $popup_id?>"/>
                <input type="hidden" name="action" value="ypop_subscribe_mailchimp_user"/>
                <?php wp_nonce_field( 'yit_mailchimp_newsletter_form_nonce', 'yit_mailchimp_newsletter_form_nonce'); ?>
                <button type="submit" class="btn submit-field mailchimp-subscription-ajax-submit"><?php echo $submit_icon.$submit_label ?></button>
            </li>
        </ul>
    </fieldset>
</form>
</div>
<?php
yit_enqueue_script( 'yit-mailchimp-ajax-send-form', YITH_YPOP_ASSETS_URL.'/js/mailchimp-ajax-subscribe.js', array( 'jquery' ), '', true);
wp_localize_script( 'yit-mailchimp-ajax-send-form', 'mailchimp_localization', array( 'url' => admin_url( 'admin-ajax.php' ), 'error_message' => 'Ops! Something went wrong' ) );
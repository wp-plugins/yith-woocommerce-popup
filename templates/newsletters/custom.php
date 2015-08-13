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

$type_label       = YITH_Popup()->get_meta( $theme.'_label_position', $popup_id );

$show_name        = YITH_Popup()->get_meta( '_newsletter-show-name', $popup_id );
$method           = YITH_Popup()->get_meta( '_newsletter-method', $popup_id );
$action           = YITH_Popup()->get_meta( '_newsletter-action', $popup_id );
$name_label       = YITH_Popup()->get_meta( '_newsletter-name-label', $popup_id );
$name_name        = YITH_Popup()->get_meta( '_newsletter-name-name', $popup_id );
$email_label      = YITH_Popup()->get_meta( '_newsletter-email-label', $popup_id );
$email_name       = YITH_Popup()->get_meta( '_newsletter-email-name', $popup_id );
$hidden_fields    = YITH_Popup()->get_meta( '_newsletter-hidden-fields', $popup_id );
$submit_label     = YITH_Popup()->get_meta( '_newsletter-submit-label', $popup_id );
$placeholder_name = ( $type_label == 'placeholder' ) ? 'placeholder="' . $name_label . '"' : '';
$placeholder_email = ( $type_label == 'placeholder' ) ? 'placeholder="' . $email_label . '"' : '';

$icon = YITH_Popup()->get_meta( '_submit_button_icon', $popup_id );
$submit_icon = '';
if (!empty($icon)) {
   switch ($icon['select']) {
        case 'icon' :
            $submit_icon = '<span class="icon" ' . ypop_get_icon_data($icon['icon']) . ' style="padding-right:10px; "></span>';
            break;
        case 'custom' :
            $submit_icon = '<span class="custom_icon"><img src="' . $icon['custom'] . '" style="max-width :27px;max-height: 25px;"/></span>';
            break;
    }
}

?>
<div class="ypop-form-newsletter-wrapper">
    <form method="<?php echo $method ?>" action="<?php echo $action ?>">
        <fieldset>
            <ul class="group">
                <?php if( $show_name == 'yes'): ?>
                <li>
                    <?php if( $type_label == 'label'){ echo '<label for="'.$name_name.'">'.$name_label.'</label>'; } ?>
                    <div class="newsletter_form_name">
                        <input type="text" <?php echo $placeholder_name ?> name="<?php echo $name_name ?>" id="<?php echo $name_name ?>" class="name-field text-field autoclear" />
                    </div>
                </li>
                <?php endif ?>
                <li>
                    <?php if( $type_label == 'label'){ echo '<label for="'.$email_name.'">'.$email_label.'</label>'; } ?>
                    <div class="newsletter_form_email">
                        <input type="text" <?php echo $placeholder_email ?> name="<?php echo $email_name ?>" id="<?php echo $email_name ?>" class="email-field text-field autoclear" />
                    </div>
                </li>
                <li class="ypop-submit">
                    <?php
                    if ( $hidden_fields != '' ) {
                        $hidden_fields = explode( '&', $hidden_fields );
                        foreach ( $hidden_fields as $field ) {
                            list( $id_field, $value_field ) = explode( '=', $field );
                            echo '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                        }
                    }
                    ?>

                    <button type="submit" class="btn submit-field"><?php echo $submit_icon.$submit_label ?></button>
                </li>
            </ul>
        </fieldset>
    </form>
</div>
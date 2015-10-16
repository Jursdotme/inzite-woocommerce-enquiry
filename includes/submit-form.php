<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="box_not_fixed count_2 type_right">
  <form name="enquiryForm" class="custom" method="post">
    <input type="hidden" name="mail" value="send" />

      <div class="enquiry-form">
        <h3><?php _e('Your contact information', 'inzite-woocommerce-enquiry'); ?></h3>

        <div class="form-group half">
          <label><?php _e('Company name', 'inzite-woocommerce-enquiry'); ?></label>
          <input type="text" name="company" placeholder='' />
        </div>

        <div class="form-group half last">
          <label><?php _e('Contact', 'inzite-woocommerce-enquiry'); ?></label>
          <input type="text" name="contact_name" placeholder='' />
        </div>

        <div class="form-group half">
          <label><?php _e('Email', 'inzite-woocommerce-enquiry'); ?></label>
          <input type="text" name="email" placeholder='' />
        </div>

        <div class="form-group half last">
          <label><?php _e('Phone', 'inzite-woocommerce-enquiry'); ?></label>
          <input type="text" name="phone" placeholder='' />
        </div>

        <div class="form-group">
          <label><?php _e('Additional info', 'inzite-woocommerce-enquiry'); ?></label>
          <textarea rows="3" name="country" placeholder='' /></textarea>
        </div>

      </div>
    <div class="the-cart">
      <h3><?php _e('Products in your enquiry', 'inzite-woocommerce-enquiry'); ?></h3>

      <div class="enquiry-cart">
        <?php include( plugin_dir_path( __FILE__ ) . 'cart.php'); ?>
      </div>

      <a class="button disabled" style="float:left; margin: 10px 0;" id="emptyEnquiry"><?php _e('Empty inquiry', 'inzite-woocommerce-enquiry'); ?></a>
      <input type="submit" class="button"  style="float:right; margin: 10px 0;" value="<?php _e('Send inquiry', 'inzite-woocommerce-enquiry'); ?>" />
      <br class="clear">
    </div>
  </form>
</div>

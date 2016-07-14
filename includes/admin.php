<?php
add_action( 'admin_menu', 'inzite_enquiry_admin_menu' );

function inzite_enquiry_admin_menu() {
	add_options_page(
    'Enquiry',
    'Enquiry',
    'manage_options',
    'inzite-enquiry/inzite-enquiry-admin-page.php',
    'inzite_enquiry_admin_page',
    'dashicons-admin-generic',
    6
  );
}

function inzite_enquiry_admin_page(){
  inzite_enquiry_settings_save();
  echo '<div class="wrap">'.
            '<h2>Enquiry setting</h2>'.
            '<form id="inzite_enquiry_form" action="options-general.php?page=inzite-enquiry%2Finzite-enquiry-admin-page.php" method="post">';
    echo    '<table class="form-table">'.
            '<tbody>';

    echo        '<tr>'.
                '<th style="width:150px;">Modtager email:</th>'.
                '<td><input type="text" name="inzite_enquiry_recipient" value="'.get_option( 'inzite_enquiry_recipient' ).'" size="75"></td>'.
                '</tr>';

    echo        '<tr>'.
                '<th style="width:150px;"><input type="submit" value="Gem indstillinger" class="button button-primary"></th>'.
                '<td></td>'.
                '</tr>';

    echo    '</tbody>'.
            '</table>';

    echo    '</form>'.
         '</div>';
}

function inzite_enquiry_settings_save() {
    if( 'POST' == $_SERVER['REQUEST_METHOD']){
        update_option( 'inzite_enquiry_recipient', sanitize_text_field( $_POST['inzite_enquiry_recipient'] )  );
    }
}

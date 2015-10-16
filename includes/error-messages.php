<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//Display error note
echo "<div class=\"error-wrapper\">";

if (empty($posted_products))
  {
    echo "<div class=\"alert warning\">" . __('You haven\'t choosen any products yet.', 'inzite-woocommerce-enquiry') . "<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
  }
if ($posted_company == "")
  {
    echo "<div class=\"alert warning\">" . __('You forgot to type in the company name.', 'inzite-woocommerce-enquiry') . "<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
  }
if ($posted_name == "")
  {
    echo "<div class=\"alert warning\">" . __('You forgot to type in the name of your contact person.', 'inzite-woocommerce-enquiry') . "<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
  }
if ($posted_email == "")
  {
    echo "<div class=\"alert warning\">" . __('You forgot to type in your email address.', 'inzite-woocommerce-enquiry') . "<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
  }
if ($posted_validation == 0)
  {
    echo "<div class=\"alert warning\">" . __('Check your email address, something is wrong.', 'inzite-woocommerce-enquiry') . "<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
  }
if ($posted_phone == "")
  {
    echo "<div class=\"alert warning\">" . __('You forgot to type in your phone number.', 'inzite-woocommerce-enquiry') . "<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
  }
echo "<div style='clear: both;'></div>";
echo "</div>";

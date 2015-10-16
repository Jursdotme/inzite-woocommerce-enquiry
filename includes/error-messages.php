<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function curPageURL() {

  $pageURL = 'http';

  if(isset($_SERVER['HTTPS'])) {
    if ($_SERVER['HTTPS'] == "on") {
      $pageURL .= "s";
    }
  }

  $pageURL .= "://";

  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }

  return $pageURL;
}

if ($_POST) {

  $posted_products = $_POST['products'];
  $posted_company = $_POST['company'];
  $posted_name = $_POST['contact_name'];
  $posted_email = $_POST['email'];
  $posted_phone = $_POST['phone'];
  $posted_country = $_POST['country'];


  $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

  if (preg_match($regex, $posted_email))
  {
    $posted_validation = 1;
  }
  else
  {
    $posted_validation = 0;
  }

  if (!empty($posted_products) && ($posted_email != "" && $posted_validation == 1) && $posted_phone != "" && $posted_company != "" && $posted_name != "")
  {

    $mail_headers = "From: <kangamiut@kangamiut.dk>" . "\r\n";
    $mail_subject = "Thank you for your inquiry";
    $mail_message = "";

    $mail_to = $posted_email;


    $mail_message .= "<div>&nbsp;</div>";
    $mail_message .= "<div>&nbsp;</div>";
    $mail_message .= "<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";

    $mail_message .= "<tr><td colspan=\"2\">";
    $mail_message .= "<div>&nbsp;</div>";

    $mail_config = new WP_Query( array( 'post_type'=>'enquiry_config', 'posts_per_page'<='1', 'orderby'=>'title', 'order'=>'asc' ));
    if ( $mail_config->have_posts() )
    {
      while ( $mail_config->have_posts() ) : $mail_config->the_post();
        if ($mail_to != "") { $mail_to .= ","; }
        $mail_to .= $mail_config->post->post_title;
        $mail_message .= $mail_config->post->post_content;
      endwhile;
    }
    else
    {
      $mail_to .= get_option('admin_email');
    }

    $mail_message .= "<div>&nbsp;</div>";
    $mail_message .= "</td></tr>";

    $mail_message .= "<tr><td width=\"125\">Company:</td><td> " . $posted_company . "</td></tr>";
    $mail_message .= "<tr><td>Contact:</td><td> " . $posted_name . "</td></tr>";
    $mail_message .= "<tr><td>E-mail:</td><td> " . $posted_email . "</td></tr>";
    $mail_message .= "<tr><td>Phone:</td><td> " . $posted_phone . "</td></tr>";
    $mail_message .= "<tr><td>Additional info:</td><td> " . $posted_country . "</td></tr>";
    $mail_message .= "<tr><td colspan=\"2\">";
    $mail_message .= "<div>&nbsp;</div>";
    $mail_message .= "<div><b>Products</b></div>";

    if (!empty($posted_products))
    {
      $mail_message .= "<ul style=\"padding-left:20px;\">";
      foreach($posted_products as $posted_products)
      {
        $mail_message .= "<li>" . $posted_products . "</li>";
      }
      $mail_message .= "</ul>";
    }

    $mail_message .= "<div>&nbsp;</div>";
    $mail_message .= "</td></tr>";
    $mail_message .= "</table>";


    //Send mail
    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));


    wp_mail($mail_to, $mail_subject, $mail_message, $mail_headers);

      //Display thank you note
      echo "<div class=\"row\">";
          //echo "		<div>" . $mail_headers . "</div>";
          //echo "		<div>Sending mail to: ". $mail_to ."</div>";
          //echo "		<div>Subject: " . $mail_subject . "</div>";
          echo "		<div>" . $mail_message . "</div>";
          echo "		<div><a class=\"button\" style=\"float:right;\" href=\"". curPageURL() ."\">Go back</a></div>";
    echo "		<div style='clear: both;'></div>";
    echo "</div>";

    echo "<script>";
    echo "deleteCookies();";
    echo "</script>";
  }
  else
  {
    //Display error note
      echo "<div class=\"error-wrapper\">";
          // echo "		<div><h1>Error:</h1></div>";
    if (empty($posted_products))
    {
            echo "	<div class=\"alert warning\">You have no products chosen<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
    }
    if ($posted_company == "")
    {
            echo "	<div class=\"alert warning\">You forgot to type in the company name<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
    }
    if ($posted_name == "")
    {
            echo "	<div class=\"alert warning\">You forgot to type in your name<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
    }
    if ($posted_email == "")
    {
            echo "	<div class=\"alert warning\">You forgot to type in your email address<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
    }
    if ($posted_validation == 0)
    {
            echo "	<div class=\"alert warning\">Check your email address, somethings wrong<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
    }
    if ($posted_phone == "")
    {
            echo "	<div class=\"alert warning\">You forgot to type in your phone number<a class=\"close\" style=\"cursor:pointer;\">&times;</a></div>";
    }
          // echo "		<div><a class=\"button\" href=\"javascript:history.go(-1);\">Go back</a></div>";
    echo "		<div style='clear: both;'></div>";
    echo "</div>";
  }
}

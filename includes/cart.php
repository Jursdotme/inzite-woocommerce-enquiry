<?php
$prefix        = 'enquiry-';
$enquiry_items = array();

foreach($_COOKIE as $name => $value) {
  if(strpos($name, $prefix) === 0) {
    array_push($enquiry_items, $_COOKIE[$name]);
  }
}

// WP_Query arguments
$args = array (
  'post__in'  => $enquiry_items,
  'post_type' => array( 'product' ),
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() && !empty($enquiry_items) ) {
  while ( $query->have_posts() ) {
    $query->the_post(); ?>

      <div id="<?php the_id(); ?>-div" class="enquiry-item">
        <?php the_title(); ?>
        <a class="close" style="cursor:pointer;" onclick="deleteValue('<?php the_id(); ?>');">&times;</a>
        <input type="hidden" id="<?php the_id(); ?>-input" name="products[]" value="<?php the_id(); ?>" />
      </div>


  <?php }
} else { ?>
  <div id="<?php the_id(); ?>-div" class="enquiry-item">
    <?php _e('You have not added anything to your enquiry yet.', 'inzite-woocommerce-enquiry') ?>
  </div>
<?php }

// Restore original Post Data
wp_reset_postdata();?>

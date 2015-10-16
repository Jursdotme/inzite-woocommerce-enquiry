<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
Template Name: Enquiry
*/

?>
<?php get_header(); ?>
<div class="content">
	<?php get_template_part('partials/top_slider') ?>
		<main role="main">
			<!-- section -->
			<section>
				<?php the_content(); ?>
				<div class="contentrow not-full">
					<?php
						$is_posted = $_POST['mail'];

						if ($is_posted == "send") {

							include( plugin_dir_path( __FILE__ ) . 'includes/error-messages.php');

						} else { ?>

							<div class="box_not_fixed count_2 type_right" style="background:#eee;">
								<div class="enquiry">
									<h3>Available Products</h3>
									<form name="formProducts">
										<?php
										$sub_terms = get_terms("product_type", "parent=0&hide_empty=0");
										$sub_count = count($sub_terms);
										if ( $sub_count > 0 ){

											foreach ( $sub_terms as $sub_term ) {
										    //echo "<fieldset>";
										    //echo "<legend>&nbsp;" . $sub_term->name . "&nbsp;</legend>";
										    $loop1 = new WP_Query( array( 'post_type'=>'enquiry', 'posts_per_page'=>'-1','orderby'=>'menu_order', 'order'=>'asc', 'tax_query' => array(array('taxonomy' => 'product_type', 'terms' => $sub_term->term_id)) 	));
												while ( $loop1->have_posts() ) : $loop1->the_post(); ?>
													<label for="<?php echo "enquiry-" . $loop1->post->ID; ?>">
														<input type="checkbox" id="<?php echo "enquiry-" . $loop1->post->ID; ?>" value="<?php the_title() ?>" name="<i><?php echo $sub_term->name ?>&nbsp;</i><b><?php the_title() ?></b>" class="enquiry-check"> <?php the_title() ?> <a href="<?php echo get_permalink($loop1->post->ID);?>"><?php echo __('Read more');?></a>
													</label>
												<?php endwhile;
												//echo "</fieldset>";
											}
											echo "<div style=\"text-align:right; margin:10px 0;\"><a class=\"add2enquiry button\" style=\"margin-bottom: 10px;\" onClick=\"checkValues()\">Add to inquiry</a></div>";
										} ?>
									</form>
								</div>
							</div>


							<?php include( plugin_dir_path( __FILE__ ) . 'includes/submit-form.php'); ?>

						<?php	}	?>
				</div>
			</section>
		</main>
</div>
<?php get_footer(); ?>

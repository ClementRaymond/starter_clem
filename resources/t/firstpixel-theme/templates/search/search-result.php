<?php
/**
 * Description for undefined
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.5.1
 */
ob_start();
if ( have_posts() ){
	echo '<ul class="no-bullet">';
	while ( have_posts() ) {
		the_post();
		get_template_part( 'templates/search/search', 'item' );
	}
	echo '</ul>';
} else {
	?><div class="columns medium-centered medium-8">
		<h1><?php _e( "No result", 'firstPixel' ); ?></h1>
		<p><?php _e( "Try to search again", 'firstPixel' ); ?></p>
		<?php get_search_form(); ?>
	</div><?php
}
$out = ob_get_clean();
?>
<section class="row">
	<?= $out; ?>
</section>

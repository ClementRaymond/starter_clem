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
global $post;
?>
<li>
    <article id="post-<?php the_ID(); ?>" <?php post_class('columns'); ?>>
        <div class="row">
            <?php if (has_post_thumbnail()): ?>
                <div class="columns medium-6">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="columns medium-6">
            <?php else: ?>
                <div class="columns medium-12">
            <?php endif; ?>
                <h2><?php the_title(); ?></h2>
                <div class="content">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>"><?php _e( "Read more", 'firstPixel' ); ?></a>
            </div>

        </div>
    </article>
</li>

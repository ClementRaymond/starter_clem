<?php
function post_published_guarantee( $post_id ) {
  $post_type   = get_post_type($post_id);
  $post_status = get_post_status($post_id);

  if ($post_type == 'garantie' && $post_status == 'publish') {
    $title = get_the_title($post_id);
    $permalink = get_permalink( $post_id );
    $edit = get_edit_post_link( $post_id, '' );
    $to = 'cleraymond33@hotmail.fr';
    $subject = 'Garantie 36pixels';
    $message = '<p>'. 'Votre garantie commence aujourd\'hui et ce finira le .... pour une durée de 2 mois' .'</p>' . '<br/>';
    $message .= '<p>'. 'Un message vous sera envoyé 2 jours avant la fin' .'</p>';

    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $message, $headers);
  }
}
add_action( 'save_post', 'post_published_guarantee',2);

function sample_admin_notice__success($post_id) {
  $title      = get_the_title($post_id);
  $countposts = wp_count_posts('garantie')->publish;
  $query_posts = new WP_Query(array('post_type'=>'garantie'));
  $g_posts = $query_posts->posts;


  foreach ($g_posts as $key => $g_post) {
    $timePost = $g_post->post_date;
    $startDate = strtotime($timePost);
    $endDate = get_field('end_date', $query_posts);

    echo '<pre>';
      var_dump( $query_posts );
    echo '</pre>';


    if ($countposts > 0): ?>
        <div class="notice notice-warning">
            <p><?php _e( 'La garantie concernant la réalisation du projet '. $g_post->post_title .' est valable jusqu\'au ... .
            Merci de nous faire vos retours au plus vite !', 'sample-text-domain' ); ?></p>
        </div>
    <?php endif;
  }
}
add_action( 'admin_notices', 'sample_admin_notice__success',2 );

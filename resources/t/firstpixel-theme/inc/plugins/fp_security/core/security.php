<?php


function is_custom_login_page() {
  if (function_exists( 'get_field' )) {
    $custom_log = get_field('log_slug', 'option');
  }else {
    $custom_log = 'connect';
  }

  if (strpos($GLOBALS['_SERVER']['REQUEST_URI'], $custom_log) !== false) {
    return true;
  }else {
    return false;
  }
}

$security = new Security();

if (is_login_page() == 1 && !is_user_logged_in()) {
  $security->Log_in();
}

if (is_custom_login_page()) {
  if (!is_user_logged_in()) {
    $security->Custom_log();
  }else {
    wp_redirect(get_admin_url());
    exit;
  }
}


add_action( 'login_form', 'login_extra_note' );
function login_extra_note() {

  if ( false === ( $hash_log = get_transient( 'securityhash' ) ) ) {
    $bytes = openssl_random_pseudo_bytes(5, $cstrong);
    $hash_log = bin2hex($bytes);
    set_transient( 'securityhash', $hash_log, (60*60*24));
  }

  ?>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      var form = document.querySelector('#loginform');
      form.action = form.action + '?hash=<?= $hash_log; ?>';
    });
  </script>
  <?php
}

<?php

class Security
{

  public function Log_in()
  {
    if (!isset($_GET['hash'])) {
      global $wp_query;
      $wp_query->set_404();
      status_header( 404 );
      get_template_part( 404 );
      exit();
    }else {
      if ( false === ( $hash_log = get_transient( 'securityhash' ) ) ) {
        $bytes = openssl_random_pseudo_bytes(5, $cstrong);
        $hash_log = bin2hex($bytes);
        set_transient( 'securityhash', $hash_log, (60*60*24));
      }

      $query_hash = $_GET['hash'];

      if ($query_hash !== $hash_log) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        get_template_part( 404 );
        exit();
      }
    }
  }

  public function Custom_log()
  {

    if ( false === ( $hash_log = get_transient( 'securityhash' ) ) ) {
      $bytes = openssl_random_pseudo_bytes(5, $cstrong);
      $hash_log = bin2hex($bytes);
      set_transient( 'securityhash', $hash_log, (60*60*24));
    }
    $url = wp_login_url().'?hash='.$hash_log;
    wp_redirect($url);
    exit;
  }
}

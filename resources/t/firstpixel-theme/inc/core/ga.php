<?php
/**
 * Add the basics of Google Analytics to wordpress
 */
class GoogleAnalyticsOpt {

  public function __construct() {
    add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    add_action( 'wp_head', array( $this, 'enqueue_scripts' ) );
  }

  /**
   * Register admin menu
   */
  public function admin_menu() {
    add_menu_page(
      'Google Analytics',
      'Google Analytics',
      'manage_options',
      'google_analytics',
      [$this, 'settings_page'],
      'dashicons-analytics'
    );
  }

  /**
   * Register settings into wordpress
   */
  public function register_settings() {
    register_setting( 'google_analytics', 'ga_id' );
  }

  /**
   * Settings page content
   */
  public function settings_page() {
    ?>
      <div class="wrap">
        <h1>Google Analytics Options</h1>

        <form method="post" action="options.php">
        <?php settings_fields( 'google_analytics' ); ?>
        <?php do_settings_sections( 'google_analytics' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">ID de suivi</th>
            <td><input type="text" name="ga_id" value="<?php echo esc_attr( get_option('ga_id') ); ?>" /></td>
            </tr>
        </table>

        <?php
          $id = get_option('ga_id');
          if (self::isValidID($id)) {
            echo _x( 'Google Analytics is activated with the following ID:', 'ga_enabled' ) . ' <strong>' . $id . '</strong>';
          } else {
            echo _x( 'Google Analytics is not activated, maybe the given ID is not a valid ID!', 'ga_disabled' );
          }
        ?>

        <?php submit_button(); ?>

        </form>
      </div>
    <?php
  }

  /**
   * Add Google Analytics Script to page if an ID has been set
   */
  public function enqueue_scripts() {
    $id = get_option('ga_id');
    if (self::isValidID($id)) {
      ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $id; ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', '<?= $id; ?>');
        </script>
      <?php
    }
  }

  /**
   * Check if a google analytics ID is valid
   *
   * @param string $id - google analytics id
   * @return bool - true if valid
   */
  private static function isValidID(string $id):bool {
    if (
      $id &&
      is_string($id) &&
      $id !== "" &&
      preg_match('/^ua-\d{4,9}-\d{1,4}$/i', $id)
    ) {
      return true;
    }
    return false;
  }
}

new GoogleAnalyticsOpt();

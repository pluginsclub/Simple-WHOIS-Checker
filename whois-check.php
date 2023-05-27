<?php
/*
 * Plugin Name: Whois Checker
 * Plugin URI: https://wpxss.com/whois
 * Description: Provides a Whois form with a shortcode.
 * Version: 1.0
 * Author: plugins.club
 * Author URI: https://plugins.club
 */
function whois_shortcode( $atts ) {
  ob_start();
  ?>
  <form method="post" action="">
    <input type="text" name="domain" placeholder="Enter a domain name" required>
    <button type="submit">Lookup</button>
  </form>
  <?php
  if ( isset( $_POST['domain'] ) ) {
    $domain = sanitize_text_field( $_POST['domain'] );
    $whois = shell_exec( "whois $domain" );
    ?>
    <pre><?php echo $whois; ?></pre>
    <?php
  }
  return ob_get_clean();
}
add_shortcode( 'whois', 'whois_shortcode' );

<?php
/**
 * Description for undefined
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.4
 */

$color_four = '#2BACDF';
$color_clock_border = '#6EE9F9';
$color_clock_content = '#FFFFFF';

?>

<!-- //; -->

<div class="fourofour">

  <div class="row">
      <div class="small-12 columns fourofour__container">
          <!-- <img src="<?//= IMAGES_URL; ?>/404.gif" alt="404Gif"> -->
          <svg width="608px" height="243px" viewBox="0 0 608 243" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Group-2" transform="translate(-10.000000, -100.000000)">
                    <text id="4--1" font-family="AvenirNext-Heavy, Avenir Next" font-size="343" font-weight="600" fill="<?= $color_four; ?>">
                        <tspan x="0" y="343">4</tspan>
                    </text>
                    <g id="clock" transform="translate(197.000000, 100.000000)">
                        <circle id="Oval" fill="<?= $color_clock_border; ?>" cx="121" cy="121" r="121"></circle>
                        <circle id="Oval-2" fill="<?= $color_clock_content; ?>" cx="121" cy="121" r="102"></circle>
                        <g id="Path-2" transform="translate(47.000000, 94.000000)" fill="<?= $color_clock_border; ?>">
                            <polygon class="aiguille" points="91.9238281 28.2441406 89.7890625 35.3183594 0 0"></polygon>
                            <circle id="Oval-3" cx="72.5" cy="25.5" r="9.5"></circle>
                        </g>
                        <polygon id="Path-3" fill="<?= $color_clock_border; ?>" points="120.853516 136.416016 115.21875 136.416016 124 70"></polygon>
                        <g id="Line" transform="translate(24.000000, 24.000000)" stroke-width="4" stroke="<?= $color_clock_border; ?>" stroke-linecap="square">
                            <path d="M95,182.5 L95,193"></path>
                            <path d="M16.5,144.5 L25,139" id="Line-2"></path>
                            <path d="M56,170 L50,178" id="Line-Copy"></path>
                            <path d="M6.2890625,91.046875 L6.2890625,101.546875" transform="translate(6.289062, 96.046875) rotate(90.000000) translate(-6.289062, -96.046875) "></path>
                            <path d="M47.7890625,24.046875 L56.2890625,18.546875" id="Line-2" transform="translate(51.789062, 21.546875) rotate(90.000000) translate(-51.789062, -21.546875) "></path>
                            <path d="M22.7890625,50.046875 L16.7890625,58.046875" id="Line-Copy" transform="translate(19.789062, 54.046875) rotate(90.000000) translate(-19.789062, -54.046875) "></path>
                            <path d="M95.015625,1.13671875 L95.015625,11.6367187" transform="translate(95.015625, 6.136719) rotate(-180.000000) translate(-95.015625, -6.136719) "></path>
                            <path d="M165.515625,54.1367188 L174.015625,48.6367188" id="Line-2" transform="translate(169.515625, 51.636719) rotate(-180.000000) translate(-169.515625, -51.636719) "></path>
                            <path d="M140.015625,15.6367188 L134.015625,23.6367187" id="Line-Copy" transform="translate(137.015625, 19.636719) rotate(-180.000000) translate(-137.015625, -19.636719) "></path>
                            <path d="M134,175 L142.5,169.5" id="Line-2" transform="translate(138.000000, 172.500000) rotate(-90.000000) translate(-138.000000, -172.500000) "></path>
                            <path d="M95,0.5 L95,11"></path>
                        </g>
                    </g>
                    <text id="4---2" font-family="AvenirNext-Heavy, Avenir Next" font-size="343" font-weight="600" fill="<?= $color_four; ?>">
                        <tspan x="383" y="343">4</tspan>
                    </text>
                </g>
            </g>
        </svg>
          <h3><?php _e( 'The page you are looking for doesn\'t exist or is not available anymore.', 'firstPixel') ?></h3>
          <a href="<?= home_url( '/' ); ?>"><?php _e( 'Back to Home', 'firstPixel'); ?></a>
      </div>
  </div>
</div>

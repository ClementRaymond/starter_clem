<?php
/*
Plugin Name: FirstPixel Images
Plugin URI: https://www.36pixels.fr
Description: Optimisation des tailles d'image et renommage (accents / majuscules...)
Author: M6 Pixels
Version: 1.0
Author URI: https://www.36pixels.fr
*/

function fp_images_replace_uploaded_image($image_data) {
      // if there is no large image : return
  if (!isset($image_data['sizes']['large'])) return $image_data;

  // paths to the uploaded image and the large image
  $upload_dir = wp_upload_dir();
  $uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file'];
  // $large_image_location = $upload_dir['path'] . '/'.$image_data['sizes']['large']['file']; // ** This only works for new image uploads - fixed for older images below.
  $current_subdir = substr($image_data['file'],0,strrpos($image_data['file'],"/"));
  $large_image_location = $upload_dir['basedir'] . '/'.$current_subdir.'/'.$image_data['sizes']['large']['file'];

  // delete the uploaded image
  unlink($uploaded_image_location);

  // rename the large image
  rename($large_image_location,$uploaded_image_location);

  // update image metadata and return them
  $image_data['width'] = $image_data['sizes']['large']['width'];
  $image_data['height'] = $image_data['sizes']['large']['height'];
  unset($image_data['sizes']['large']);

  return $image_data;
}

add_filter('wp_generate_attachment_metadata','fp_images_replace_uploaded_image');

add_action( 'switch_theme', 'fp_images_enforce_image_size_options' );
function fp_images_enforce_image_size_options() {
	update_option( 'large_size_w', 2500 );
	update_option( 'large_size_h', 1500 );
}

add_filter('sanitize_file_name', 'remove_accents' );
add_filter('sanitize_file_name', 'fp_images_sanitize_french_chars', 10);
function fp_images_sanitize_french_chars($filename) {

	/* Force the file name in UTF-8 (encoding Windows / OS X / Linux) */
	$filename = mb_convert_encoding($filename, "UTF-8");

	$char_not_clean = array('/À/','/Á/','/Â/','/Ã/','/Ä/','/Å/','/Ç/','/È/','/É/','/Ê/','/Ë/','/Ì/','/Í/','/Î/','/Ï/','/Ò/','/Ó/','/Ô/','/Õ/','/Ö/','/Ù/','/Ú/','/Û/','/Ü/','/Ý/','/à/','/á/','/â/','/ã/','/ä/','/å/','/ç/','/è/','/é/','/ê/','/ë/','/ì/','/í/','/î/','/ï/','/ð/','/ò/','/ó/','/ô/','/õ/','/ö/','/ù/','/ú/','/û/','/ü/','/ý/','/ÿ/', '/©/');
	$clean = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y','copy');

	$friendly_filename = preg_replace($char_not_clean, $clean, $filename);


	/* After replacement, we destroy the last residues */
	$friendly_filename = utf8_decode($friendly_filename);
	$friendly_filename = preg_replace('/\?/', '', $friendly_filename);


	/* Lowercase */
	$friendly_filename = strtolower($friendly_filename);

	return $friendly_filename;
}
?>

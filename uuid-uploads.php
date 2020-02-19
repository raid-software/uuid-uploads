<?php
/*
Plugin Name:        UUID Filename
Plugin URI:         https://github.com/raid-software/uuid-uploads
Description:        Assign uploads a UUIDv4 filename.
Version:            1.0.0
Author:             RAID IVS
Author URI:         https://raid.dk/
GitHub Plugin URI:  https://github.com/raid-software/uuid-uploads

License:            MIT License
License URI:        https://opensource.org/licenses/MIT
*/

namespace RAID\WP\UUIDUploads;

/** Init plugin */
function init() {
  /**
   * Return a UUIDv4 filename
   * @param  string $filename The filename to be sanitized
   * @return string           The new filename
   */
  function uuid_file_name($filename) {
    $uuid =  vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

    // Extract file info
    $file = pathinfo($filename);
    $ext = "";

    // Set file extension
    if(!empty($file['extension'])) {
      $ext = "." . $file['extension'];
    }
    return $uuid . $ext;
  }

  add_filter('sanitize_file_name', __NAMESPACE__ . '\\uuid_file_name', 10);
}
add_action('init', __NAMESPACE__ . '\\init', 10);

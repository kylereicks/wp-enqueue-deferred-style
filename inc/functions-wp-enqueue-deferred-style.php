<?php

function wp_register_deferred_style($handle, $src, $deps = array(), $ver = false, $media = 'all'){
  WP_Enqueue_Deferred_Style::get_instance()->register_deferred_style($handle, $src, $deps, $ver, $media);
}

function wp_enqueue_deferred_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all'){
  WP_Enqueue_Deferred_Style::get_instance()->enqueue_deferred_style($handle, $src, $deps, $ver, $media);
}

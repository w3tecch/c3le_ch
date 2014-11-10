<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_js_alter().
 */
function bootstrap_c3le_js_alter(&$js) {
  // Exclude specified JavaScript files from theme.
  $excludes = bootstrap_get_theme_info(NULL, 'exclude][js');

  $theme_path = drupal_get_path('theme', 'bootstrap');

  // Add or replace JavaScript files when matching paths are detected.
  // Replacement files must begin with '_', like '_node.js'.
  $files = _bootstrap_file_scan_directory($theme_path . '/js', '/\.js$/');
  foreach ($files as $file) {
    $path = str_replace($theme_path . '/js/', '', $file->uri);
    // Detect if this is a replacement file.
    $replace = FALSE;
    if (preg_match('/^[_]/', $file->filename)) {
      $replace = TRUE;
      $path = dirname($path) . '/' . preg_replace('/^[_]/', '', $file->filename);
    }
    $matches = array();
    if (preg_match('/^modules\/([^\/]*)/', $path, $matches)) {
      if (!module_exists($matches[1])) {
        continue;
      }
      else {
        $path = str_replace('modules/' . $matches[1], drupal_get_path('module', $matches[1]), $path);
      }
    }
    // Path should always exist to either add or replace JavaScript file.
    if (!empty($js[$path])) {
      // Replace file.
      if ($replace) {
        $js[$file->uri] = $js[$path];
        $js[$file->uri]['data'] = $file->uri;
        unset($js[$path]);
      }
      // Add file.
      else {
        $js[$file->uri] = drupal_js_defaults($file->uri);
        $js[$file->uri]['group'] = JS_THEME;
      }
    }
  }

  // Ensure jQuery Once is always loaded.
  // @see https://drupal.org/node/2149561
  if (empty($js['misc/jquery.once.js'])) {
    $jquery_once = drupal_get_library('system', 'jquery.once');
    $js['misc/jquery.once.js'] = $jquery_once['js']['misc/jquery.once.js'];
    $js['misc/jquery.once.js'] += drupal_js_defaults('misc/jquery.once.js');
  }

  // Always add bootstrap.js last.
  $bootstrap = $theme_path . '/js/bootstrap.js';
  $js[$bootstrap] = drupal_js_defaults($bootstrap);
  $js[$bootstrap]['group'] = JS_THEME;
  $js[$bootstrap]['scope'] = 'footer';

  if (!empty($excludes)) {
    $js = array_diff_key($js, drupal_map_assoc($excludes));
  }

  // Add Bootstrap settings.
  $js['settings']['data'][]['bootstrap'] = array(
    'anchorsFix' => theme_get_setting('bootstrap_anchors_fix'),
    'anchorsSmoothScrolling' => theme_get_setting('bootstrap_anchors_smooth_scrolling'),
    'formHasError' => (int) theme_get_setting('bootstrap_forms_has_error_value_toggle'),
    'popoverEnabled' => theme_get_setting('bootstrap_popover_enabled'),
    'popoverOptions' => array(
      'animation' => (int) theme_get_setting('bootstrap_popover_animation'),
      'html' => (int) theme_get_setting('bootstrap_popover_html'),
      'placement' => theme_get_setting('bootstrap_popover_placement'),
      'selector' => theme_get_setting('bootstrap_popover_selector'),
      'trigger' => implode(' ', array_filter(array_values((array) theme_get_setting('bootstrap_popover_trigger')))),
      'triggerAutoclose' => (int) theme_get_setting('bootstrap_popover_trigger_autoclose'),
      'title' => theme_get_setting('bootstrap_popover_title'),
      'content' => theme_get_setting('bootstrap_popover_content'),
      'delay' => (int) theme_get_setting('bootstrap_popover_delay'),
      'container' => theme_get_setting('bootstrap_popover_container'),
    ),
    'tooltipEnabled' => theme_get_setting('bootstrap_tooltip_enabled'),
    'tooltipOptions' => array(
      'animation' => (int) theme_get_setting('bootstrap_tooltip_animation'),
      'html' => (int) theme_get_setting('bootstrap_tooltip_html'),
      'placement' => theme_get_setting('bootstrap_tooltip_placement'),
      'selector' => theme_get_setting('bootstrap_tooltip_selector'),
      'trigger' => implode(' ', array_filter(array_values((array) theme_get_setting('bootstrap_tooltip_trigger')))),
      'delay' => (int) theme_get_setting('bootstrap_tooltip_delay'),
      'container' => theme_get_setting('bootstrap_tooltip_container'),
    ),
  );

  // Add CDN.
  if (theme_get_setting('bootstrap_cdn')) {
    $cdn = '//netdna.bootstrapcdn.com/bootstrap/' . theme_get_setting('bootstrap_cdn')  . '/js/bootstrap.min.js';
    $js[$cdn] = drupal_js_defaults();
    $js[$cdn]['data'] = $cdn;
    $js[$cdn]['type'] = 'external';
    $js[$cdn]['every_page'] = TRUE;
    $js[$cdn]['weight'] = -100;
  }
}
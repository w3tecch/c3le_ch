<?php
/**
 * @file
 * menu-tree.func.php
 */

/**
 * Bootstrap theme wrapper function for the navigation menu links.
 */
function bootstrap_c3le_menu_tree__menu_side_navigation(&$variables) {
  return '<ul class="menu nav nav-pills nav-stacked side-navigation">' . $variables['tree'] . '</ul>';
}

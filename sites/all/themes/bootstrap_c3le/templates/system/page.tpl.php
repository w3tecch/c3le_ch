<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<div id="wrapper">

  <!-- Sidebar -->
  <div id="sidebar-wrapper">
    <div class="container container-page">
      <!-- Navigation Top -->
      <div class="row">
        <?php if (!empty($page['nav_top'])): ?>
          <?php print render($page['nav_top']); ?>
        <?php endif; ?>
      </div>
      <!-- /Navigation Top -->
      <!-- Brand logo -->
      <div class="row logo-row">
        <?php if ($logo): ?>
          <style>
            .ch-img-1 {
              background-image: url(<?php print $logo; ?>);
            }
          </style>
          <ul class="ch-grid">
            <li>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
              <div class="ch-item ch-img-1">
                <div class="ch-info">
                  <h3>The spining club</h3>
                  <p>by c3le</p>
                </div>
              </div>
              </a>
            </li>
          </ul>
        <?php endif; ?>
      </div>
      <!-- /Brand logo -->
      <!-- Navigtion -->
      <div class="row">
        <?php if (!empty($page['navigation'])): ?>
          <?php print render($page['navigation']); ?>
        <?php endif; ?>
      </div>
      <!-- /Navigation -->
    </div>
    <!-- Navigation Bottom -->
    <div class="container container-page fixed-bottom">
      <div class="row">
        <?php if (!empty($page['nav_bottom'])): ?>
          <?php print render($page['nav_bottom']); ?>
        <?php endif; ?>
      </div>
    </div>
    <!-- /Navigation Bottom -->
  </div>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">

    <nav class="navbar navbar-default navbar-static-top visible-xs" role="navigation">
      <div class="container">
        <button type="button" class="btn btn-default navbar-btn side-nav-toggle">
          <span class="glyphicon glyphicon-align-justify"></span>
        </button>
      </div>
    </nav>

    <div class="container-fluid">
      <!-- Content Top -->
      <div class="row">
        <div class="col-lg-12">
          <?php if (!empty($page['content_top'])): ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <?php print render($page['content_top']); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Content Top -->
      <!-- Highlighted -->
      <div class="row">
        <div class="col-lg-12">
          <?php if (!empty($page['highlighted'])): ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <?php print render($page['highlighted']); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Highlighted -->
      <div class="row">
        <div class="col-lg-12">
          <?php print $messages; ?>
        </div>
      </div>
      <!-- Content -->
      <div class="row">
        <div class="col-lg-12">
          <a id="main-content"></a>
          <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
          <?php if (!empty($title)): ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <?php print render($title_prefix); ?>
              <?php if (!empty($title)): ?>
                <h2 class="page-header"><?php print $title; ?></h2>
              <?php endif; ?>
              <?php print render($title_suffix); ?>
            </div>
            <div class="panel-body">
              <?php if (!empty($tabs)): ?>
                <?php print render($tabs); ?>
              <?php endif; ?>
              <?php if (!empty($action_links)): ?>
                <ul class="action-links"><?php print render($action_links); ?></ul>
              <?php endif; ?>
              <?php print render($page['content']); ?>
            </div>
          </div>
          <?php else: ?>
            <?php print render($page['content']); ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Content -->
      <!-- Content Bottom -->
      <div class="row">
        <div class="col-lg-12">
          <?php if (!empty($page['content_bottom'])): ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <?php print render($page['content_bottom']); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Content Bottom -->
      <!-- Content Footer -->
      <div class="row">
        <div class="col-lg-12">
          <?php if (!empty($page['content_footer'])): ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <?php print render($page['content_footer']); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <!-- /Content Footer -->
    </div>
  </div>
  <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Menu Toggle Script -->
<script>
  jQuery(".side-nav-toggle").click(function(e) {
    e.preventDefault();
    jQuery("#wrapper").toggleClass("toggled");
  });
</script>
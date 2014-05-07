<?php
/**
 * @file page.tpl.php
 * @see modules/system/page.tpl.php for drupal documentation of a page.tpl.php
 *
 * This is only a very basic example of how to use foundation classes.
 * Copy to your subtheme to start working with foundation grids as you need.
 *
 * class "row" is a special class dedicated to foundation framework.
 * Please @see http://foundation.zurb.com/docs/components/grid.html on how to use.
 * It's up to you to override this template and use grid classes as you like.
 *
 * Sidebars are handled by foundation grid classes, that may be configured
 * in theme settings if needed.
 *
 * The grid settings can be configured in _settings.scss file.
 *
 * Alternatively, you may wish to keep your html semantic with foundation grid mixins
 * to define rows and columns in your scss, rather than in html classes.
 */
?>

<?php // Display the grid if needed. You need to enable Grid viewer in theme settings. ?>
<?php if (isset($foundation_grid_viewer)) : ?>
  <?php print $foundation_grid_viewer ?>
<?php endif ?>

<?php //display topbar, if foundation_topbar plugin is enabled in theme settings. ?>
<?php if(isset($foundation_topbar)) :?>
  <?php print $foundation_topbar ?>
<?php endif ?>

<header>

  <!-- site name , logo & slogan -->
  <?php if ($site_name || $logo || $site_slogan) : ?>
    <div class="row">
      <h1>
        <?php if ($logo): ?>
          <a href="<?php print $front_page ?>" title="<?php print t('Home') ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home') ?>" />
          </a>
        <?php endif ?>

        <?php if($site_name): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"> <?php print $site_name ?> </a>
        <?php endif ?>

        <?php if ($site_slogan): ?> <small><?php print $site_slogan ?></small> <?php endif ?>
      </h1>
    </div>
  <?php endif ?>

  <!-- primary and secondary menus -->
  <?php if($main_menu || $secondary_menu):?>
    <div class="row">
      <div class="small-12 columns">
        <nav>
          <?php if ($main_menu) : ?>
            <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu'))) ?>
          <?php endif ?>
          <?php if ($secondary_menu) : ?>
            <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu'))) ?>
          <?php endif ?>
        </nav>
      </div>
    </div>
  <?php endif ?>
  </div>

  <?php // foundation rows ?>
  <div class="row header--row-1">
    <?php if(isset($page['header__row_1'])) print render($page['header__row_1']) ?>
  </div>
  <div class="row header--row-2">
    <?php if(isset($page['header__row_2'])) print render($page['header__row_2']) ?>
  </div>
  <div class="row header--row-3">
    <?php if(isset($page['header__row_3'])) print render($page['header__row_3']) ?>
  </div>
  <div class="row header--row-4">
    <?php if(isset($page['header__row_4'])) print render($page['header__row_4']) ?>
  </div>

</header>

<?php if ($breadcrumb): ?>
  <div class="row" id="breadcrumb">
    <div class="small-12 columns">
      <?php print $breadcrumb ?>
    </div>
  </div> <!-- /.row -->
<?php endif ?>

<div class="row content-top--row-1">
  <?php if(isset($page['content_top__row_1'])) print render($page['content_top__row_1']) ?>
</div>
<div class="row content-top--row-2">
  <?php if(isset($page['content_top__row_2'])) print render($page['content_top__row_2']) ?>
</div>
<div class="row content-top--row-3">
  <?php if(isset($page['content_top__row_3'])) print render($page['content_top__row_3']) ?>
</div>
<div class="row content-top--row-4">
  <?php if(isset($page['content_top__row_4'])) print render($page['content_top__row_4']) ?>
</div>

<?php if ($messages) : ?>
  <div id="messages">
    <?php print $messages ?>
  </div> <!-- /.row -->
<?php endif ?>

<section class="content">
  <div class="row">

    <?php // sidebars and content classes contains foundation classes generated by dynamic_sidebars plugins ?>
    <?php if ($page['sidebar_first']): ?>
      <aside id="sidebar-first" class="<?php if (isset($sidebar_first_classes)) print $sidebar_first_classes ?>">
        <?php print render($page['sidebar_first']) ?>
      </aside>
    <?php endif ?>

    <?php // sidebars and content classes contains foundation classes generated by dynamic_sidebars plugins ?>
    <div id="content" class="<?php if (isset($content_classes)) print $content_classes ?>">

      <a id="main-content"></a>
      <?php print render($title_prefix) ?>
      <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif ?>
      <?php print render($title_suffix) ?>
      <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif ?>
      <?php print render($page['help']) ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links) ?></ul><?php endif ?>

      <div class="row">
        <?php print render($page['content']) ?>
      </div>

      <div class="row content-bottom--row-1">
        <?php if(isset($page['content_bottom__row_1'])) print render($page['content_bottom__row_1']) ?>
      </div>
      <div class="row content-bottom--row-2">
        <?php if(isset($page['content_bottom__row_2'])) print render($page['content_bottom__row_2']) ?>
      </div>
      <div class="row content-bottom--row-3">
        <?php if(isset($page['content_bottom__row_3'])) print render($page['content_bottom__row_3']) ?>
      </div>
      <div class="row content-bottom--row-4">
        <?php if(isset($page['content_bottom__row_4'])) print render($page['content_bottom__row_4']) ?>
      </div>

      <?php print $feed_icons ?>

    </div>

    <?php if ($page['sidebar_second']): ?>
      <aside id="sidebar-second" class="<?php if (isset($sidebar_second_classes)) print $sidebar_second_classes ?>">
        <?php print render($page['sidebar_second']) ?>
      </aside>
    <?php endif; ?>

  </div> <!-- /.row -->
</section>

<footer>
  <div class="row footer footer--row-1">
    <?php if(isset($page['footer__row_1'])) print render($page['footer__row_1']); ?>
  </div>
  <div class="row footer--row-2">
    <?php if(isset($page['footer__row_2'])) print render($page['footer__row_2']); ?>
  </div>
  <div class="row footer--row-3">
    <?php if(isset($page['footer__row_3'])) print render($page['footer__row_3']); ?>
  </div>
  <div class="row footer--row-4">
    <?php if(isset($page['footer__row_4'])) print render($page['footer__row_4']); ?>
  </div>
</footer>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <!-- ページタイトル -->
  <title><?php bloginfo('name'); ?></title>
  <!-- ページ説明 -->
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSSフィード" href="<?php bloginfo('rss2_url'); ?>">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- カスタムCSS -->
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
  <?php wp_head(); // Wordoress用のヘッダー関数 ?>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><?php bloginfo('name'); ?></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <?php wp_nav_menu( array(
          'menu' => 'primary',
          'theme_location' => 'primary',
          'menu_class' => 'nav navbar-nav',
          'container_class' => 'navbar-collapse collapse',
          'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
          'walker' => new wp_bootstrap_navwalker()
      ) );?>
   <!--    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#">メニュー1</a></li>
              <li><a href="#">メニュー2</a></li>
              <li><a href="#">メニュー3</a></li>
          </ul>
      </div> /.navbar-collapse --> 
  </div><!-- /.container -->
</nav>
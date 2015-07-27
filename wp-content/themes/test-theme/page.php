<?php get_header(); ?>
<div class="container" id="main">
  <div class="row">
  <?php // WPから該当する個別ページデータ取得 ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1 class="col-md-12 page-title"><?php the_title(); // 個別ページのタイトル ?></h1>
    <article class="page col-md-8 col-sm-8">
      <div class="entry">
        <?php the_content(); // 個別ページのコンテンツ ?>
      </div>
    </article>
  <?php endwhile; else: ?>
    <article class="page col-md-8 col-sm-8 not-found">
      <div class="entry">
        <p class="lead">このページは存在しません。</p>
        <?php get_search_form(); ?>
        <?php get_form(); ?>        
      </div>
    </article>
  <?php endif; ?>
    <div class="col-md-4 col-sm-4">
      <?php get_sidebar(); ?>
    </div>
  </div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer(); ?>
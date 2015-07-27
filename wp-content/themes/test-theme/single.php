<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="jumbotron">
  <div class="container" id="main">
    <div class="row">
      <div class="col-md-8">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <ul class="list-inline post-meta">
          <li><i class="fa fa-calendar"></i> <?php the_time('Y年n月j日'); ?></li>
        </ul>
        <p><i class="fa fa-folder-open-o"></i> <?php the_category(', '); ?></p>
        <?php if ( has_tag() ) { // Check if post has any tags ?>
        <p><i class="fa fa-tags"></i> <?php the_tags('', ', '); ?></p>
        <?php } // end if ?>
      </div> <!-- .col-md-8 -->
      <div class="col-md-4 img-featured">
      <?php // Insert featured image
        if (has_post_thumbnail()) {
          echo get_the_post_thumbnail($post->ID, 'large', array('class' => 'img-responsive', 'title' => ''));
        } else { // Use a fallback ?>
          <img class="thumbnail img-responsive" src="http://placehold.it/750x500" alt="Image coming soon" />
      <?php } ?>
      </div> <!-- .col-md-4 -->
    </div> <!-- .row -->
  </div> <!-- .container -->
</div> <!-- .jumbotron -->
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <article <?php post_class(); ?>>
        <?php the_content(); ?>
        <ul class="pager">
          <li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i>&nbsp; %title'); ?></li>
          <li class="next"><?php next_post_link('%link', '%title &nbsp;<i class="fa fa-chevron-right"></i>'); ?></li>
        </ul>
      </article>
      <?php comments_template(); ?>
    </div> <!-- .col-md-8 -->
    <div class="col-md-4">
      <?php get_sidebar(); ?>
    </div>
  </div> <!-- .row -->
</div> <!-- .container -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>
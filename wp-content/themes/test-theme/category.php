<?php get_header(); ?>
<div id="contents">
<div class="container" id="main">
  <div class="col-xs-12 col-sm-12 achives">
    <div class="col-sm-12 col-lg-12 col-md-12">
      <h2>カテゴリ : <?php single_tag_title(); ?></h2>
    </div>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="col-sm-12 col-lg-12 col-md-12">
          <div class="thumbnail clearfix">
            <div class="eyecatch col-md-4 col-sm-4">
            <?php // アイキャッチ画像
          if (has_post_thumbnail()) {
            echo get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'img-responsive', 'title' => ''));
          } else { // アイキャッチ画像がない場合 ?>
            <img class="img-responsive" src="http://placehold.it/320x150" alt="Image coming soon" />
        <?php } ?>
        </div>
              <div class="caption col-md-8 col-sm-8">
                  <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                  <p class="date"><?php the_time('Y年n月j日'); ?></p>
                  <p class="content"><?php echo mb_substr(strip_tags($post->post_content),0,100).'...'; ?></p>
              </div>
          </div>
      </div>
    <?php endwhile; endif; ?>
  </div>
</div>
</div>
<?php get_footer(); ?>
<?php get_header(); ?>
<div class="container" id="main">
  <div class="row">
    <div class="col-md-12">
    <h1>祝！Wordpress!!</h1>
  </div>
    <!-- お知らせ一覧 -->
    <div class="col-md-12">
      <h1>最新記事</h1>
    </div>
    <?php
    $newslist = get_posts( array(
      // 'category_name' => 'news', //特定のカテゴリースラッグを指定
      'posts_per_page' => 10 //取得記事件数
    ));
      foreach( $newslist as $post ):
      setup_postdata( $post ); // 投稿情報を各種のグローバル変数へセット
    ?>
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
    
    <?php
    endforeach;
    wp_reset_postdata();
  ?>
  <!-- /お知らせ一覧 -->
  </div>
  </div>
<?php get_footer(); ?>
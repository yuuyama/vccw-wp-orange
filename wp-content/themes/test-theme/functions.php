<?php
// ウィジットの登録
if (function_exists('register_sidebar')) {
   register_sidebar(array(
    'name' => 'サイドバー1', // ウィジェット名
    'id' => 'sidebar1', // ウィジェットのID
    'description' => '説明1', // ウィジェットの説明
    'before_widget' => '<div>', // ウィジェットを囲む開始タグ
    'after_widget' => '</div>', // ウィジェットを囲む終了タグ
    'before_title' => '<h3>', // ウィジェットのタイトルを囲む開始タグ
    'after_title' => '</h3>' // ウィジェットのタイトルを囲む終了タグ
  ));
}
// アイキャッチ画像対応
add_theme_support('post-thumbnails');


define( 'MYTHEMES_PATH', get_template_directory() );
require( MYTHEMES_PATH.'/wp_bootstrap_navwalker.php' );

?>
 

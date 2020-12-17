<?php
global $twitter_posts;
global $twitter_name;
global $twitter;
global $page_id;
global $max_page;
global $page;
global $children_array;

$page = get_page_by_path('/users');
// 子ページ取得
$args = array(
    'post_parent' => $page->ID, 
    'post_status' => 'publish',
    'post_type' => 'page'
);
$children_array = get_children($args);



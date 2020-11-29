<?php get_header(); ?>

<?php
require 'Twitter.php';

global $twitter_posts;
global $twitter_name;
global $twitter;
global $page_id;
global $max_page;

// 子ページ取得
$args = array(
    'post_parent' => get_the_ID(),
    'post_status' => 'publish',
    'post_type' => 'page'
);
$children_array = get_children($args);


// ページネーション関係
$page_id = $_GET['paginate'];
$max_page = count($children_array) / 3 - 1;
$page_start = $page_id * 3;

// ユーザーを3人選ぶ
$users = array_slice($children_array, $page_start, 3);

?>

    <div class="container">
        <div class="row head mt-4 pb-3">
            <div class="col-sm-7">
                <h2 class="user-name"><?php the_title(); ?></h2>

                <?php if (!$_GET["is_reply"]): ?>
                    <a href="?is_reply=1">自分に関する投稿すべて表示</a>
                <?php else: ?>
                    <a href="?is_reply=0">自分の投稿のみ表示</a>
                <?php endif; ?>
                <a class="ml-4" href="<?php echo home_url(); ?>">トップページに戻る</a>
            </div>

            <div class="col-sm-5 mt-3">
                <?php get_search_form(); ?>
            </div>
        </div>

        <?php get_template_part("paginate-content"); ?>


        <?php
        foreach ($users as $user):
            $user_id = $user->ID;
            $twitter_name = get_post_custom($user_id)['twitter'][0];
            $page = get_page($user_id);
            $twitter = new Twitter($twitter_name, $_GET["is_reply"], 35);
            $twitter_posts = $twitter->getPosts();
            ?>
            <h2 class="user-name"><?php echo $page->post_title; ?></h2>
            <!--Twitter-->
            <?php get_template_part("twitter-content"); ?>
            <hr>
        <?php endforeach; ?>

    </div>

<?php get_footer(); ?>
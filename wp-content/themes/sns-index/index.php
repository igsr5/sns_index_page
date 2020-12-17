<?php get_header(); ?>

<?php
require 'Twitter.php';

global $twitter_posts;
global $twitter_name;
global $twitter;
global $page_id;
global $max_page;

$page = get_page_by_path('/users');
// 子ページ取得
$args = array(
    'post_parent' => $page->ID, 
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
                <h2 class="user-name"><?php echo $page->post_title
                ; ?></h2>

                <?php if (!$_GET["is_reply"]): ?>
                    <a href="?is_reply=1">Includeing other users' posts</a>
                <?php else: ?>
                    <a href="?is_reply=0">Only users' posts</a>
                <?php endif; ?>
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
                $twitter = new Twitter($twitter_name, $_GET["is_reply"], 200);
                $twitter_posts = $twitter->getPosts();
        ?>

			<h2 class="user-name"><?php echo $page->post_title; ?></h2>
			<!--Twitter-->
			<?php get_template_part("twitter-content"); ?>
			<hr>
		<?php endforeach; ?>
    </div>

<?php get_footer(); ?>

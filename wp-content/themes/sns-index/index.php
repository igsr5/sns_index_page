<?php
require 'Twitter.php';
get_header(); 
?>

<?php
// ページネーション関係
$page_id = $_GET['paginate'];
$max_page = count($children_array) / 3 - 1;
$page_start = $page_id * 3;

// ユーザーを3人選ぶ
$users = array_slice($children_array, $page_start, 3);
?>

    <div class="container-fluid">
        <div class="row head mt-3 pb-3">
            <div class="col-sm-7">
                <h2 class="user-name">Elected Officials<h2>

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

        <?php get_template_part("paginate-content"); ?>
    </div>

<?php get_footer(); ?>

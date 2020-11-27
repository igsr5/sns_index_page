<?php get_header(); ?>

<?php
require 'Paginate.php';
require 'Twitter.php';


// 子ページ取得
$args = array(
    'post_parent' => get_the_ID(),
    'post_status' => 'publish',
    'post_type' => 'page'
);
$children_array = get_children($args);

$page_id = $_GET['paginate'];
$max_page = count($children_array)-1;

// ユーザーを一人選ぶ
$user = array_slice($children_array, $page_id, 1);
$user_id = $user[0]->ID;
$twitter_name = get_post_custom($user_id)['twitter'][0];
$page = get_page($user_id);


$twitter = new Twitter($twitter_name, $_GET["is_reply"], 35);

$twitter_posts = $twitter->getPosts();

?>

<div class="container">
    <div class="row head mt-4 pb-3">
        <div class="col-sm-7">
            <h2 class="user-name"><?php echo $page->post_title; ?></h2>

            <?php if (!$_GET["is_reply"]): ?>
                <a href="?is_reply=1">自分に関する投稿すべて表示</a>
            <?php else: ?>
                <a href="?is_reply=0">自分の投稿のみ表示</a>
            <?php endif; ?>
            <a class="ml-4" href="<?php echo home_url(); ?>">ユーザー一覧に戻る</a>
        </div>

        <div class="col-sm-5 mt-3">
            <?php get_search_form(); ?>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($page_id <= 0): ?>
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="?paginate=<?php echo $page_id-1; ?>">Previous</a></li>
            <?php endif; ?>

            <?php if ($page_id >= $max_page): ?>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="?paginate=<?php echo $page_id+1; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!--Twitter-->
    <a href="<?php echo home_url('/twitter'), "?user_name=", $twitter_name; ?>"><h3 class="sns-name mb-4">Twitter</h3>
    </a>
    <div class="top-twitter mb-5">
        <ul class="top-posts">
            <?php foreach ($twitter_posts as $item): ?>
                <li class="card">
                    <article>
                        <a class="text"
                           href="https://twitter.com/<?php echo $item->user->screen_name; ?>/status/<?php echo $item->id; ?>">
                            <?php if ($twitter->is_RT($item->text)) {
                                echo $twitter->add_color_rts($item->text);
                            } else {
                                echo $item->text;
                            }
                            ?>
                        </a>
                        <?php
                        // 引用リツイート
                        if ($item->is_quote_status) {
                            echo "<br>";
                            echo "<a class='text' href='https://twitter.com/", $item->quoted_status->user->screen_name, "/status/", $item->quoted_status->id, "'><span class='rt'>RT @", $item->quoted_status->user->name, ":</span>", $item->quoted_status->text, "</a>";
                        }
                        ?>
                        <img class="post_photo" src="<?php echo $item->entities->media[0]->media_url_https; ?>"
                             alt="">
                        <p class="created_at"><?php echo $item->created_at; ?></p>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<?php get_footer(); ?>
